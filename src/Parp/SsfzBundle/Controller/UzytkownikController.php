<?php
namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Form\Type\UzytkownikType;
use Parp\SsfzBundle\Entity\Rola;

/**
 * Kontroler obsługujący funkcjonalności po stronie Użytkownika
 * 
 * @category Class
 * @package  SsfzBundle
 * @link     http://zeto.bialystok.pl
 * 
 * @Route("/uzytkownik")
 */
class UzytkownikController extends Controller
{

    /**
     * Metoda rejestracji użytkownika
     * 
     * @param Request $request
     * 
     * @Route("/rejestracja")
     * 
     * @return Response
     */
    public function rejestracja(Request $request)
    {
        $uzytkownik = new Uzytkownik();

        $form = $this->createForm(UzytkownikType::class, $uzytkownik);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownik = $form->getData();
            $em = $this->getDoctrine()->getManager();
            /* @var $uzytkownikRepository UzytkownikRepository */
            $uzytkownikRepository = $this->getUzytkownikRepository();

            $rolaRepository = $this->getRolaRepository();

            $rolaBeneficjent = $rolaRepository->findOneBy(['nazwa' => 'ROLE_BENEFICJENT']);

            $uzytkownik->setRola($rolaBeneficjent);

            $randomHash = base64_encode(random_bytes(64));
            $randomHash = str_replace(array('/', '+', '='), '', $randomHash);

            $uzytkownik->setKodAktywacjaKonta($randomHash);

            //$notExist = $uzytkownikRepository->findOneBy(['email' => $uzytkownik->getEmail()]) == null ? true : false;
            //$notExist = $uzytkownikRepository->findOneBy(['login' => $uzytkownik->getLogin()]) == null ? true : false;

            if (is_null($uzytkownikRepository->findOneBy(['email' => $uzytkownik->getEmail()])) && is_null($uzytkownikRepository->findOneBy(['login' => $uzytkownik->getLogin()]))) {
                $topic = 'Utworzono konto';
                $template = '@SsfzBundle/Resources/views/Email/registration.html.twig';
                $templateParams = array(
                    'code' => $uzytkownik->getKodAktywacjaKonta(),
                    'login' => $uzytkownik->getLogin());
                try {
                    $this->getMailerService()->sendMail($uzytkownik, $topic, $template, $templateParams);
                    $uzytkownikRepository->persist($uzytkownik);
                } catch (Exception $ex) {
                    $komInfo = array(
                        'message' => 'Rejestracja nie powiodła się. Spróbuj ponownie.',
                        'alert' => 'danger',
                        'title' => ''
                    );
                    $this->get('session')->getFlashBag()->add(
                        'notice', $komInfo
                    );

                    return $this->render('SsfzBundle:Beneficjent:rejestracja.html.twig', array(
                            'form' => $form->createView(),
                            )
                    );
                }

                return $this->render('SsfzBundle:Beneficjent:rejestracjaSukces.html.twig');
            }

            $komInfo = array(
                'message' => 'Użytkownik istnieje w bazie danych',
                'alert' => 'danger',
                'title' => ''
            );
            $this->get('session')->getFlashBag()->add(
                'notice', $komInfo
            );

            return $this->render('SsfzBundle:Beneficjent:rejestracja.html.twig', array(
                    'form' => $form->createView(),
                    )
            );
        }

        return $this->render('SsfzBundle:Beneficjent:rejestracja.html.twig', array(
                'form' => $form->createView()
                )
        );
    }

    /**
     * Metoda aktywacji konta użytkownika
     * 
     * @param Request $request
     * 
     * @Route("/aktywacja/token={token}")
     * 
     * @return Response
     */
    public function aktywacjaKonta(Request $request)
    {
        $token = $request->get('token');
        /* @var $uzytkownikRepository UzytkownikRepository */
        $uzytkownikRepository = $this->getUzytkownikRepository();
        $uzytkownik = $uzytkownikRepository->findOneBy(['kodAktywacjaKonta' => $token]);

        /* @var $uzytkownik Uzytkownik */
        if (!is_null($uzytkownik)) {
            $uzytkownik->setStatus(1);
            $uzytkownik->setKodAktywacjaKonta(null);
            $uzytkownikRepository->persist($uzytkownik);

            $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Konto zostało aktywowane. Proszę zalogować się.');

            return $this->redirectToRoute('login');
        }

        return $this->render('SsfzBundle:Security:activationFail.html.twig');
    }

    /**
     * Metoda pobierająca repozytorium użytkownika
     * 
     * @return UzytkownikRepository
     */
    protected function getUzytkownikRepository()
    {
        return $this->get('ssfz.service.uzytkownik_service')->getUzytkownikRepository();
    }

    /**
     * Metoda pobierająca repozytorium ról    
     *  
     * @return RolaRepository
     */
    protected function getRolaRepository()
    {
        return $this->get('ssfz.service.uzytkownik_service')->getRolaRepository();
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
