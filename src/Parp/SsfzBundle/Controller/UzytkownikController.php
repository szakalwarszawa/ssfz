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
class UzytkownikController extends Controller {

    /**
     * Metoda rejestracji użytkownika
     * 
     * @param Request $request
     * 
     * @Route("/rejestracja", name="rejestracja_konta_beneficjenta")
     * 
     * @return Response
     */
    public function rejestracja(Request $request) {
        $uzytkownik = new Uzytkownik();
        $form = $this->createForm(UzytkownikType::class, $uzytkownik);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $komunikatyService = $this->get('ssfz.service.komunikaty_service');
            $uzytkownikService = $this->get('ssfz.service.uzytkownik_service');
            $rolaService = $this->get('ssfz.service.rola_service');
            $mailerService = $this->get('ssfz.service.mailer_service');
            $uzytkownik = $form->getData();
            $uzytkownikRepository = $uzytkownikService->getUzytkownikRepository();
            if (is_null($uzytkownikRepository->findOneBy(['email' => $uzytkownik->getEmail()])) &&
                    is_null($uzytkownikRepository->findOneBy(['login' => $uzytkownik->getLogin()]))) {
                try {
                    $uzytkownikService->persistNewUser($uzytkownik, $rolaService->findOneByCriteria(['nazwa' => 'ROLE_BENEFICJENT']));
                    $mailerService->sendMail($uzytkownik, 'Utworzono konto', '@SsfzBundle/Resources/views/Email/registration.html.twig', array('code' => $uzytkownik->getKodAktywacjaKonta(), 'login' => $uzytkownik->getLogin()));
                } catch (Exception $ex) {
                    $komunikatyService->bladKomunikat('Rejestracja nie powiodła się. Spróbuj ponownie.');

                    return $this->render('SsfzBundle:Beneficjent:rejestracja.html.twig', array('form' => $form->createView()));
                }

                return $this->render('SsfzBundle:Beneficjent:rejestracjaSukces.html.twig');
            }
            $komunikatyService->bladKomunikat('Użytkownik istnieje w bazie danych');
        }

        return $this->render('SsfzBundle:Beneficjent:rejestracja.html.twig', array('form' => $form->createView()));
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
    public function aktywacjaKonta(Request $request) {
        $token = $request->get('token');
        $uzytkownikService = $this->get('ssfz.service.uzytkownik_service');
        $komunikatyService = $this->get('ssfz.service.komunikaty_service');
        $uzytkownik = $uzytkownikService->findOneByCriteria(['kodAktywacjaKonta' => $token]);
        if (is_null($uzytkownik)) {
            return $this->render('SsfzBundle:Security:activationFail.html.twig');
        }
        $uzytkownikService->activateUserAccount($uzytkownik);
        $komunikatyService->sukcesKomunikat('Konto zostało aktywowane. Proszę zalogować się.');


        return $this->redirectToRoute('login');
    }

}
