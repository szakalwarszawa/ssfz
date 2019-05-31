<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Form\Type\SpolkaType;
use Parp\SsfzBundle\Entity\Spolka;
use Parp\SsfzBundle\Entity\Umowa;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Kontroler obsługujący funkcjonalności po stronie Beneficjenta
 */
class PortfelController extends Controller
{
    /**
     * Akcja główna - wyświetla formularz dodania/edycji spółki, oraz listę spółek
     *
     * @param Request $request
     * @param int     $idUmowy
     * @param int     $idSpolki
     *
     * @Route("/portfel/{idUmowy}",            name="portfel_dodanie")
     * @Route("/portfel/{idUmowy}/{idSpolki}", name="portfel_edycja")
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function indexAction(Request $request, $idUmowy, $idSpolki = null)
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        if (!$beneficjent) {
            throw new NotFoundHttpException('Profil beneficjenta nie został znaleziony');
        }
        $umowa = $this->getDoctrine()->getRepository(Umowa::class)->find($idUmowy);
        if (!$umowa) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono umowy o przekazanym identyfikatorze.');

            return $this->redirectToRoute('beneficjent');
        }
        if (false === $beneficjent->getUmowy()->contains($umowa)) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Brak dostępu do umowy o podanym identyfikatorze.');

            return $this->redirectToRoute('beneficjent');
        }
        $spolkaP = null;
        if (!$idSpolki) {
            $spolka = new Spolka();
            $spolka->setUmowa($umowa);
            $umowa->addSpolka($spolka);
        }
        if ($idSpolki) {
            $spolka = $this->getDoctrine()->getRepository(Spolka::class)->find($idSpolki);
            $spolkaP = clone $spolka;
        }
        $form = $this->createForm(SpolkaType::class, $spolka, array('narzedzia_svc' => $this->get('ssfz.service.narzedzia_service')));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isValid()) {
                $this->getDoctrine()->getRepository(Spolka::class)->persistSpolka($spolka, $spolkaP, $uzytkownik->getId());
                $this->get('ssfz.service.komunikaty_service')->sukcesKomunikat('Dane zostały zapisane.');
                if ('beneficjent' === $form['przekierowanie']->getData()) {
                    return $this->redirectToRoute('beneficjent');
                }

                return $this->redirectToRoute('portfel_dodanie', array('idUmowy' => $idUmowy));
            } else {
                $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Formularz nie został poprawnie wypełniony.');
            }
        }
        $this->get('ssfz.service.datatable_spolki_service')->datatableSpolki($this, $umowa->getId());

        return $this->render(
            'SsfzBundle:Portfel:index.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Akcja pobrania danych do tabeli spółek
     *
     * @param int $idUmowy identyfikator umowy
     *
     * @Route("/gridSpolki/{idUmowy}", name="datatableSpolki")
     *
     * @throws NotFoundHttpException
     * @throws AccessDeniedException
     *
     * @return Response
     */
    public function spolkiGridAction($idUmowy)
    {
        $umowa= $this->getDoctrine()->getRepository(Umowa::class)->find($idUmowy);
        if (!$umowa) {
            throw new NotFoundHttpException('Nie znaleziono umowy o przekazanym identyfikatorze.');
        }
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();

        if (false === $beneficjent->getUmowy()->contains($umowa)) {
            throw new AccessDeniedHttpException('Brak dostępu do umowy o podanym identyfikatorze.');
        }
        $umowaId = $umowa->getId();

        return $this->get('ssfz.service.datatable_spolki_service')->datatableSpolki($this, $umowaId)->execute();
    }

    /**
     * Pobiera zalogowanego użytkownika
     *
     * @throws AccessDeniedException
     *
     * @return Uzytkownik
     */
    protected function getZalogowanyUzytkownik()
    {
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        if (!$uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }
}
