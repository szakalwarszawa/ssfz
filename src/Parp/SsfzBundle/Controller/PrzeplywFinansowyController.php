<?php

namespace Parp\SsfzBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Parp\SsfzBundle\Entity\Report;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Form\Type\PrzeplywFinansowyType;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * Description of PrzeplywFinansowyController
 */
class PrzeplywFinansowyController extends Controller
{
    /**
     * Akcja zapisu przeplywu finansowego
     *
     * @param Request $request
     * @param int $sprawozdanieId
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
        $przeplyw = new PrzeplywFinansowy();
        $entityManager = $this->getDoctrine()->getManager();

        $report = $entityManager
            ->getRepository(SprawozdanieZalazkowe::class)
            ->find($sprawozdanieId);
        if (
            $beneficjentId !== (int)$report->getCreatorId() ||
            ((int)$report->getStatus() !== 1 && (int)$report->getStatus() !== 4)
        ) {
            throw $this->createNotFoundException('Nie znaleziono sprawozdania!');
        }
        $przeplywZBazy = $entityManager
            ->getRepository(PrzeplywFinansowy::class)
            ->findOneByIdSprawozdania($sprawozdanieId)
        ;
        if (null !== $przeplywZBazy) {
            $przeplyw = $przeplywZBazy;
        }

        if (null === $przeplywZBazy) {
            $przeplyw->setSaldoPoczatkowe($this->getSaldoPoczatkowe($report, $beneficjentId, $entityManager));
        }

        $entityManager->flush();

        $form = $this->createForm(PrzeplywFinansowyType::class, $przeplyw);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $creating = $przeplyw->getId() == null;
            if ($creating) {
                $entityManager = $this->getDoctrine()->getManager();
                $przeplyw->setSprawozdanie($report);
                $przeplyw->setCreatorId($beneficjentId);
                $creationDate = new DateTime('now');
                $przeplyw->setDataRejestracji($creationDate);
                $entityManager->persist($przeplyw);
                $entityManager->flush();
                $this
                    ->getKomunikatyService()
                    ->sukcesKomunikat(
                        'Rejestracja przepływu finansowego zakończyła się powodzeniem',
                        'Rejestracja przepływu finansowego'
                    )
                ;
            }
            if (!$creating) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $this->getKomunikatyService()->sukcesKomunikat(
                    'Zapis przepływu finansowego zakończył się powodzeniem',
                    'Zapis przepływu finansowego'
                );
            }

            return $this->redirectToRoute('sprawozdanie_rejestracja', [
                'umowaId' => (string) $report->getUmowaId(),
            ]);
        }
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->getKomunikatyService()->bladKomunikat('Formularz nie został poprawnie wypełniony.');
        }

        return $this->render('SsfzBundle:Report:przeplywRejestruj.html.twig', [
            'form'           => $form->createView(),
            'form_mode'      => 'create',
            'sprawozdanieId' => $sprawozdanieId,
            'sprawozdanie'   => $report,
        ]);
    }

    /**
     * Pobiera saldo koncowe za poprzedni okres
     *
     * @param Sprawozdanie $report
     * @param int $beneficjentId
     * @param Manager $entityManager
     *
     * @return saldo koncowe
     */
    private function getSaldoPoczatkowe($report, $beneficjentId, $entityManager)
    {
        if ($report->getOkres()->getId() == OkresSprawozdawczy::LIPIEC_GRUDZIEN) {
            $okresStyczenCzerwiec = $entityManager
                ->getRepository(OkresSprawozdawczy::class)
                ->find(OkresSprawozdawczy::STYCZEN_CZERWIEC)
            ;

            $previousReport = $entityManager
                ->getRepository(SprawozdanieZalazkowe::class)
                ->findPreviousReport(
                    $beneficjentId,
                    $report->getUmowaId(),
                    $okresStyczenCzerwiec->getId(),
                    $report->getRok()
                );
        } else {
            $okresLipiecGrudzien = $entityManager
                ->getRepository(OkresSprawozdawczy::class)
                ->find(OkresSprawozdawczy::LIPIEC_GRUDZIEN)
            ;

            $previousReport = $entityManager
                ->getRepository(SprawozdanieZalazkowe::class)
                ->findPreviousReport(
                    $beneficjentId,
                    $report->getUmowaId(),
                    $okresLipiecGrudzien->getId(),
                    ($report->getRok() - 1)
                );
        }

        if ($previousReport) {
            $przeplyw = $entityManager
                ->getRepository(PrzeplywFinansowy::class)
                ->findOneByIdSprawozdania($previousReport[0]->getId())
            ;
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
