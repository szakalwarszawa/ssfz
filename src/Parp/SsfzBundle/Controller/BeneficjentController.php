<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Form\Type\BeneficjentType;

/**
 * Kontroler obsługujący funkcjonalności po stronie Beneficjenta
 *
 * @Route("/beneficjent", name="beneficjent")
 */
class BeneficjentController extends Controller
{
    /**
     * Akcja domyślna.
     *
     * Wwyświetla widok główny lub (w przypadku gdy użytkownik nie ma profilu beneficjenta)
     * przekierowuje do uzupełnienia profilu.
     *
     * @Route("", name="beneficjent")
     *
     * @return Response
     */
    public function indexAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();

        $pracownikParp = $uzytkownik->czyPracownikParp();
        if ($pracownikParp) {
            return $this->redirectToRoute('parp');
        }

        $aktywnyProgram = ($uzytkownik->getAktywnyProgram() !== null);
        if (!$pracownikParp && !$aktywnyProgram) {
            return $this->redirectToRoute('uzytkownik_lista_programow');
        }
        
        $beneficjent = $uzytkownik->getBeneficjent();
        if (!$beneficjent || !$beneficjent->getWypelniony()) {
            return $this->redirectToRoute('beneficjent_uzupelnij');
        }

        $this
            ->get('ssfz.service.datatable_osoby_service')
            ->datatableOsoby($this, $beneficjent->getId())
        ;

        $this
            ->get('ssfz.service.datatable_umowy_service')
            ->datatableUmowy($this, $beneficjent->getId())
        ;

        return $this->render('SsfzBundle:Beneficjent:index.html.twig', [
            'beneficjent' => $beneficjent,
        ]);
    }

    /**
     * Akcja uzupełnij profil
     *
     * @Route("/uzupelnij", name="beneficjent_uzupelnij")
     *
     * @return Response
     */
    public function uzupelnijAction()
    {
        return $this->render('SsfzBundle:Beneficjent:uzupelnij.html.twig');
    }

    /**
     * Akcja edycji profilu beneficjenta
     *
     * @param Request $request request
     *
     * @Route("/profil", name="beneficjent_profil")
     *
     * @return Response
     */
    public function profilAction(Request $request)
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        if (!$beneficjent) {
            $beneficjent = $this
                ->get('ssfz.service.beneficjent_service')
                ->addBeneficjent($uzytkownik)
            ;
        }
        $originalUmowy = $this
            ->get('ssfz.service.beneficjent_service')
            ->getBeneficjentUmowy($beneficjent)
        ;
        $originalOsoby = $this
            ->get('ssfz.service.beneficjent_service')
            ->getBeneficjentOsoby($beneficjent)
        ;
        $this
            ->get('ssfz.service.beneficjent_service')
            ->addUmowaOsobaIfEmpty($beneficjent)
        ;

        $form = $this->createForm(BeneficjentType::class, $beneficjent, [
            'program' => $beneficjent->getProgram(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this
                    ->get('ssfz.service.beneficjent_service')
                    ->updateBeneficjent($beneficjent, $originalUmowy, $originalOsoby)
                ;
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Dane zostały zapisane.')
                ;
                return $this->redirectToRoute('beneficjent');
            } else {
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat('Formularz nie został poprawnie wypełniony.')
                ;
            }
        }

        return $this->render('SsfzBundle:Beneficjent:profil.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Akcja pobierająca dane do tabeli Osoby zatrudnione
     *
     * @Route("/gridOsoby", name="datatableOsoby")
     *
     * @return Response
     */
    public function osobyGridAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();

        return $this
            ->get('ssfz.service.datatable_osoby_service')
            ->datatableOsoby($this, $beneficjentId)
            ->execute()
        ;
    }
    /**
     * Akcja pobierająca dane do tabeli Umowy
     *
     * @Route("/gridUmowy", name="datatableUmowy")
     *
     * @return Response
     */
    public function umowyGridAction()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();

        return $this
            ->get('ssfz.service.datatable_umowy_service')
            ->datatableUmowy($this, $beneficjentId)
            ->execute()
        ;
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
        $uzytkownik = $this
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
        ;
        if (null === $uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }
}
