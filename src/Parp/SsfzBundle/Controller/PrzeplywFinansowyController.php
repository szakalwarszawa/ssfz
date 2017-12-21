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
 * Description of PrzeplywFinansowyController
 *
 * @author CI ZETO
 */
class PrzeplywFinansowyController extends Controller
{

    /**
     * Akcja zapisu przeplywu finansowego
     * 
     * @param Request $request
     * @param integer $sprawozdanieId
     * 
     * @Route("przeplyw/rejestracja/{sprawozdanieId}", name="przeplyw_rejestracja")
     * 
     * @return Response
     */
    public function createPrzeplyw(Request $request, $sprawozdanieId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $przeplyw = new \Parp\SsfzBundle\Entity\PrzeplywFinansowy();
        $em = $this->getDoctrine()->getManager();
        $report = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($sprawozdanieId);
        if ($report->getCreatorId() != $beneficjentId || ($report->getStatus() != 1 && $report->getStatus() != 4)) {
            throw $this->createNotFoundException(
                'Nie znaleziono sprawozdania!'
            );
        }
        $przeplywZBazy = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanieId));
        if ($przeplywZBazy) {
            $przeplyw = $przeplywZBazy[0];
        }
        if (!$przeplywZBazy) {
            $przeplyw->setSaldoPoczatkowe($this->getSaldoPoczatkowe($report, $beneficjentId, $em));
        }
        $em->flush();

        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType::class, $przeplyw);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creating = $przeplyw->getId() == null;
            if ($creating) {
                $em = $this->getDoctrine()->getManager();
                $przeplyw->setSprawozdanieId($sprawozdanieId);
                $przeplyw->setCreatorId($beneficjentId);
                $creationDate = new \DateTime('now');
                $przeplyw->setDataRejestracji($creationDate);
                $em->persist($przeplyw);
                $em->flush();
                $this->addSuccessFlash('Rejestracja przepływu finansowego', 'Rejestracja przepływu finansowego zakończyła się powodzeniem');
            }
            if (!$creating) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addSuccessFlash('Zapis przepływu finansowego', 'Zapis przepływu finansowego zakończył się powodzeniem');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $report->getUmowaId()));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addErrorFlash('Błąd.', 'Formularz nie został poprawnie wypełniony.');
        }

        return $this->render('SsfzBundle:Report:przeplywRejestruj.html.twig', array(
                'form' => $form->createView(),
                'form_mode' => 'create',
                'sprawozdanieId' => $sprawozdanieId,
                'sprawozdanie' => $report,
                )
        );
    }

    /**
     * Pobiera saldo koncowe za poprzedni okres
     * 
     * @param Sprawozdanie $report
     * @param integer      $beneficjentId
     * @param Manager      $em
     * 
     * @return saldo koncowe
     */
    private function getSaldoPoczatkowe($report, $beneficjentId, $em)
    {
        $previousReport = null;
        switch ($report->getOkresId()) {
            case 0:
                $previousReport = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(array('creatorId' => $beneficjentId, 'umowaId' => $report->getUmowaId(), 'okresId' => 1, 'rok' => ($report->getRok() - 1)));
                break;
            case 1:
                $previousReport = $em->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(array('creatorId' => $beneficjentId, 'umowaId' => $report->getUmowaId(), 'okresId' => 0, 'rok' => $report->getRok()));
                break;
        }
        if ($previousReport) {
            $przeplyw = $em->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $previousReport[0]->getId()));
            if ($przeplyw) {

                return $przeplyw[0]->getSaldoKoncowe();
            }
        }

        return 0;
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
     * Pobiera identyfikator beneficjenta
     * 
     * @return Identyfikator beneficjenta
     */
    private function getBeneficjentId()
    {
        $uzytkownik = $this->getZalogowanyUzytkownik();
        $beneficjent = $uzytkownik->getBeneficjent();
        $beneficjentId = $beneficjent->getId();

        return $beneficjentId;
    }

    /**
     * Dodaje informację o pomyślnym zakończeniu operacji
     * 
     * @return void
     */
    protected function addSuccessFlash($title, $message)
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
     * @param int    $message
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
}
