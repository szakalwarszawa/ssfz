<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Parp\SsfzBundle\Entity\Report;

/**
 * Kontroler obsługujący funkcjonalności Sprawozdania
 */
class SprawozdanieController extends Controller
{
    /**
     * Akcja rejestracji sprawozdania
     *
     * @param Request $request
     * @param int     $umowaId
     *
     * @Route("sprawozdanie/rejestracja/{umowaId}", name="sprawozdanie_rejestracja")
     *
     * @return Response
     */
    public function indexAction(Request $request, $umowaId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $this->getSprawozdanieService()->datatableSprawozdanie($this, $beneficjentId, $umowaId);
        $report = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $report->setNumerUmowy($this->getNumerUmowy($umowaId, $beneficjentId));
        $spolki = $this->getSpolkiList($umowaId);
        $report = $this->setSpolki($spolki, $report);
        $okresy = $this->getOkresySprawozdawcze();

        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report, array('okresy' => $okresy));
        if (count($spolki) == 0) {
            $this->getKomunikatyService()->bladKomunikat('Aby dodać sprawozdanie należy wprowadzić dane spółek.', 'Uwaga!');

            return $this->pokarzFormularzRejestracji($form, 'not_allowed', $umowaId);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                return $this->pokarzFormularzRejestracji($form, 'create', $umowaId);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $umowa = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Umowa::class)->find($umowaId);
            $report = $this->setDefaultValues($report, $umowa, $beneficjentId);
            $entityManager->persist($report);
            $entityManager->flush();
            if ($form['przekierowanie']->getData() == 'beneficjent') {
                return $this->redirectToRoute('beneficjent');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->getKomunikatyService()->bladKomunikat('Formularz nie został poprawnie wypełniony.');
        }

        return $this->pokarzFormularzRejestracji($form, 'create', $umowaId);
    }

     /**
     * Metoda umożliwia pobranie okresów sprawozdawczych z bazy danych
     *
     * @return array
     */
    private function getOkresySprawozdawcze()
    {
        $array = array();
        $entityManager = $this->getDoctrine()->getManager();
        $okresySprawozdawcze = $entityManager->getRepository(\Parp\SsfzBundle\Entity\OkresyKonfiguracja::class)->findBy(array(), array('rok' => 'ASC'));
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
        $report = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->getSprawozdanieService()->checkSprawozdaniePermission($report, $beneficjentId);
        $okresy = $this->getOkresySprawozdawcze();
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report, array('read_only' => true, 'okresy' => $okresy));

        return $this->pokarzFormularzRejestracji($form, 'read', $report->getUmowaId());
    }

    /**
     * @Route("sprawozdanie/edycja/{umowaId}/{reportId}")
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
        $report = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->getSprawozdanieService()->checkSprawozdaniePermission($report, $beneficjentId);
        if ($report->getStatus() != 1) {
            throw $this->createNotFoundException('Nie można edytować sprawozdania');
        }
        $umowaId = $report->getUmowaId();
        $this->getSprawozdanieService()->datatableSprawozdanie($this, $beneficjentId, $umowaId);
        $okresy = $this->getOkresySprawozdawcze();

        if ($request->query->get('odswiezSpolki') !== null) {
            $spolki = $this->getSpolkiList($umowaId);
            $report = $this->setSpolki($spolki, $report);
        }

        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report, array('okresy' => $okresy));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
            }
            $entityManager->flush();
            $this->getKomunikatyService()->sukcesKomunikat('Edycja sprawozdania zakończyła się powodzeniem', 'Edycja sprawozdania');
            if ($form['przekierowanie']->getData() == 'beneficjent') {
                return $this->redirectToRoute('beneficjent');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->getKomunikatyService()->bladKomunikat('Formularz nie został poprawnie wypełniony.');
        }

        return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
    }

    /**
     * @Route("sprawozdanie/poprawa/{umowaId}/{reportId}")
     *
     * @param Request $request
     * @param int     $umowaId
     * @param int     $reportId
     *
     * @return Response
     *
     * @throws Exception
     */
    public function poprawaAction(Request $request, $umowaId, $reportId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $entityManager = $this->getDoctrine()->getManager();
        $report = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->getSprawozdanieService()->checkSprawozdaniePermission($report, $beneficjentId);
        $umowaId = $report->getUmowaId();
        $this->getSprawozdanieService()->datatableSprawozdanie($this, $beneficjentId, $umowaId);
        if ($report->getStatus() != 4) {
            throw $this->createNotFoundException('Nie można poprawić sprawozdania');
        }
        $okresy = $this->getOkresySprawozdawcze();

        if ($request->query->get('odswiezSpolki') !== null) {
            $spolki = $this->getSpolkiList($umowaId);
            $report = $this->setSpolki($spolki, $report);
        }
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, clone $report, array('showRemarks' => true, 'okresy' => $okresy));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newReport = new \Parp\SsfzBundle\Entity\Sprawozdanie();
            $raportFromForm = $form->getData();
            $newReport = clone $raportFromForm;
            foreach ($raportFromForm->getSprawozdaniaSpolek() as $spolka) {
                $newReport->addSprawozdaniaSpolek(clone $spolka);
            }
            $przeplyw = $entityManager->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $reportId));

            if (!$this->czySprawozdanieZaDobryOkres($newReport, $umowaId, $beneficjentId)) {
                return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
            }
            $newReport = $this->setDefaultValuesAfterRepait($newReport, $report);
            $report->setCzyNajnowsza(false);
            $entityManager->persist($newReport);
            if (count($przeplyw) == 1) {
                $przeplywClone = clone $przeplyw[0];
                $przeplywClone->setId(null);
                $przeplywClone->setSprawozdanieId($newReport->getId());
            }
            $entityManager->persist($przeplywClone);
            $entityManager->flush();
            $this->getKomunikatyService()->sukcesKomunikat('Poprawa sprawozdania zakończyła się powodzeniem', 'Poprawa sprawozdania');

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }

        return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
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
        $sprawozdanie = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($sprawozdanieId);
        $this->getSprawozdanieService()->checkSprawozdaniePermission($sprawozdanie, $beneficjentId);

        $przeplyw = $entityManager->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanieId));
        $umowaId = $sprawozdanie->getUmowaId();
        if (count($przeplyw) != 1) {
            $this->getKomunikatyService()->bladKomunikat('Nie zdefiniowano przepływu finansowego', 'Wysyłka sprawozdania');

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($this->getRequest()->isMethod('POST') && $sprawozdanie->getStatus() == 1 && $sprawozdanie->getCreatorId() == $beneficjentId) {
            $dateNow = new \DateTime('now');
            $sprawozdanie->setStatus(2);
            $sprawozdanie->setDataPrzeslaniaDoParp($dateNow);
            $this->getKomunikatyService()->sukcesKomunikat('Sprawozdanie wysłano do PARP', 'Wysyłka sprawozdania');
        }
        $entityManager->flush();

        return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
    }

    /**
     * Metoda ustawia parametry domyślne dla sprawozdanie
     *
     * @param Sprawozdanie $report
     * @param Umowa        $umowa
     * @param int          $beneficjentId
     *
     * @return Sprawozdanie z ustawionymi parametrami domyślnymi
     */
    public function setDefaultValues($report, $umowa, $beneficjentId)
    {
        $report->setCreatorId($beneficjentId);
        $report->setWersja(1);
        $report->setUmowa($umowa);
        $report->setCzyNajnowsza(true);
        $report->setStatus(1);
        $creationDate = new \DateTime('now');
        $report->setDataRejestracji($creationDate);

        return $report;
    }

    /**
     * Metoda ustawia spółki
     *
     * @param ArrayList    $spolki
     * @param Sprawozdanie $report
     *
     * @return Sprawozdanie z ustawionymi spolkami
     */
    public function setSpolki($spolki, $report)
    {

        $counter = 1;
        foreach ($spolki as $spolka) {
            //Dodaj tylko te dla których już nie ma sprawozdań
            if ($report->findSprawozdanieSpolkiByNazwaSpolki($spolka->getNazwa()) === null) {
                $sprawozdanieSpolki = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
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
     * @Route("/gridSprawozdanie/{umowaId}", name="datatableSprawozdanie")
     *
     * @param int $umowaId
     *
     * @return Response
     */
    public function sprawozdanieGridAction($umowaId)
    {
        $beneficjentId = $this->getBeneficjentId();

        return $this->getSprawozdanieService()->datatableSprawozdanie($this, $beneficjentId, $umowaId)->execute();
    }

    /**
     * Pomocnicza metoda
     *
     * @return SprawozdanieService z kontenera
     */
    protected function getSprawozdanieService()
    {
        return $this->get('ssfz.service.sprawozdanie_service');
    }

    /**
     * Pomocnicza metoda
     *
     * @return KomunikatyService z kontenera
     */
    protected function getKomunikatyService()
    {
        return $this->get('ssfz.service.komunikaty_service');
    }

    /**
     * Metoda czyści dane związane z oceną PARP po poprawie sprawozdania
     *
     * @param Sprawozdanie $newReport
     * @param Sprawozdanie $report
     *
     * @return Sprawozdanie bez oceny
     */
    public function setDefaultValuesAfterRepait($newReport, $report)
    {
        $newReport->setStatus(1);
        $newReport->setUwagi('');
        $newReport->setOceniajacyId(null);
        $newReport->setDataPrzeslaniaDoParp(null);
        $newReport->setDataZatwierdzenia(null);
        $newReport->setWersja($report->getWersja() + 1);
        $newReport->setCzyNajnowsza(true);
        $newReport->setPreviousVersionId($report->getId());

        return $newReport;
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
    public function getNumerUmowy($umowaId, $beneficjentId)
    {
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $entityManager = $this->getDoctrine()->getManager();
        $umowa = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Umowa::class)->find($umowaId);
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
     * @return Array lista spółek
     */
    public function getSpolkiList($umowaId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $spolki = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Spolka::class)->findBy(
            array('umowaId' => $umowaId, 'zakonczona' => 0)
        );
        $entityManager->flush();

        return $spolki;
    }

    /**
     * Metoda sprawdza czy istnieje sprawozdanie za wskazany okres
     *
     * @param int $okres
     * @param int $rok
     * @param int $editedReportId
     * @param int $umowaId
     * @param int $beneficjentId
     *
     * @return Flage określającą czy sprawozdanie jest poprawne
     */
    public function chekSprawozdanieExist($okres, $rok, $editedReportId, $umowaId, $beneficjentId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $report = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(
            array('creatorId' => $beneficjentId, 'okres' => $okres, 'czyNajnowsza' => true,  'rok' => $rok, 'umowaId' => $umowaId)
        );
        $entityManager->flush();
        if ($report && $report[0]->getId() != $editedReportId) {
            $this->getKomunikatyService()->bladKomunikat('Sprawozdanie za wskazany okres istnieje w systemie', 'Błąd podczas próby zapisu sprawozdania');

            return false;
        }

        return true;
    }

    /**
     * Metoda sprawdza czy istnieje możliwość składaniania sprawozdań za wskazany okres
     *
     * @param int $okres
     * @param int $rok
     *
     * @return Czy sprawozdanie jest poprawne
     */
    public function chekSprawozdanieForGoodPeriod($okres, $rok)
    {
        $warunek1 = (integer) $rok > (integer) date('Y');
        $warunek2 = ((integer) $rok == (integer) date('Y')) && ($okres == 'lipiec - grudzień' || (integer) date('m') < 7);
        $warunek3 = $warunek1 | $warunek2;
        if ($warunek3) {
            $this->getKomunikatyService()->bladKomunikat('Podano błędny okres lub rok', 'Błąd podczas próby zapisu sprawozdania');

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
        $uzytkownik = $this->get('security.token_storage')->getToken()->getUser();
        if (!$uzytkownik) {
            throw $this->createAccessDeniedException();
        }

        return $uzytkownik;
    }

    /**
     * Dodaje komunikat błędu
     *
     * @param Form   $form
     * @param string $mode
     * @param int    $umowaId
     *
     * @return void
     */
    public function pokarzFormularzRejestracji($form, $mode, $umowaId)
    {
        return $this->render(
            'SsfzBundle:Report:rejestruj.html.twig', array(
                    'form' => $form->createView(),
                    'form_mode' => $mode,
                    'umowaId' => $umowaId,
            )
        );
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
     * @param int          $umowaId
     * @param int          $beneficjentId
     *
     * @return Identyfikator beneficjenta
     */
    public function czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)
    {
        $result = $this->chekSprawozdanieExist($report->getOkres(), $report->getRok(), $report->getId(), $umowaId, $beneficjentId);
        $result2 = $this->chekSprawozdanieForGoodPeriod($report->getOkres(), $report->getRok());
        $warunek = $result & $result2;
        if ($warunek == false) {
            return false;
        }

        return true;
    }
}
