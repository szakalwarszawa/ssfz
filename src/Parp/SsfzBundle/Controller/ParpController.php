<?php

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use Carbon\Carbon;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Entity\SprawozdanieSpolki;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Entity\Slownik\StatusSprawozdania;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Spolka;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;
use Parp\SsfzBundle\Entity\DanePozyczek;
use Parp\SsfzBundle\Entity\DanePoreczen;
use Parp\SsfzBundle\Form\Type\SpolkaType;
use Parp\SsfzBundle\Form\Type\SprawozdanieOcenType;
use Parp\SsfzBundle\Form\Type\SprawozdanieZalazkoweType;
use Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType;

/**
 * @Route("/parp", name="parp")
 */
class ParpController extends Controller
{
    /**
     * Akcja domyślana - wyświetla panel kontroli sprawozdawczości
     *
     * @Route("", name="parp")
     *
     * @return Response
     */
    public function indexAction()
    {
        $this
            ->get('ssfz.service.datatable_parp_service')
            ->datatableParp()
        ;
        
        return $this->render('SsfzBundle:Parp:index.html.twig');
    }

    /**
     * Akcja oceń sprawozdanie
     *
     * @param Request $request request
     * @param Umowa $umowa
     * @param int $idSprawozdania identyfikator sprawozdania
     *
     * @Route("/ocen/{umowa}/{idSprawozdania}", name="ocen")
     *
     * @return Response
     */
    public function ocenAction(Request $request, Umowa $umowa, $idSprawozdania)
    {
        $uzytkownik = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $program = $umowa->getBeneficjent()->getProgram();
        $klasaEncji = Program::jakaEncjaDlaProgramu($program);
        $klasaFormularza = Program::jakiFormularzDlaProgramu($program);
        $repoSprawozdanie = $entityManager->getRepository($klasaEncji);
        
        $sprawozdanie = $repoSprawozdanie->find($idSprawozdania);
        if (null == $sprawozdanie) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Nie znaleziono sprawozdania o podanym identyfikatorze.')
            ;
            return $this->redirectToRoute('parp');
        }

        $sprawozdaniePrzeslano = ($sprawozdanie->getStatus() === StatusSprawozdania::PRZESLANO_DO_PARP);
        if (!$sprawozdaniePrzeslano) {
            $this->addFlash('notice', [
                'alert'   => 'warning',
                'title'   => '',
                'message' => 'Sprawozdanie nie ma statusu "przesłane". Ocena sprawozdania z innym statusem jest ' .
                'niemożliwa.'
            ]);
            return $this->redirectToRoute('parp_sprawozdanie', [
                'idSprawozdania' => $idSprawozdania,
                'idUmowy'        => $umowa->getId(),
            ]);
        }
    
        $przypisanoOceniajacego = (null !== $sprawozdanie->getOceniajacyId());
        $uzytkownikNieJestOceniajacym = ($uzytkownik->getId() !== $sprawozdanie->getOceniajacyId());
        if ($sprawozdaniePrzeslano && $przypisanoOceniajacego && $uzytkownikNieJestOceniajacym) {
            $this->addFlash('notice', [
                'alert'   => 'warning',
                'title'   => '',
                'message' => 'Sprawozdanie jest zajęte do oceny przez innego użytkownika.'
            ]);
            return $this->redirectToRoute('parp_sprawozdanie', [
                'idSprawozdania' => $idSprawozdania,
                'idUmowy'        => $umowa->getId(),
            ]);
        }

        $okresy = $this->getOkresySprawozdawcze();
        $formOkresy = $this->createForm($klasaFormularza, $sprawozdanie, [
            'disabled' => true,
            'program'  => $program,
            'lata'     => $okresy,
        ]);

        $przeplyw = $entityManager
            ->getRepository(PrzeplywFinansowy::class)
            ->findOneByIdSprawozdania($idSprawozdania)
        ;
        $formPrzeplywyFinansowe = null;
        if ($przeplyw != null) {
            $formPrzeplywyFinansowe = $this->createForm(PrzeplywFinansowyType::class, $przeplyw, [
                'disabled' => true,
            ])->createView();
        }

        $sprawozdanie->setOceniajacyId($uzytkownik->getId());
        $form = $this->createForm(SprawozdanieOcenType::class, $sprawozdanie);
        $repoSprawozdanie->persist($sprawozdanie);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if ($sprawozdanie->getStatus() === StatusSprawozdania::PRZESLANO_DO_PARP) {
                    $sprawozdanie->setOceniajacyId(null);
                }
                if ($sprawozdanie->getStatus() !== StatusSprawozdania::PRZESLANO_DO_PARP) {
                    $sprawozdanie->setDataZatwierdzenia(new Carbon('Europe/Warsaw'));
                }
                $repoSprawozdanie->persist($sprawozdanie);

                return $this->redirectToRoute('parp');
            }
        }

        $sprawozdaniaSpolek = null;
        $przeplywFinansowy = null;
        if ($program->czyFunduszZalazkowy()) {
            $przeplywFinansowy = $entityManager
                ->getRepository(PrzeplywFinansowy::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;
            $sprawozdaniaSpolek = $entityManager
                ->getRepository(SprawozdanieSpolki::class)
                ->findByIdSprawozdania($idSprawozdania)
            ;
        }

        $danePozyczek = null;
        $danePozyczekZagregowane = null;
        if ($program->czyFunduszPozyczkowy()) {
            $danePozyczek = $entityManager
                ->getRepository(DanePozyczek::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;

            $danePozyczekZagregowane = $entityManager
                ->getRepository(DanePozyczek::class)
                ->findDaneZagregowaneByIdSprawozdania($idSprawozdania)
            ;
        }

        $danePoreczen = null;
        if ($program->czyFunduszPoreczeniowy()) {
            $danePoreczen = $entityManager
                ->getRepository(DanePoreczen::class)
                ->findOneByIdSprawozdania($idSprawozdania)
            ;
        }

        return $this->render('SsfzBundle:Parp:ocen.html.twig', [
            'form'                      => $form->createView(),
            'form_okresy'               => $formOkresy->createView(),
            'form_przeplywy_finansowe'  => $formPrzeplywyFinansowe,
            'program'                   => $program,
            'sprawozdanie'              => $sprawozdanie,
            'sprawozdania_spolek'       => $sprawozdaniaSpolek,
            'przeplyw_finansowy'        => $przeplywFinansowy,
            'dane_pozyczek'             => $danePozyczek,
            'dane_pozyczek_zagregowane' => $danePozyczekZagregowane,
            'dane_poreczen'             => $danePoreczen,
        ]);
    }

    /**
     * Wyświetla podgląd sprawozdania.
     *
     * Identyfikator umowy jest konieczny do określenia, którego z programów dotyczy sprawozdanie
     * (oraz jakiej klasy obiekty używać i gdzie są przechowywane w bazie danych).
     * Wcześniej SSFZ obsługiwało jeden program i identyfikator sprawozdania był informacją
     * jednoznaczną.
     *
     * @param int $idUmowy
     * @param int $idSprawozdania
     *
     * @Route("/sprawozdanie/{idUmowy}/{idSprawozdania}", name="parp_sprawozdanie")
     *
     * @return Response
     */
    public function sprawozdanieAction($idUmowy, $idSprawozdania)
    {
        try {
            $report = $this
                ->get('ssfz.service.podglad_sprawozdania')
                ->findSprawozdanie($idUmowy, $idSprawozdania)
                ->generujSprawozdanieSpo()
            ;
        } catch (EntityNotFoundException $exception) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Nie znaleziono sprawozdania o podanym identyfikatorze.')
            ;

            return $this->redirectToRoute('parp');
        }

        return new Response($report);
    }

    /**
     * Akcja podglądu profilu beneficjenta
     *
     * @param int $idBeneficjenta identyfikator profilu beneficjenta
     *
     * @Route("/beneficjent/{idBeneficjenta}", name="parp_beneficjent")
     *
     * @return Response
     */
    public function beneficjentAction($idBeneficjenta)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $beneficjent = $entityManager->getRepository(Beneficjent::class)->find($idBeneficjenta);
        if (null == $beneficjent) {
            $this->get('ssfz.service.komunikaty_service')->bladKomunikat('Nie znaleziono beneficjenta o podanym ' .
            'identyfikatorze.');
            return $this->redirectToRoute('parp');
        }
        $this->get('ssfz.service.datatable_osoby_service')->datatableOsoby($this, $beneficjent->getId())->execute();

        return $this->render('SsfzBundle:Parp:beneficjent.html.twig', [
            'beneficjent' => $beneficjent,
        ]);
    }

    /**
     * Akcja pobrania danych do tabeli spółek
     *
     * @param int $idUmowy identyfikator umowy
     *
     * @Route("/gridSpolki/{idUmowy}", name="parp_datatableSpolki")
     *
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function spolkiGridAction($idUmowy)
    {
        $umowa = $this->getDoctrine()->getRepository(Umowa::class)->find($idUmowy);
        if (!$umowa) {
            throw new NotFoundHttpException('Nie znaleziono umowy o przekazanym identyfikatorze.');
        }
        $umowaId = $umowa->getId();

        return $this
            ->get('ssfz.service.datatable_spolki_service')
            ->datatableSpolki($this, $umowaId)
            ->execute()
        ;
    }

    /**
     * Akcja wyświetlenia portfela spółek
     *
     * @param int $idUmowy identyfikator umowy
     *
     * @Route("/portfel/{idUmowy}", name="parp_portfel")
     *
     * @return Response
     */
    public function portfelAction($idUmowy)
    {
        $umowa =  $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Umowa::class)
            ->find($idUmowy)
        ;
        if (null === $umowa) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Nie znaleziono umowy o podanym identyfikatorze.')
            ;
            return $this->redirectToRoute('parp');
        }

        $this
            ->get('ssfz.service.datatable_spolki_service')
            ->datatableSpolki($this, $umowa->getId())->execute()
        ;
        $spolka = new Spolka();
        $form = $this->createForm(SpolkaType::class, $spolka, [
            'disabled'      => true,
            'narzedzia_svc' => $this->get('ssfz.service.narzedzia_service'),
        ]);

        return $this->render('SsfzBundle:Parp:portfel.html.twig', [
            'umowa'             => $umowa,
            'beneficjent_nazwa' => $umowa->getBeneficjent()->getNazwa(),
            'form'              => $form->createView(),
        ]);
    }

    /**
     * Akcja pobierająca dane do tabeli Osoby zatrudnione
     *
     * @param int $idBeneficjenta identyfikator profilu beneficjenta
     *
     * @Route("/gridOsoby/{idBeneficjenta}", name="parp_datatableOsoby")
     *
     * @return Response
     */
    public function osobyGridAction($idBeneficjenta)
    {
        return $this
            ->get('ssfz.service.datatable_osoby_service')
            ->datatableOsoby($this, $idBeneficjenta)
            ->execute()
        ;
    }

    /**
     * Akcja pobrania danych do tabeli kontroli sprawozdawczości
     *
     * @Route("/gridParp", name="datatableParp")
     *
     * @param int $idProgramu
     *
     * @return Response
     */
    public function parpGridAction()
    {
        return $this
            ->get('ssfz.service.datatable_parp_service')
            ->datatableParp()
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
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        if (!$uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }

     /**
     * Metoda umożliwia pobranie okresów sprawozdawczych z bazy danych
     *
     * @return array
     */
    private function getOkresySprawozdawcze()
    {
        $array = [];
        $entityManager = $this->getDoctrine()->getManager();
        $okresySprawozdawcze = $entityManager
            ->getRepository(OkresyKonfiguracja::class)
            ->findBy([], ['rok' => 'ASC'])
        ;
        foreach ($okresySprawozdawcze as $okres) {
            $array[$okres->getRok()]  = $okres->getRok();
        }

        return $array;
    }

    /**
     * Zmienia obsługiwany program.
     *
     * @Route("/program/{id}", name="przelacz_program")
     *
     * @param int $id ID programu.
     *
     * @return Response
     */
    public function przelaczProgramAction(int $id)
    {
        $this
            ->get('ssfz.service.wybor_programu')
            ->setProgram($id)
        ;

        return $this->indexAction();
    }

    /**
     * Akcja do użytku testowego. Pomijając uprawnienia wyświetla podgląd danych pożyczek dla
     * sprawozdania o zadanym ID.
     *
     * @Route("/pozyczki/podglad/{idSprawozdania}", name="parp_pozyczki_podlglad")
     *
     * @return Response
     */
    public function pozyczkiPodgladAction($idSprawozdania)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $danePozyczek = $entityManager
            ->getRepository(DanePozyczek::class)
            ->findOneByIdSprawozdania($idSprawozdania)
        ;
        if (null == $danePozyczek) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Nie znaleziono danych pożyczek dla sprawozdania o ID:' . (string) $idSprawozdania .
                '.')
            ;

            return $this->redirectToRoute('parp');
        }

        return $this->render('SsfzBundle:Sprawozdanie:dane_pozyczek_odczyt.html.twig', [
            'dane_pozyczek' => $danePozyczek,
        ]);
    }
}
