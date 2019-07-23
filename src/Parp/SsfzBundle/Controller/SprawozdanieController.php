<?php

namespace Parp\SsfzBundle\Controller;

use DateTime;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Entity\Slownik\StatusSprawozdania;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;
use Parp\SsfzBundle\Entity\Report;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Spolka;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\SprawozdanieSpolki;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;
use Parp\SsfzBundle\Exception\PublicVisibleExcpetion;
use Parp\SsfzBundle\Form\Type\SprawozdanieType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePozyczkoweType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePoreczenioweType;
use Parp\SsfzBundle\Form\Type\DodanieSprawozdaniaSpoType;
use Parp\SsfzBundle\Service\TypSprawozdaniaGuesserService;

/**
 * Kontroler obsługujący funkcjonalności Sprawozdania
 */
class SprawozdanieController extends Controller
{
    /**
     * Akcja rejestracji sprawozdania
     *
     * @param Request $request
     * @param int $umowaId
     *
     * @Route("sprawozdanie/rejestracja/{umowaId}", name="sprawozdanie_rejestracja")
     *
     * @return Response
     */
    public function indexAction(Request $request, $umowaId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $umowa = $entityManager->getRepository(Umowa::class)->find($umowaId);
        $program = $umowa->getBeneficjent()->getProgram();
        $this->getUser()->setAktywnyProgram($program);
        $beneficjent = $umowa->getBeneficjent();
        $beneficjentId = $beneficjent->getId();
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->datatableSprawozdanie($this, $umowa)
        ;
        $report = new SprawozdanieZalazkowe();
        $report->setNumerUmowy($this->getNumerUmowy($umowaId, $beneficjentId));
        $report->setUmowa($umowa);
        $spolki = $this->getSpolkiList($umowaId);
        $report = $this->setSpolki($spolki, $report);
        $okresy = $this->getOkresySprawozdawcze();

        $form = $this->createForm(SprawozdanieType::class, $report, [
            'lata'    => $okresy,
            'program' => $program,
        ]);
        if (count($spolki) === 0 && true === $beneficjent->getProgram()->czyJestPortfelSpolek()) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Aby dodać sprawozdanie należy wprowadzić dane spółek.', 'Uwaga!')
            ;
            return $this->pokazFormularzRejestracji($form, 'not_allowed', $umowaId);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                return $this->pokazFormularzRejestracji($form, 'create', $umowaId);
            }
            $report = $this->setDefaultValues($report, $umowa, $beneficjentId);
            $entityManager->persist($report);
            $entityManager->flush();
            if ($form['przekierowanie']->getData() == 'beneficjent') {
                return $this->redirectToRoute('beneficjent');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', ['umowaId' => (string) $umowaId]);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Formularz nie został poprawnie wypełniony.')
            ;
        }

        return $this->pokazFormularzRejestracji($form, 'create', $umowaId);
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
     * @Route("sprawozdanie/podglad/{reportId}", name="sprawozdanie_podglad")
     *
     * @param int $reportId
     *
     * @return Response
     *
     * @throws Exception
     */
    public function podgladAction($reportId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $entityManager = $this->getDoctrine()->getManager();
        $report = $entityManager->getRepository(SprawozdanieZalazkowe::class)->find($reportId);
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->checkSprawozdaniePermission($report, $beneficjentId)
        ;
        $okresy = $this->getOkresySprawozdawcze();
        $form = $this->createForm(SprawozdanieType::class, $report, [
            'read_only' => true,
            'lata'      => $okresy,
            'program'   => $report->getUmowa()->getBeneficjent()->getProgram(),
        ]);

        return $this->pokazFormularzRejestracji($form, 'read', $report->getUmowaId());
    }

    /**
     * @Route("sprawozdanie/edycja/{umowaId}/{reportId}", name="sprawozdanie_zalazkowe_edycja")
     *
     * @param Request $request
     * @param int     $umowaId
     * @param int     $reportId
     *
     * @return Response
     *
     * @throws Exception
     */
    public function edycjaAction(Request $request, $umowaId, $reportId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $entityManager = $this->getDoctrine()->getManager();
        $report = $entityManager->getRepository(SprawozdanieZalazkowe::class)->find($reportId);
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->checkSprawozdaniePermission($report, $beneficjentId)
        ;
        if ($report->getStatus() != 1) {
            throw $this->createNotFoundException('Nie można edytować sprawozdania');
        }
        $umowaId = $report->getUmowaId();
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->datatableSprawozdanie($this, $report->getUmowa())
        ;
        $okresy = $this->getOkresySprawozdawcze();

        if ($request->query->get('odswiezSpolki') !== null) {
            $spolki = $this->getSpolkiList($umowaId);
            $report = $this->setSpolki($spolki, $report);
        }

        $form = $this->createForm(SprawozdanieType::class, $report, [
            'lata'    => $okresy,
            'program' => $report->getUmowa()->getBeneficjent()->getProgram(),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                return $this->pokazFormularzRejestracji($form, 'edit', $umowaId);
            }
            $entityManager->flush();
            $this
                ->get('ssfz.service.komunikaty_service')
                ->sukcesKomunikat('Edycja sprawozdania zakończyła się powodzeniem', 'Edycja sprawozdania')
            ;
            if ($form['przekierowanie']->getData() == 'beneficjent') {
                return $this->redirectToRoute('beneficjent');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', ['umowaId' => (string) $umowaId]);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Formularz nie został poprawnie wypełniony.')
            ;
        }

        return $this->pokazFormularzRejestracji($form, 'edit', $umowaId);
    }























    /**
     * @Route("sprawozdanie/poprawa/{umowaId}/{sprawozdanieId}", name="sprawozdanie_poprawa")
     *
     * @param Request $request
     * @param int $umowaId
     * @param int $reportId
     *
     * @return Response
     *
     * @throws Exception
     */
    public function poprawAction(Request $request, int $umowaId, int $sprawozdanieId)
    {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $report = $this
            ->get('ssfz.service.repository.sprawozdanie')
            ->findByIdUmowyAndIdSprawozdania($umowaId, $sprawozdanieId)
        ;

        $beneficjentId = $this->getBeneficjentId();
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->checkSprawozdaniePermission($report, $beneficjentId)
        ;

        // Po co to jest do czego tu?
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->datatableSprawozdanie($this, $report->getUmowa())
        ;

        if ((int) $report->getStatus() !== StatusSprawozdania::POPRAWA) {
            throw $this->createNotFoundException('Nie można poprawić sprawozdania.');
        }

        $okresy = $this->getOkresySprawozdawcze();


        // Fajnie, że wiadomo po co to jest robione, bo wygląda jak prowizoryczne naprawienie jakiegoś problemu.
        // To raczej powinno być ogarnięte oddzielną akcją. Teraz są już tu ze 3 niezależne czynności robione.
        if ($request->query->get('odswiezSpolki') !== null) {
            $spolki = $this->getSpolkiList($umowaId);
            $report = $this->setSpolki($spolki, $report);
        }

        $formTypeClass = $this
            ->get('ssfz.service.guesser.typ_sprawozdania')
            ->guessFormType($report)
        ;
        $program = $report
            ->getUmowa()
            ->getBeneficjent()
            ->getProgram()
        ;
        $form = $this->createForm($formTypeClass, $report, [
            'showRemarks' => true,
            'lata'        => $okresy,
            'program'     => $program,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $persist = false;
                $newReport = $this
                    ->get('ssfz.service.object_cloner')
                    ->cloneSprawozdanieDoPoprawy($report, $persist)
                ;

                // TODO: Do tego powinien być napisany walidator a nie spagetti w kontrolerze.
                if (!$this->czySprawozdanieZaDobryOkres($newReport, $umowaId, $beneficjentId)) {
                    $this
                        ->get('ssfz.service.komunikaty_service')
                        ->bladKomunikat('Formularz zawiera nieprawidłowe dane okresu sprawozdawczego.')
                    ;
                    return $this->pokazFormularzRejestracji($form, 'edit', $umowaId);
                }

                $entityManager->persist($newReport);
                $entityManager->flush();

                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Poprawa sprawozdania zakończyła się powodzeniem', 'Poprawa sprawozdania')
                ;

                return $this->redirectToRoute('sprawozdanie_rejestracja', [
                    'umowaId' => (string) $umowaId,
                ]);
            } 

            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Formularz zawiera błędy.')
            ;
        }


        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        if ($typeGuesser->jestPozyczkowe($report)) {
            $template = 'SsfzBundle:Sprawozdanie:pozyczkowe.html.twig';
            return $this->render($template, [
                'sprawozdanie'     => $report,
                'typ_sprawozdania' => TypSprawozdaniaGuesserService::SPRAWOZDANIE_POZYCZKOWE,
                'tylkoDoOdczytu'   => false,
                'form'             => $form->createView(),
            ]);
        }
        
        if ($typeGuesser->jestPoreczeniowe($report)) {
            $template = 'SsfzBundle:Sprawozdanie:poreczeniowe.html.twig';
            return $this->render($template, [
                'sprawozdanie'     => $report,
                'typ_sprawozdania' => TypSprawozdaniaGuesserService::SPRAWOZDANIE_PORECZENIOWE,
                'tylkoDoOdczytu'   => false,
                'form'             => $form->createView(),
            ]);
        }

        if ($typeGuesser->jestZalazkowe($report)) {
            return $this->pokazFormularzRejestracji($form, 'edit', $umowaId);
        }

        $message = 'Nieznany typ sprawozdania. Obsługiwane są tylko sprawozdanie poręczeniowe i pożyczkowe.';
        throw new InvalidArgumentException($message);
    }

























    /**
     * Akcja wysłania sprawozdania do PARP
     *
     * @Route("/sprawozdanie/wyslijDoParp", name="send_to_parp")
     *
     * @return Response
     */
    public function wyslijDoParpAction()
    {
        $sprawozdanieId = $this->get('request')->request->get('sprawozdanieId');
        $beneficjentId = $this->getBeneficjentId();
        $entityManager = $this->getDoctrine()->getManager();
        $sprawozdanie = $entityManager->getRepository(SprawozdanieZalazkowe::class)->find($sprawozdanieId);
        $this
            ->get('ssfz.service.sprawozdanie_service')
            ->checkSprawozdaniePermission($sprawozdanie, $beneficjentId)
        ;

        $przeplyw = $entityManager
            ->getRepository(PrzeplywFinansowy::class)
            ->findOneByIdSprawozdania($sprawozdanieId)
        ;
        $umowaId = $sprawozdanie->getUmowaId();
        if (count($przeplyw) !== 1) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Nie zdefiniowano przepływu finansowego', 'Wysyłka sprawozdania')
            ;

            return $this->redirectToRoute('sprawozdanie_rejestracja', ['umowaId' => (string) $umowaId]);
        }
        if ($this->getRequest()->isMethod('POST') && $sprawozdanie->getStatus() == 1 && $sprawozdanie->getCreatorId() == $beneficjentId) {
            $dateNow = new DateTime('now');
            $sprawozdanie->setStatus(StatusSprawozdania::PRZESLANO_DO_PARP);
            $sprawozdanie->setDataPrzeslaniaDoParp($dateNow);
            $$this
                ->get('ssfz.service.komunikaty_service')
                ->sukcesKomunikat('Sprawozdanie wysłano do PARP', 'Wysyłka sprawozdania')
            ;
        }
        $entityManager->flush();

        return $this->redirectToRoute('sprawozdanie_rejestracja', ['umowaId' => (string) $umowaId]);
    }

    /**
     * Metoda ustawia parametry domyślne dla sprawozdania
     *
     * @param Sprawozdanie $report
     * @param Umowa $umowa
     * @param int $beneficjentId
     *
     * @return Sprawozdanie z ustawionymi parametrami domyślnymi
     */
    public function setDefaultValues($report, $umowa, $beneficjentId = null)
    {
        if (empty($beneficjentId)) {
            $beneficjentId = $umowa->getBeneficjent()->getId();
        }
        
        $report->setCreatorId($beneficjentId);
        $report->setWersja(1);
        $report->setUmowa($umowa);
        $report->setCzyNajnowsza(true);
        $report->setStatus(StatusSprawozdania::EDYCJA);
        $creationDate = new DateTime('now');
        $report->setDataRejestracji($creationDate);

        return $report;
    }

    /**
     * Metoda ustawia spółki
     *
     * @param array $spolki
     * @param Sprawozdanie $report
     *
     * @return Sprawozdanie z ustawionymi spolkami
     */
    public function setSpolki($spolki, $report)
    {

        $counter = 1;
        foreach ($spolki as $spolka) {
            //Dodaj tylko te dla których już nie ma sprawozdań
            if ($report->getSprawozdanieSpolki($spolka->getNazwa()) === null) {
                $sprawozdanieSpolki = new SprawozdanieSpolki();
                $sprawozdanieSpolki->setNazwaSpolki($spolka->getNazwa());
                $sprawozdanieSpolki->setKrs($spolka->getKrs());
                $sprawozdanieSpolki->setLiczbaPorzadkowa($counter);
                $report->addSprawozdaniaSpolek($sprawozdanieSpolki);
            }
            $counter = $counter + 1;
        }

        return $report;
    }

    /**
     * Grid action
     *
     * @Route("/gridSprawozdanie/{umowa}", name="datatableSprawozdanie")
     *
     * @param Umowa $umowa
     *
     * @return Response
     */
    public function sprawozdanieGridAction(Umowa $umowa)
    {
        return $this
            ->get('ssfz.service.sprawozdanie_service')
            ->datatableSprawozdanie($this, $umowa)
            ->execute()
        ;
    }

    /**
     * Metoda zwraca numer umowy
     *
     * @param int $umowaId
     * @param int $beneficjentId
     *
     * @return string numer umowy
     *
     * @throws NotFoundHttpException
     */
    public function getNumerUmowy(int $umowaId, int $beneficjentId)
    {
        $umowa = new Umowa();
        $entityManager = $this->getDoctrine()->getManager();
        $umowa = $entityManager->getRepository(Umowa::class)->find($umowaId);
        $entityManager->flush();
        if ($umowa == null || $umowa->getBeneficjentId() != $beneficjentId) {
            throw $this->createNotFoundException('Nie odnaleziono umowy');
        }

        return $umowa->getNumer();
    }

    /**
     * Metoda zwraca listę spółek dla danej umowy
     *
     * @param int $umowaId
     *
     * @return array
     */
    public function getSpolkiList(int $umowaId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $spolki = $entityManager->getRepository(Spolka::class)->findBy(
            ['umowaId' => $umowaId, 'zakonczona' => 0]
        );
        $entityManager->flush();

        return $spolki;
    }

    /**
     * Metoda sprawdza czy istnieje sprawozdanie za wskazany okres.
     *
     * @param OkresSprawozdawczy $okres
     * @param int $rok
     * @param int $umowaId
     * @param int $beneficjentId
     * @param ?int $editedReportId
     *
     * @return bool
     */
    public function checkSprawozdanieExist(
        OkresSprawozdawczy $okres,
        int $rok,
        int $umowaId,
        int $beneficjentId,
        ?int $editedReportId = null
    ) {
        $entityManager = $this
            ->getDoctrine()
            ->getManager()
        ;

        $report = $entityManager
            ->getRepository(SprawozdanieZalazkowe::class)
            ->findNajnowsze($beneficjentId, $okres->getId(), $rok, $umowaId)
        ;

        if (null !== $report && (int) $report->getId() !== (int) $editedReportId) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat('Sprawozdanie za wskazany okres istnieje w systemie', 'Błąd podczas próby zapisu sprawozdania')
            ;

            return true;
        }

        return false;
    }

    /**
     * Metoda sprawdza czy istnieje możliwość składaniania sprawozdań za wskazany okres
     *
     * @param int $okres
     * @param int $rok
     *
     * @return bool
     */
    public function checkSprawozdanieForGoodPeriod(int $okres, int $rok)
    {
        $czyRokZPrzyszlosci = (int) $rok > (int) date('Y');
        $czyPolroczeZPrzyszlosci = ((int) $rok === (int) date('Y'))
            && (int) $okres === OkresSprawozdawczy::LIPIEC_GRUDZIEN
            && (int) date('m') < 7
        ;
        if ($czyRokZPrzyszlosci || $czyPolroczeZPrzyszlosci) {
            $this
                ->get('ssfz.service.komunikaty_service')
                ->bladKomunikat(
                    'Podano błędny okres lub rok',
                    'Błąd podczas próby zapisu sprawozdania'
                )
            ;
            return false;
        }

        return true;
    }

    /**
     * Pobiera zalogowanego użytkownika
     *
     * @return Uzytkownik
     *
     * @throws AccessDeniedException
     */
    public function getZalogowanyUzytkownik()
    {
        $uzytkownik = $this
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
        ;
        if (!$uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }

    /**
     * Dodaje komunikat błędu????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
     * Ale, że co, że jak? O co chodzi? WTF!?
     *
     * @param Form $form
     * @param string $mode
     * @param int $umowaId
     *
     * @return void
     */
    public function pokazFormularzRejestracji($form, string $mode, int $umowaId)
    {
        return $this->render('SsfzBundle:Report:rejestruj.html.twig', [
            'form'      => $form->createView(),
            'form_mode' => $mode,
            'umowaId'   => $umowaId,
        ]);
    }

    /**
     * Pobiera identyfikator beneficjenta
     *
     * @return Identyfikator beneficjenta
     */
    public function getBeneficjentId()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();

        return $beneficjentId;
    }

    /**
     * Metoda sprawdza czy można złożyć sprawozdanie za zadany okres
     *
     * @param Sprawozdanie $report
     * @param int $umowaId
     * @param int $beneficjentId
     *
     * @return bool
     */
    public function czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)
    {
        $sprawozdanieIstnieje = $this->checkSprawozdanieExist(
            $report->getOkres(),
            $report->getRok(),
            $umowaId,
            $beneficjentId,
            $report->getId()
        );

        $idOkresu = $report->getOkres()->getId();
        $poprawnyOkres = $this->checkSprawozdanieForGoodPeriod($idOkresu, $report->getRok());

        return !$sprawozdanieIstnieje & $poprawnyOkres;
    }

    /**
     * Lista sprawozdań - dla funduszy SPO WKP.
     *
     * @param Request $request
     * @param Umowa $umowa
     *
     * @Route("sprawozdania/spo_lista/{umowa}", name="lista_sprawozdan_spo")
     *
     * @return Response
     */
    public function listaSpoAction(Request $request, Umowa $umowa)
    {
        $umowa->sprawdzCzyUzytkownikMozeWyswietlac($this->getUser());
        
        $entityManager = $this->getDoctrine()->getManager();
        $program = $umowa->getBeneficjent()->getProgram();
        $this->getUser()->setAktywnyProgram($program);

        $czyPozyczkowe = (Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121 === (int) $program->getId());

        $sprawozdanie =
            $czyPozyczkowe
            ? new SprawozdaniePozyczkowe()
            : new SprawozdaniePoreczeniowe()
        ;
        $sprawozdanie = $this->setDefaultValues($sprawozdanie, $umowa);
        $sprawozdanie->setNumerUmowy($umowa->getNumer());
        $okresy = $this->getOkresySprawozdawcze();
        $form = $this->createForm(DodanieSprawozdaniaSpoType::class, $sprawozdanie, [
            'lata'    => $okresy,
            'program' => $program,
        ]);
        
        $program = $umowa->getBeneficjent()->getProgram();
        
        $repoSprawozdanie = $this
            ->get('ssfz.service.sprawozdanie_service')
            ->wyznaczRepozytoriumDlaProgramu($program)
            ->getSprawozdanieRepository()
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $czyTakieJuzIstnieje = $repoSprawozdanie->czyTakieJuzIstnieje($sprawozdanie);
            if ($czyTakieJuzIstnieje) {
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat('Już istnieje sprawozdanie dla tego roku i okresu.')
                ;
            } else {
                $entityManager->persist($sprawozdanie);
                $entityManager->flush();
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat('Dodano nowe sprawozdanie.')
                ;

                $typSprawozdania = $this
                    ->get('ssfz.service.guesser.typ_sprawozdania')
                    ->guess($sprawozdanie)
                ;

                return $this->redirectToRoute('sprawozdania_spo_edycja', [
                    'typSprawozdania' => $typSprawozdania,
                    'sprawozdanieId'  => $sprawozdanie->getId()
                ]);
            }
        } else {
            // Do usunięcia lub przerobienia na excpetion!
            // var_dump((string) $form->getErrors(true, false));
        }
        
        $listaSprawozdan = $repoSprawozdanie->findBy(
            [
                'creatorId' => (int) $umowa->getBeneficjent()->getId(),
                'umowa' => $umowa
            ],
            ['rok' => 'ASC', 'okres' => 'ASC', 'id' => 'ASC']
        );

        $typSprawozdania = $this
            ->get('ssfz.service.guesser.typ_sprawozdania')
            ->guess($sprawozdanie)
        ;

        return $this->render('SsfzBundle:Sprawozdanie:lista_spo.html.twig', [
            'umowa'            => $umowa,
            'typ_sprawozdania' => $typSprawozdania,
            'lista_sprawozdan' => $listaSprawozdan,
            'form'             => $form->createView(),
        ]);
    }

































    /**
     * Edycja sprawozdań pożyczkowych.
     *
     * @Route(
     *      "sprawozdania/spo/edycja/{typSprawozdania}/{sprawozdanieId}",
     *      name="sprawozdania_spo_edycja"
     *  )
     *
     * @param Request $request
     * @param string $typSprawozdania
     * @param int $sprawozdanieId
     *
     * @return Response
     */
    public function edycjaSpoAction(Request $request, string $typSprawozdania, int $sprawozdanieId)
    {
        $sprawozdanie = $this->znajdzSprawozdanie($typSprawozdania, $sprawozdanieId);
        $sprawozdanie->sprawdzCzyUzytkownikMozeEdytowac($this->getUser());
        
        $entityManager = $this->getDoctrine()->getManager();
        $program = $sprawozdanie->getUmowa()->getBeneficjent()->getProgram();
        $this->getUser()->setAktywnyProgram($program);

        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        $klasaFormularza = $typeGuesser->jestPozyczkowe($sprawozdanie)
            ? SprawozdaniePozyczkoweType::class
            : SprawozdaniePoreczenioweType::class
        ;

        $form = $this->createForm(
            $klasaFormularza,
            $sprawozdanie
        );
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $sprawozdanie
                    ->powiazSkladnikiZeSprawozdaniem()
                    ->obliczKapital()
                ;

                $entityManager->flush();
                $komunikat = 'Zapisano zmiany.';
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat($komunikat)
                ;
                
                $czyPowrot = empty($request->get('zapisz'));
                if ($czyPowrot) {
                    return $this->redirectToRoute('lista_sprawozdan_spo', [
                        'umowa' => $sprawozdanie->getUmowa()->getId(),
                    ]);
                } else {
                    return $this->redirectToRoute('sprawozdania_spo_edycja', [
                        'typSprawozdania' => $typSprawozdania,
                        'sprawozdanieId'  => $sprawozdanie->getId()
                    ]);
                }
            } else {
                $bledy = [];
                foreach ($form->all() as $field) {
                    if ($field->getErrors()->count() > 0) {
                        $fieldName = $field->getName();
                        foreach ($field->getErrors() as $error) {
                            $bledy[] = '[' . $fieldName . ']: ' . $error->getMessage();
                        }
                    }
                }

                $komunikat = implode("; \r\n", $bledy);
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat($komunikat)
                ;
            }
        }

        if ($typeGuesser->jestPozyczkowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:pozyczkowe.html.twig';
        } else if ($typeGuesser->jestPoreczeniowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:poreczeniowe.html.twig';
        } else {
            $message = 'Nieznany typ sprawozdania. Obsługiwane są tylko sprawozdanie poręczeniowe i pożyczkowe.';
            throw new InvalidArgumentException($message);
        }

        return $this->render($template, [
            'sprawozdanie'     => $sprawozdanie,
            'typ_sprawozdania' => $typSprawozdania,
            'tylkoDoOdczytu'   => false,
            'form'             => $form->createView(),
        ]);
    }








































    /**
     * Podgląd sprawozdań SPO.
     *
     * @Route("sprawozdania/spo/podglad/{typSprawozdania}/{sprawozdanieId}", name="sprawozdania_spo_podglad")
     *
     * @param string $typSprawozdania
     * ? int $sprawozdanieId
     *
     * @return Response
     */
    public function podgladSpoAction(string $typSprawozdania, int $sprawozdanieId)
    {
        $sprawozdanie = $this->znajdzSprawozdanie($typSprawozdania, $sprawozdanieId);
        $sprawozdanie->sprawdzCzyUzytkownikMozeWyswietlac($this->getUser());
        
        $program = $sprawozdanie->getUmowa()->getBeneficjent()->getProgram();
        $this->getUser()->setAktywnyProgram($program);

        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        $klasaFormularza = $typeGuesser->jestPozyczkowe($sprawozdanie)
            ? SprawozdaniePozyczkoweType::class
            : SprawozdaniePoreczenioweType::class
        ;

        $form = $this->createForm($klasaFormularza, $sprawozdanie, [
            'read_only' => true,
        ]);

        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        if ($typeGuesser->jestPozyczkowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:pozyczkowe.html.twig';
        } else if ($typeGuesser->jestPoreczeniowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:poreczeniowe.html.twig';
        } else {
            $message = 'Nieznany typ sprawozdania. Obsługiwane są tylko sprawozdanie poręczeniowe i pożyczkowe.';
            throw new InvalidArgumentException($message);
        }

        return $this->render($template, [
            'sprawozdanie'     => $sprawozdanie,
            'typ_sprawozdania' => $typSprawozdania,
            'tylkoDoOdczytu'   => true,
            'form'             => $form->createView(),
        ]);
    }























    /**
     * Przesłanie sprawozdania do PARP.
     *
     * @Route(
     *     "sprawozdania/spo/przeslij/{typSprawozdania}/{sprawozdanieId}",
     *     name="sprawozdania_spo_przeslij"
     * )
     *
     * @param string $typSprawozdania
     *? int $sprawozdanieId
     *
     * @return RedirectResponse
     */
    public function przeslijSpoAction(string $typSprawozdania, int $sprawozdanieId)
    {
        $sprawozdanie = $this->znajdzSprawozdanie($typSprawozdania, $sprawozdanieId);
        $sprawozdanie->sprawdzCzyUzytkownikMozeEdytowac($this->getUser());
        // NIEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
        // WTF?!?!?!?!?!??! CO TO NA CO TO PO CO GDZIE JAK!?!
        // TO OZNACZA, ŻE MOŻNA ZAPISAĆ FORMULARZ Z BŁEDAMI!!!!!!!!!!!!
       // if ($sprawozdanie->getCzyDaneSaPrawidlowe()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $sprawozdanie->setStatus(StatusSprawozdania::PRZESLANO_DO_PARP);
            $sprawozdanie->setDataPrzeslaniaDoParp(new DateTime());
            
            $entityManager->flush();
            
            $this
                ->get('ssfz.service.komunikaty_service')
                ->sukcesKomunikat('Przesłano sprawozdanie do PARP.')
            ;
      //  } else {
      //      $message = 'Nie można przesłać sprawozdania do PARP, ponieważ zawiera błędy.'
      //               . ' Proszę uzupełnić i zapisać formularz.';
      //      $this
      //          ->get('ssfz.service.komunikaty_service')
        //        ->bladKomunikat($message)
        //    ;
       // }

        return $this->redirectToRoute('lista_sprawozdan_spo', [
            'umowa' => $sprawozdanie->getUmowa()->getId(),
        ]);
    }




































    /**
     * Ludzie, w jednym kontrolerze poprawAction i poprawaAction? Skąd ktokolwiek ma wiedzieć kiedy użyć które!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * Edycja sprawozdań pożyczkowych.
     *
     * @Route(
     *      "sprawozdania/spo/poprawa/{typSprawozdania}/{sprawozdanieId}",
     *      name="sprawozdania_spo_poprawa"
     *  )
     *
     * @param Request $request
     * @param string $typSprawozdania
     * @param int $sprawozdanieId
     *
     * @return Response|RedirectResponse
     */
    /*
    public function poprawaSpoAction(Request $request, string $typSprawozdania, int $sprawozdanieId)
    {
        $sprawozdanie = $this->znajdzSprawozdanie($typSprawozdania, $sprawozdanieId);
        $sprawozdanie->sprawdzCzyUzytkownikMozePoprawiac($this->getUser());
        
        $entityManager = $this->getDoctrine()->getManager();
        $program = $sprawozdanie->getUmowa()->getBeneficjent()->getProgram();
        $this->getUser()->setAktywnyProgram($program);

        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        $klasaFormularza = $typeGuesser->jestPozyczkowe($sprawozdanie)
            ? SprawozdaniePozyczkoweType::class
            : SprawozdaniePoreczenioweType::class
        ;

        $klonSprawozdania = clone $sprawozdanie;

        $form = $this->createForm($klasaFormularza, $klonSprawozdania);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $klonSprawozdania
                    ->powiazSkladnikiZeSprawozdaniem()
                    ->obliczKapital()
                ;

                $klonSprawozdania = $this->setDefaultValuesAfterRepait($klonSprawozdania, $sprawozdanie);
                $sprawozdanie->setCzyNajnowsza(false);

                $entityManager->persist($klonSprawozdania);
                $entityManager->flush();
                $komunikat = 'Zapisano zmiany.';
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->sukcesKomunikat(
                        'Poprawa sprawozdania zakończyła się powodzeniem',
                        'Poprawa sprawozdania'
                    )
                ;
                
                return $this->redirectToRoute('lista_sprawozdan_spo', [
                    'umowa' => $sprawozdanie->getUmowa()->getId(),
                ]);
            } else {
                $bledy = [];
                foreach ($form->all() as $field) {
                    if ($field->getErrors()->count() > 0) {
                        $fieldName = $field->getName();
                        foreach ($field->getErrors() as $error) {
                            $bledy[] = '[' . $fieldName . ']: ' . $error->getMessage();
                        }
                    }
                }

                $komunikat = implode("; \r\n", $bledy);
                $this
                    ->get('ssfz.service.komunikaty_service')
                    ->bladKomunikat($komunikat)
                ;
            }
        }

        $typeGuesser = $this->get('ssfz.service.guesser.typ_sprawozdania');
        if ($typeGuesser->jestPozyczkowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:pozyczkowe.html.twig';
        } else if ($typeGuesser->jestPoreczeniowe($sprawozdanie)) {
            $template = 'SsfzBundle:Sprawozdanie:poreczeniowe.html.twig';
        } else {
            $message = 'Nieznany typ sprawozdania. Obsługiwane są tylko sprawozdanie poręczeniowe i pożyczkowe.';
            throw new InvalidArgumentException($message);
        }

        return $this->render($template, [
            'sprawozdanie'     => $sprawozdanie,
            'typ_sprawozdania' => $typSprawozdania,
            'tylkoDoOdczytu'   => false,
            'form'             => $form->createView(),
        ]);
    }

*/


















    /**
     * Szuka sprawozdania o zadanym ID.
     *
     * @todo Dalczego ten kontroler pełni rolę repozytorium?!
     *
     * @param string $typSprawozdania
     * @param int $sprawozdanieId
     *
     * @throws InvalidArgumentException Jeśli typ sprawozdania nie jest obsługiwany
     * @throws PublicVisibleExcpetion Jeśli nie znaleziono sprawozdania o zadanum ID
     *
     * @return AbstractSprawozdanie
     */
    protected function znajdzSprawozdanie(string $typSprawozdania, int $sprawozdanieId): AbstractSprawozdanie
    {
        if ($typSprawozdania === TypSprawozdaniaGuesserService::SPRAWOZDANIE_POZYCZKOWE) {
            $klasa = SprawozdaniePozyczkowe::class;
        } else if ($typSprawozdania === TypSprawozdaniaGuesserService::SPRAWOZDANIE_PORECZENIOWE) {
            $klasa = SprawozdaniePoreczeniowe::class;
        } else {
            $message = 'Nieznany typ sprawozdania. Obsługiwane są tylko sprawozdanie poręczeniowe i pożyczkowe.';
            throw new InvalidArgumentException($message);
        }
        
        $sprawozdanie = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository($klasa)
            ->find($sprawozdanieId)
        ;
        
        if (null === $sprawozdanie) {
            throw new PublicVisibleExcpetion('Nie znaleziono sprawozdania o podanym ID.');
        }
        
        return $sprawozdanie;
    }
}
