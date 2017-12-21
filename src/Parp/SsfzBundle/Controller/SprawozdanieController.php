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
 * 
 * @category Class
 * @package  SsfzBundle
 * @author   CI ZETO
 * @license  Commercial ZETO
 * @link     http://zeto.bialystok.pl
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
        $this->datatableSprawozdanie($umowaId);
        $beneficjentId = $this->getBeneficjentId();
        $report = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $report->setNumerUmowy($this->getNumerUmowy($umowaId, $beneficjentId));
        $spolki = $this->getSpolkiList($umowaId);
        $report = $this->setSpolki($spolki, $report);
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report);
        if (count($spolki) == 0) {
            $this->addErrorFlash('Uwaga!', 'Aby dodać sprawozdanie należy wprowadzić dane spółek.');
            
            return $this->pokarzFormularzRejestracji($form, 'not_allowed', $umowaId);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                return $this->pokarzFormularzRejestracji($form, 'create', $umowaId);
            }
            $em = $this->getDoctrine()->getManager();
            $umowa = $em->getRepository(\Parp\SsfzBundle\Entity\Umowa::class)->find($umowaId);
            $report = $this->setDefaultValues($report, $umowa, $beneficjentId);
            $em->persist($report);
            $em->flush();
            if ($form['przekierowanie']->getData() == 'beneficjent') {                
                return $this->redirectToRoute('beneficjent');
            }
            
            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addErrorFlash('Błąd.', 'Formularz nie został poprawnie wypełniony.');
        }
        
        return $this->pokarzFormularzRejestracji($form, 'create', $umowaId);
    }
   
    

    /**
     * @Route("sprawozdanie/podglad/{reportId}", name="sprawozdanie_podglad")
     * 
     * @param Request $request
     * @param int     $reportId
     * 
     * @return Response
     * 
     * @throws Exception
     */
    public function podgladAction(Request $request, $reportId) 
    {
        $beneficjentId = $this->getBeneficjentId();
        $em = $this->getDoctrine()->getManager();
        $report = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->checkSprawozdaniePermission($report, $beneficjentId);
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report, array('read_only' => true));
        
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
        $em = $this->getDoctrine()->getManager();
        $report = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->checkSprawozdaniePermission($report, $beneficjentId);
        if ($report->getStatus() != 1) {
            throw $this->createNotFoundException('Nie można edytować sprawozdania');
        }
        $umowaId = $report->getUmowaId();
        $this->datatableSprawozdanie($umowaId);
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$this->czySprawozdanieZaDobryOkres($report, $umowaId, $beneficjentId)) {
                
                return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
            }
            $em->flush();
            $this->addSuccessFlash('Edycja sprawozdania', 'Edycja sprawozdania zakończyła się powodzeniem');
            if ($form['przekierowanie']->getData() == 'beneficjent') {                
                return $this->redirectToRoute('beneficjent');
            }
            
            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addErrorFlash('Błąd.', 'Formularz nie został poprawnie wypełniony.');
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
        $em = $this->getDoctrine()->getManager();
        $report = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($reportId);
        $this->checkSprawozdaniePermission($report, $beneficjentId);
        $umowaId = $report->getUmowaId();
        $this->datatableSprawozdanie($umowaId);
        if ($report->getStatus() != 4) {
            throw $this->createNotFoundException('Nie można poprawić sprawozdania');
        }
        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\SprawozdanieType::class, clone $report, array('showRemarks' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newReport = new \Parp\SsfzBundle\Entity\Sprawozdanie();
            $raportFromForm = $form->getData();
            $newReport = clone $raportFromForm;
            foreach ($raportFromForm->getSprawozdaniaSpolek() as $spolka) {
                $newReport->addSprawozdaniaSpolek(clone $spolka);
            }
            $przeplyw = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $reportId));
            
            if (!$this->czySprawozdanieZaDobryOkres($newReport, $umowaId, $beneficjentId)) {
                
                return $this->pokarzFormularzRejestracji($form, 'edit', $umowaId);
            }
            $newReport = $this->setDefaultValuesAfterRepait($newReport, $report);
            $report->setCzyNajnowsza(false);
            $em->persist($newReport);
            if (count($przeplyw) == 1) {
                $przeplywClone = clone $przeplyw[0];
                $przeplywClone->setId(null);
                $przeplywClone->setSprawozdanieId($newReport->getId());
            }
            $em->persist($przeplywClone);
            $em->flush();
            $this->addSuccessFlash('Poprawa sprawozdania', 'Poprawa sprawozdania zakończyła się powodzeniem');
            
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
        $em = $this->getDoctrine()->getManager();
        $sprawozdanie = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($sprawozdanieId);
        $this->checkSprawozdaniePermission($sprawozdanie, $beneficjentId);
        
        $przeplyw = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanieId));
        $umowaId = $sprawozdanie->getUmowaId();
        if (count($przeplyw) != 1) {
            $this->addErrorFlash('Wysyłka sprawozdania', 'Nie zdefiniowano przepływu finansowego');
            
            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $umowaId));
        }
        if ($this->getRequest()->isMethod('POST') && $sprawozdanie->getStatus() == 1 && $sprawozdanie->getCreatorId() == $beneficjentId) {
            $dateNow = new \DateTime('now');
            $sprawozdanie->setStatus(2);
            $sprawozdanie->setDataPrzeslaniaDoParp($dateNow);
            $this->addSuccessFlash('Wysyłka sprawozdania', 'Sprawozdanie wysłano do PARP');
        }
        $em->flush();
        
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
            $sprawozdanieSpolki = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
            $sprawozdanieSpolki->setNazwaSpolki($spolka->getNazwa());
            $sprawozdanieSpolki->setKrs($spolka->getKrs());
            $sprawozdanieSpolki->setLp($counter);
            $report->addSprawozdaniaSpolek($sprawozdanieSpolki);
            $counter = $counter + 1;
        }
        
        return $report;
    }

    /**
     * Metoda pobiera sprawozdania
     * 
     * @param int $umowaId
     * 
     * @return Listę sprawozdań
     */
    private function datatableSprawozdanie($umowaId) 
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();
        
        return $this->get('datatable')
            ->setDatatableId('dta-sprawozdanie')
            ->setEntity('SsfzBundle:Sprawozdanie', 'r')
            ->setFields(
                array(
                                'Status' => 'r.status',
                                'Rok' => 'r.rok',
                                'Okres' => 'r.okres',
                                'Nazwa spółki' => 'r.id',
                                ' ' => 'r.id',
                                '_identifier_' => 'r.id',
                            )
            )
            ->setRenderers(
                array(
                                0 => array(
                                    'view' => 'SsfzBundle:Report:sprawozdanieStatus.html.twig',
                                ),
                                3 => array(
                                    'view' => 'SsfzBundle:Report:sprawozdanieSpolki.html.twig',
                                ),
                                4 => array(
                                    'view' => 'SsfzBundle:Report:sprawozdanieActions.html.twig',
                                )
                            )
            )
            ->setWhere(
                'r.creatorId = :creatorId and r.umowaId = :umowaId and r.czyNajnowsza = :czyNajnowsza', array(
                                'creatorId' => (string) $beneficjentId,
                                'czyNajnowsza' => (string) true,
                                'umowaId' => (string) $umowaId,
                            )
            )
            ->setOrder('r.dataRejestracji', 'desc');
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
        
        return $this->datatableSprawozdanie($umowaId)->execute();
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
     */
    public function getNumerUmowy($umowaId, $beneficjentId) 
    {
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $em = $this->getDoctrine()->getManager();
        $umowa = $em->getRepository(\Parp\SsfzBundle\Entity\Umowa::class)->find($umowaId);
        $em->flush();
        if ($umowa == null) {
            throw $this->createNotFoundException('Nie odnaleziono umowy');
        }
        if ($umowa->getBeneficjentId() != $beneficjentId) {
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
        $em = $this->getDoctrine()->getManager();
        $spolki = $em->getRepository(\Parp\SsfzBundle\Entity\Spolka::class)->findBy(
            array('umowaId' => $umowaId, 'zakonczona' => 0)
        );
        $em->flush();

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
        $em = $this->getDoctrine()->getManager();
        $report = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(
            array('creatorId' => $beneficjentId, 'okres' => $okres, 'czyNajnowsza' => true,  'rok' => $rok, 'umowaId' => $umowaId)
        );
        $em->flush();
        if ($report) {
            if ($report[0]->getId() != $editedReportId) {

                return false;
            }
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
        if ((integer) $rok > (integer) date('Y')) {
            return false;
        }
        if (((integer) $rok == (integer) date('Y')) && ($okres == 'lipiec - grudzień' || (integer) date('m') < 7)) {
            return false;
        }
        
        return true;
    }

    /**
     * Pobiera zalogowanego użytkownika
     * 
     * @return Uzytkownik
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
     * Dodaje informację o pomyślnym zakończeniu operacji
     * 
     * @param string $title
     * @param string $message
     * 
     * @return void
     */
    public function addSuccessFlash($title, $message) 
    {
        $this->get('session')->getFlashBag()->add(
            'notice', array(
            'alert' => 'success',
            'title' => 'Zapis zakończony.',
            'message' => $message
            )
        );
    }

    /**
     * Dodaje komunikat błędu
     * 
     * @param string $title
     * @param string $message
     * 
     * @return void
     */
    public function addErrorFlash($title, $message) 
    {
        $this->get('session')->getFlashBag()->add(
            'notice', array(
                'alert' => 'danger',
                'title' => 'Błąd.',
                'message' => $message
                )
        );
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
        if ($result == false) {
            $this->addErrorFlash('Błąd podczas próby zapisu sprawozdania', 'Sprawozdanie za wskazany okres istnieje w systemie');
                
            return false;
        }
        $result2 = $this->chekSprawozdanieForGoodPeriod($report->getOkres(), $report->getRok());
        if ($result2 == false) {
            $this->addErrorFlash('Błąd podczas próby zapisu sprawozdania', 'Podano błędny okres lub rok'); 
            
            return false;
        }
          
        return true;
    }
    
    /**
     * Sprawdza uprawnienia do sprawozdania
     * 
     * @param Sprawozdanie $report
     * @param int          $beneficjentId
     * 
     * @return void
     */   
    public function checkSprawozdaniePermission($report,$beneficjentId)
    {
        $errorMessage = 'Nie znaleziono sprawozdania!';
        if ($report === null) {
            throw $this->createNotFoundException($errorMessage);
        }
        if ($report->getCreatorId() != $beneficjentId) {
            throw $this->createNotFoundException($errorMessage);
        }
    }

}
