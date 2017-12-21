<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Parp\SsfzBundle\Form\Type\ResetLinkType;
use Parp\SsfzBundle\Form\Model\ResetLink;
use Parp\SsfzBundle\Form\Type\ResetPasswordType;
use Parp\SsfzBundle\Form\Type\ChangePasswordType;
use Parp\SsfzBundle\Form\Model\ChangePassword;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Repository\UzytkownikRepository;

/**
 * Kontroler obsługujący funkcjonalności po stronie Użytkownika
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 */
class SecurityController extends Controller
{

    /**
     * Metoda wyświetlająca formularz logowania
     * 
     * @see https://symfony.com/doc/current/security/form_login_setup.html
     * 
     * @Route("/login", name="login")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');

        $error = $authUtils->getLastAuthenticationError();

        return $this->render(
            'SsfzBundle::Security/loginForm.html.twig', array(
                'last_username' => $authUtils->getLastUsername(),
                'error' => $error,
            )
        );
    }

    /**
     * Metoda do wygenerowania klucza zmiany kasła.
     * Wysyłka klucza resetującego hasło na podany adres email.
     * 
     * @Route("/haslo/przypomnij")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function recoverPassword(Request $request)
    {
        $resetLink = new ResetLink();

        $form = $this->createForm(new ResetLinkType(), $resetLink);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resetLink = $form->getData();

            /* @var $uzytkownikRepository UzytkownikRepository */
            $uzytkownikRepository = $this->getUzytkownikRepository();

            /* @var $uzytkownik Uzytkownik */
            $uzytkownik = $uzytkownikRepository->findOneBy(
                [
                'login' => $resetLink->getLogin(),
                'email' => $resetLink->getEmail(),
                ]
            );
            if (!is_null($uzytkownik)) {
                if ($uzytkownik->getStatus() == 0) {
                    return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Konto nie zostało aktywowane. Skorzystaj z linku aktywacyjnego przesłanego na adres mailowy podany przy zakładaniu konta.'));
                }

                $randomHash = base64_encode(random_bytes(64));
                $randomHash = str_replace('/', '', $randomHash);
                $uzytkownik->setKodZapomnianeHaslo($randomHash);

                $uzytkownikRepository->persist($uzytkownik);

                $topic = 'Zmiana hasła';
                $template = '@SsfzBundle/Resources/views/Email/resetPassword.html.twig';
                $templateParams = array(
                    'code' => $randomHash,
                    'login' => $resetLink->getLogin());
                $this->getMailerService()->sendMail($uzytkownik, $topic, $template, $templateParams);

                return $this->render(
                    'SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Wysłano link zmiany hasła na adres email ' . $uzytkownik->getEmail() . '. Na twojej skrzynce mailowej znajdują się dalsze instrukcje,
                które umożliwią odzyskanie hasła do konta.')
                );
            }

            return $this->render(
                'SsfzBundle:Security:passwordRecover.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Konto nie istnieje w systemie.'
                )
            );
        }

        return $this->render(
            'SsfzBundle:Security:passwordRecover.html.twig', array(
                'form' => $form->createView(),
                'error' => ''
            )
        );
    }

    /**
     * Medota do resetu hasła.
     * 
     * @Route("/haslo/reset/token={token}")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        $resetPassword = new ChangePassword();

        $form = $this->createForm(new ResetPasswordType(), $resetPassword);

        $form->handleRequest($request);

        $token = $request->get('token');

        $uzytkownikRepository = $this->getUzytkownikRepository();

        $uzytkownik = $uzytkownikRepository->findOneBy(['kodZapomnianeHaslo' => $token]);
        if (is_null($uzytkownik)) {
            return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Link do zmiany hasła został użyty i stracił ważność.'));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $resetPassword = $form->getData();

            $options = [
                'cost' => 12,
            ];
            $haslo = password_hash($resetPassword->getNewPassword(), PASSWORD_BCRYPT, $options);
            $uzytkownik->setHaslo($haslo);
            $uzytkownik->setKodZapomnianeHaslo(null);
            $uzytkownikRepository->persist($uzytkownik);

            return $this->render('SsfzBundle:Security:passwordRecoverInfo.html.twig', array('info' => 'Hasło zostało zmienione, zaloguj się do serwisu.'));
        }

        return $this->render(
            'SsfzBundle:Security:passwordReset.html.twig', array(
                'form' => $form->createView(),
                'error' => '',
                'title' => 'Odzyskiwanie hasła',
                'submitButtonName' => 'Zapisz'
            )
        );
    }

    /**
     * Metoda do zmiany hasła.
     * 
     * @Route("/haslo/zmiana")
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $resetPassword = new ChangePassword();
        $form = $this->createForm(new ChangePasswordType(), $resetPassword);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $resetPassword = $form->getData();

            /* @var $uzytkownik Uzytkownik */
            $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();

            $options = [
                'cost' => 12,
            ];
            $haslo = password_hash($resetPassword->getNewPassword(), PASSWORD_BCRYPT, $options);

            if (password_verify($resetPassword->getOldPassword(), $uzytkownik->getHaslo())) {
                $uzytkownik->setHaslo($haslo);

                /* @var $uzytkownikRepository UzytkownikRepository */
                $uzytkownikRepository = $this->getUzytkownikRepository();
                $uzytkownikRepository->persist($uzytkownik);
                $komInfo = array(
                    'message' => 'Hasło zostało zmienione.',
                    'alert' => 'success',
                    'title' => ''
                );
                $this->get('session')->getFlashBag()->add(
                    'notice', $komInfo
                );

                return $this->redirect(($this->generateUrl('default')));
            }

            return $this->render(
                'SsfzBundle:Security:passwordReset.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Aktualne hasło nie zgadza się.',
                    'title' => 'Zmiana hasła',
                    'submitButtonName' => 'Zmień hasło'
                )
            );
        }

        return $this->render(
            'SsfzBundle:Security:passwordReset.html.twig', array(
                'form' => $form->createView(),
                'error' => '',
                'title' => 'Zmiana hasła',
                'submitButtonName' => 'Zmień hasło'
            )
        );
    }

    /**
     * Załadowanie repozytorium użytkowników.
     * 
     * @return UzytkownikRepository
     */
    protected function getUzytkownikRepository()
    {
        return $this->get('ssfz.service.uzytkownik_service')->getUzytkownikRepository();
    }

    /**
     * Załadowanie serwisu MailerService
     * odpowiedzialnego za wysyłkę powiadomień
     * 
     * @return MailerService
     */
    protected function getMailerService()
    {
        return $this->get('ssfz.service.mailer_service');
    }
}
