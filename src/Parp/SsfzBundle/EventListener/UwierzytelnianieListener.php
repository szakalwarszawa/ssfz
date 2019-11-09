<?php
namespace Parp\SsfzBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use InvalidArgumentException;
use OutOfBoundsException;
use Parp\UzytkownikBundle\Entity\WpisDziennikaUwierzytelnienia;
use Parp\UzytkownikBundle\Entity\Uzytkownik;
use Parp\UzytkownikBundle\Entity\ZmianaHasla;
use Parp\UzytkownikBundle\Form\LogowanieFormType;
use ReCaptcha\ReCaptcha;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Obsługa wystąpienia zdarzeń związanych z uwierzytelnianiem użytkowników w systemie.
 */
class UwierzytelnianieListener implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var EncoderFactory
     */
    private $encoderFactory;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var string|null
     */
    private $defaultPasswordEncoder;

    /**
     * Publiczny konstruktor.
     *
     * @param EntityManager  $entityManager
     * @param Request        $requestStack
     * @param FormFactory    $formFactory
     * @param EncoderFactory $encoderFactory
     * @param Router         $router
     * @param string|null    $defaultPasswordEncoder
     *
     * @throws OutOfBoundsException
     * @throws InvalidOptionsException
     */
    public function __construct(
        EntityManager $entityManager,
        Request $requestStack,
        FormFactory $formFactory,
        EncoderFactory $encoderFactory,
        Router $router,
        $defaultPasswordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->request = $requestStack;
        $this->formFactory = $formFactory;
        $this->encoderFactory = $encoderFactory;
        $this->router = $router;
        $this->defaultPasswordEncoder = $defaultPasswordEncoder;
        $this->log = new WpisDziennikaUwierzytelnienia();
        $this->walidujFormularzLogowania();
    }

    /**
     * @see EventSubscriberInterface
     *
     * @return string[] Tablica nazw nasłuchiwanych zdarzeń.
     */
    public static function getSubscribedEvents()
    {
        $zdarzenia = array(
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure',
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onAuthenticationSuccess',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
        );

        return $zdarzenia;
    }

    /**
     * Metoda wywoływana po nieudanym uwierzytelnieniu.
     *
     * Zdażenie zachodzi jeśli użytkownik nie został uwierzytelniony przez
     * żadnego z dostawców uwierzytelniania.
     *
     * @param AuthenticationFailureEvent $event
     *
     * @return bool
     *
     * @throws RuntimeException
     * @throws InvalidArgumentException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function onAuthenticationFailure(AuthenticationFailureEvent $event)
    {
        $this->zbierzDaneZadania($this->request);
        $token = $event->getAuthenticationToken();
        $this->zbierzDaneTokena($token);
        $exception = $event->getAuthenticationException();
        $this->zbierzDaneBledu($exception);
        $entityManager = $this->entityManager;
        // Wykonanie clear() jest konieczne w celu uniknięcia utrwalenia danych użytkownika, które
        // w tym miejscu są już po wykonaniu eraseCredentials() (np. mają usuniętą sól).
        $entityManager->clear();
        $entityManager->persist($this->log);
        $entityManager->flush();

        return true;
    }

    /**
     * Metoda wywoływana po zdarzeniu udanego uwierzytelnienia przez jednego
     * z dostawców uwierzytelniania.
     *
     * @param AuthenticationEvent $event
     *
     * @return bool
     *
     * @throws RuntimeException
     * @throws InvalidArgumentException
     * @throws ORMInvalidArgumentException
     * @throws OptimisticLockException
     */
    public function onAuthenticationSuccess(AuthenticationEvent $event)
    {
        $router = $this->router;
        $this->zbierzDaneZadania($this->request);
        $token = $event->getAuthenticationToken();
        $this->zbierzDaneTokena($token);
        $entityManager = $this->entityManager;
        $entityManager->detach($this->log);
        $entityManager->persist($this->log);
        $entityManager->flush($this->log);
        $uzytkownik = $token->getUser();
        $cel = $this->przekierujNaStroneDomowa($token);
        if ($uzytkownik->musiZmienicHaslo()) {
            $cel = array(
                'route' => 'konto_uzytkownika_zmiana_hasla',
                'params' => array(),
            );
            $session = $this->request->getSession();
            $session->set('wymuszona_zmiana_hasla', true);
        }
        $params = isset($cel['params']) ? $cel['params'] : array();
        $url = $router->generate($cel['route'], $params, true);
        $this->request->request->set('_target_path', $url);

        return true;
    }

    /**
     * Metoda wywoływana w przypadku uwierzytelnienia urzytkownika z podaniem loginu i hasła.
     *
     * @param InteractiveLoginEvent $event
     *
     * @return boolean
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $request = $event->getRequest();
        $user = $event->getAuthenticationToken()->getUser();
        $userPasswordEncoderName = null;
        if ($user instanceof Uzytkownik) {
            $userPasswordEncoderName = $user->getEncoderName();
        }
        $defaultPasswordEncoderName = $this->defaultPasswordEncoder;
        if (null !== $defaultPasswordEncoderName) {
            $entityManager = $this->entityManager;
            if ($userPasswordEncoderName !== $defaultPasswordEncoderName) {
                $user->setEncoderName($defaultPasswordEncoderName);
                $passwordEncoder = $this->encoderFactory->getEncoder($user);
                $plainPassword = $request->request->get('_password');
                $salt = $user->getSalt();
                $encodedPassword = $passwordEncoder->encodePassword($plainPassword, $salt);
                $user->setEncoderName($defaultPasswordEncoderName)->setHaslo($encodedPassword);
                $entityManager->flush($user);
            }
            $ostatniaZmianaHasla = $entityManager->getRepository('Parp\UzytkownikBundle\Entity\ZmianaHasla')
                                                 ->findOstatniaZmianaHasla($user);
            if (null === $ostatniaZmianaHasla) {
                $wpisHistorii = new ZmianaHasla();
                // Historycznie obiekt Uzytkownik nie posiadał informacji o dacie ostatniej zmiany hasła.
                // Jeśli data ta jest pusta zwraca datę utworzenia konta. Dodatkowo jeśli i ta data
                // byłaby pusta, to za datę ostatniej zmiany hasła zostanie przyjęty aktualny znacznik czasu.
                $kiedyZmienione = $user->getDataOstatniejZmianyHasla();
                $kiedyZmienione = ($kiedyZmienione instanceof \DateTime) ? $kiedyZmienione : new \DateTime('now');
                $wpisHistorii
                    ->setUzytkownik($user)
                    ->setKiedyZmienione($kiedyZmienione)
                    ->setKodowanieHasla($user->getEncoderName())
                    ->setHaslo($user->getHaslo())
                    ->setSol($user->getSol());
                $entityManager->persist($wpisHistorii);
                $entityManager->flush($wpisHistorii);
            }
        }

        return true;
    }

    /**
     * Dołącza do wpisu dziennika informacje z obiektu żądania.
     *
     * @param Request $request
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    private function zbierzDaneZadania(Request $request = null)
    {
        if (isset($request)) {
            $log = $this->log;
            $ip = $request->getClientIp();
            $port = $request->getPort();
            $log->setIpKlienta($ip . ':' . $port);
            $nazwaUzytkownika = $request->request->get('_username', null);
            $log->setPodanaNazwaUzytkownika($nazwaUzytkownika)->setPodaneHasloUzytkownika('Nieprawidłowe hasło');
        }

        return true;
    }

    /**
     * Dołącza do wpisu dziennika informacje z obiektu tokena.
     *
     * @param TokenInterface $token
     *
     * @return bool
     *
     * @throws RuntimeException
     */
    private function zbierzDaneTokena(TokenInterface $token = null)
    {
        /* @noinspection UnSafeIsSetOverArrayInspection */
        if (isset($token)) {
            $request = $this->request;
            $clientIp = $request->getClientIp();
            $token->setAttribute('adres_ip', $clientIp);
            $uzytkownik = $token->getUser();
            if ($uzytkownik instanceof UserInterface) {
                $sessionId = $request->getSession()->getId();
                $log = $this->log;
                $zakodowaneHaslo = $this->zakodujHaslo($log->getPodaneHasloUzytkownika(), $uzytkownik);
                $log->setIdUzytkownika($uzytkownik->getId())
                    ->setPodaneHasloUzytkownika($zakodowaneHaslo)
                    ->setHasloUzytkownika($uzytkownik->getHaslo())
                    ->setIdentyfikatorSesji($sessionId);
            }
            $this
                ->log
                ->setZakonczonePowodzeniem($token->isAuthenticated());
        }

        return true;
    }

    /**
     * Dołącza do wpisu dziennika informacje z obiekty błędu.
     *
     * @param \Exception $exception
     *
     * @return bool
     */
    private function zbierzDaneBledu(\Exception $exception = null)
    {
        /* @noinspection UnSafeIsSetOverArrayInspection */
        if (isset($exception)) {
            $log = $this->log;
            $log->addBlad($exception->getMessage());
        }

        return true;
    }

    /**
     * Waliduje zawartość formularza po nieudanym uwierzytelnieniu, w celu uzyskania
     * dodatkowych informacji o przyczynie niepowodzenia.
     * Ze względu na możliwe przekierowania w trakcie uwierzytelniania, uzyskane
     * informacje zostają zachowane w sesji (podobnie jak SecurityContext::AUTHENTICATION_ERROR).
     *
     * @return bool
     *
     * @throws InvalidOptionsException
     * @throws OutOfBoundsException
     */
    private function walidujFormularzLogowania()
    {
        $request = $this->request;
        $session = $request->getSession();
        if ($session->has('formularz_logowanie_bledy')) {
            $session->remove('formularz_logowanie_bledy');
        }
        if ($request->getMethod() === 'POST') {
            $formularz = $this->formFactory->create(new LogowanieFormType());
            $formularz->handleRequest($request);
            if (!$formularz->isValid()) {
                $bledy = array();
                $trescBledow = array();
                // To rozwiązanie nie działa, chociaż jest poprawne i dość zwięzłe.
                // Dołączne do tablicy $bledy obiekty typu FormError (implementujące interfejs \Serializable)
                // zawierają zmienną $cause, która zawiera instancję klasy
                // Symfony\Component\Validator\ConstraintViolation.
                // Serializacja (metodą serialize()) obiektów tej klasy powoduje wyrzucenie błędu: "You cannot serialize
                // or unserialize PDO instances" (prawdopodobnie PDO jest jedną z jej zależności). Parametr $cause
                // (przekazywany jako ostatni w konstruktorze obiektu typu FormError) jest prywatny i nie posiada
                // publicznego mutatora (posiada jedynie akcesor). Na podstawie:
                // http://fabien.potencier.org/php-serialization-stack-traces-and-exceptions.html
                // $bledy['_username'] = $formularz->get('_username')->getErrors();
                // $bledy['_password'] = $formularz->get('_password')->getErrors();
                // To rozwiązanie działa, ale jest brutalne. Każdy obiekt FormError jest "przepisywany"
                // na nowy obiekt tego samego typu, ale pomijany jest parametr $cause (domyślnie null).
                foreach ($formularz->get('_username')->getErrors() as $blad) {
                    if ($blad instanceof FormError) {
                        $properFormError = new FormError(
                            $blad->getMessage(), $blad->getMessageTemplate(),
                            $blad->getMessageParameters(),
                            $blad->getMessagePluralization()
                        );
                        $trescBledow[] = $blad->getMessage();
                        $bledy['_username'][] = $properFormError;
                    }
                }

                foreach ($formularz->get('_password')->getErrors() as $blad) {
                    if ($blad instanceof FormError) {
                        $properFormError = new FormError(
                            $blad->getMessage(),
                            $blad->getMessageTemplate(),
                            $blad->getMessageParameters(),
                            $blad->getMessagePluralization()
                        );

                        $trescBledow[] = $blad->getMessage();
                        $bledy['_password'][] = $properFormError;
                    }
                }

                // Zapamiętanie pełnej informacji o błędach w sesji.
                $session->set('formularz_logowanie_bledy', $bledy);

                // Utrwalenie treści błędów w bazie danych.
                $this->log->addBlad(implode("\n", $trescBledow));
            }
        }

        return true;
    }

    /**
     * Koduje hasło użytkownika.
     *
     * @param string        $podaneHaslo
     * @param UserInterface $uzytkownik
     *
     * @return string
     *
     * @throws RuntimeException
     */
    private function zakodujHaslo($podaneHaslo = null, UserInterface $uzytkownik = null)
    {
        $hasloZakodowane = null;
        if (isset($podaneHaslo) and isset($uzytkownik)) {
            $encoder = $this->encoderFactory->getEncoder($uzytkownik);
            $sol = $uzytkownik->getSol();
            $hasloZakodowane = $encoder->encodePassword($podaneHaslo, $sol);
        }

        return $hasloZakodowane;
    }

    /**
     * Wykonuje przekierowanie użytkownika na właściwą stronę domową
     * w zależności od posiadanych uprawnień.
     *
     * Uwaga! W pliku security.yml należy zachować następujące ustawienie:
     * always_use_default_target_path: false
     *
     * @param TokenInterface $token
     *
     * @return string
     */
    public function przekierujNaStroneDomowa(TokenInterface $token)
    {
        $uzytkownik = $token->getUser();
        $uprawnienia = $uzytkownik->getRoles();
        $entityManager = $this->entityManager;
        $pokazacRegulamin = false;

        $message = $entityManager
            ->getRepository('ParpKomunikacjaBundle:KomunikatSystemowy')
            ->findMessageForUser($token->getUser());

        $cel = array('route' => 'login', 'params' => array());

        if (in_array('ROLE_LDAP', $uprawnienia, true)) {
            $cel = array('route' => 'administracja', 'params' => array());
        } elseif (in_array('ROLE_EKSPERT', $uprawnienia, true)) {
            $cel = array('route' => 'ekspert', 'params' => array());
            $pokazacRegulamin = true;
        } elseif (in_array('ROLE_WNIOSKODAWCA', $uprawnienia, true)) {
            $cel = array('route' => 'login', 'params' => array());
            $pokazacRegulamin = true;
        } elseif (in_array('ROLE_SLUZBY', $uprawnienia, true)) {
            $cel = array('route' => 'kontrola_sluzb_lista_wnioskow', 'params' => array());
            $pokazacRegulamin = true;
        }

        $czyAkceptRegulaminu = $entityManager
            ->getRepository('ParpUzytkownikBundle:AkceptacjaRegulaminu')
            ->czyAkceptRegulaminu($uzytkownik);
        if (true === $pokazacRegulamin && false === $czyAkceptRegulaminu) {
            // Użytkownik nie zaakceptował regulaminu.
            return array(
                'route' => 'regulamin',
                'params' => array('cel' => $cel['route']),
            );
        }

        if ($message) {
            return array(
                'route' => 'wyswietl_komunikat',
                'params' => array('cel' => $cel['route']),
            );
        }

        return $cel;
    }
}
