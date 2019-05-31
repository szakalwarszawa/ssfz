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
     * @throws NotFoundHttpException
     *
     * @return Response
     */
    public function createPrzeplyw(Request $request, $sprawozdanieId)
    {
        $beneficjentId = $this->getBeneficjentId();
        $przeplyw = new \Parp\SsfzBundle\Entity\PrzeplywFinansowy();
        $entityManager = $this->getDoctrine()->getManager();
        $report = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->find($sprawozdanieId);
        if ($report->getCreatorId() != $beneficjentId || ($report->getStatus() != 1 && $report->getStatus() != 4)) {
            throw $this->createNotFoundException(
                'Nie znaleziono sprawozdania!'
            );
        }
        $przeplywZBazy = $entityManager->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $sprawozdanieId));
        if ($przeplywZBazy) {
            $przeplyw = $przeplywZBazy[0];
        }
        if (!$przeplywZBazy) {
            $przeplyw->setSaldoPoczatkowe($this->getSaldoPoczatkowe($report, $beneficjentId, $entityManager));
        }
        $entityManager->flush();

        $form = $this->createForm(\Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType::class, $przeplyw);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creating = $przeplyw->getId() == null;
            if ($creating) {
                $entityManager = $this->getDoctrine()->getManager();
                $przeplyw->setSprawozdanieId($sprawozdanieId);
                $przeplyw->setCreatorId($beneficjentId);
                $creationDate = new \DateTime('now');
                $przeplyw->setDataRejestracji($creationDate);
                $entityManager->persist($przeplyw);
                $entityManager->flush();
                $this->getKomunikatyService()->sukcesKomunikat('Rejestracja przepływu finansowego zakończyła się powodzeniem', 'Rejestracja przepływu finansowego');
            }
            if (!$creating) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $this->getKomunikatyService()->sukcesKomunikat('Zapis przepływu finansowego zakończył się powodzeniem', 'Zapis przepływu finansowego');
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', array('umowaId' => (string) $report->getUmowaId()));
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->getKomunikatyService()->bladKomunikat('Formularz nie został poprawnie wypełniony.');
        }

        return $this->render('SsfzBundle:Report:przeplywRejestruj.html.twig', array(
            'form' => $form->createView(),
            'form_mode' => 'create',
            'sprawozdanieId' => $sprawozdanieId,
            'sprawozdanie' => $report,
        ));
    }

    /**
     * Pobiera saldo koncowe za poprzedni okres
     *
     * @param Sprawozdanie $report
     * @param integer      $beneficjentId
     * @param Manager      $entityManager
     *
     * @return saldo koncowe
     */
    private function getSaldoPoczatkowe($report, $beneficjentId, $entityManager)
    {
        $previousReport = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(array('creatorId' => $beneficjentId, 'umowaId' => $report->getUmowaId(), 'okresId' => 1, 'rok' => ($report->getRok() - 1)));
        if ($report->getOkresId() == 1) {
            $previousReport = $entityManager->getRepository(\Parp\SsfzBundle\Entity\Sprawozdanie::class)->findBy(array('creatorId' => $beneficjentId, 'umowaId' => $report->getUmowaId(), 'okresId' => 0, 'rok' => $report->getRok()));
        }
        if ($previousReport) {
            $przeplyw = $entityManager->getRepository(\Parp\SsfzBundle\Entity\PrzeplywFinansowy::class)->findBy(array('sprawozdanieId' => $previousReport[0]->getId()));
            if ($przeplyw) {
                return $przeplyw[0]->getSaldoKoncowe();
            }
        }

        return 0;
    }

    /**
     * Pobiera zalogowanego użytkownika
     *
     * @throws AccessDeniedException
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
     * Pomocnicza metoda
     *
     * @return KomunikatyService z kontenera
     */

    protected function getKomunikatyService()
    {
        return $this->get('ssfz.service.komunikaty_service');
    }
}
