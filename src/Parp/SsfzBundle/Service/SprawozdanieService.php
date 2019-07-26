<?php

namespace Parp\SsfzBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Parp\SsfzBundle\Entity\Slownik\Program;
use Parp\SsfzBundle\Entity\SprawozdanieZalazkowe;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Repository\SprawozdanieRepository;

/**
 * Dostęp do repozytorium sprawozdań
 */
class SprawozdanieService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $sprawozdanieRepository;
    
    /**
     * Konstruktor
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->wyznaczRepozytoriumDlaProgramu(null);
    }

    /**
     * Zwraca repozytorium encji Sprawozdanie
     *
     * @return SprawozdanieRepository
     */
    public function getSprawozdanieRepository()
    {
        return $this->sprawozdanieRepository;
    }

    /**
     * Metoda pobiera sprawozdania
     *
     * @param Sprawozdanie $parentObject
     * @param Umowa $umowa
     *
     * @return Listę sprawozdań
     */
    public function datatableSprawozdanie($parentObject, Umowa $umowa)
    {
        $beneficjent = $umowa->getBeneficjent();
        $program = $beneficjent->getProgram();
        $klasaEncji = Program::jakaEncjaDlaProgramu($program);

        $tabRenderers = [
            0 => [
                'view' => 'SsfzBundle:Report:sprawozdanieStatus.html.twig',
            ],
            4 => [
                'view' => 'SsfzBundle:Report:sprawozdanieActions.html.twig',
            ]
        ];

        if (Program::FUNDUSZ_ZALAZKOWY_POIG_31 === (int) $program->getId()) {
            $tabRenderers[3] = [
                'view' => 'SsfzBundle:Report:sprawozdanieSpolki.html.twig',
            ];
        }
        
        return $parentObject
            ->get('datatable')
            ->setDatatableId('dta-sprawozdanie')
            ->setEntity($klasaEncji, 'r')
            ->addJoin('r.okres', 'o', Join::INNER_JOIN)
            ->addJoin('r.umowa', 'u', Join::LEFT_JOIN)
            ->setFields([
                'Status'       => 'r.status',
                'Rok'          => 'r.rok',
                'Okres'        => 'o.nazwa',
                'Nazwa spółki' => 'r.id',
                ' '            => 'r.id',
                '_identifier_' => 'r.id',
            ])
            ->setRenderers($tabRenderers)
            ->setWhere(
                'r.creatorId = :creatorId and u.id = :umowaId and r.czyNajnowsza = :czyNajnowsza',
                [
                    'creatorId'    => (string) $beneficjent->getId(),
                    'czyNajnowsza' => (string) true,
                    'umowaId'      => (string) $umowa->getId(),
                ]
            )
            ->setOrder('r.dataRejestracji', 'desc')
        ;
    }

    /**
     * Dodaje informację o pomyślnym zakończeniu operacji
     *
     * @param Sprawozdanie $parentObject
     * @param string       $title
     * @param string       $message
     *
     * @return void
     */
    public function addSuccessFlash($parentObject, $title, $message)
    {
        $parentObject
            ->get('session')
            ->getFlashBag()
            ->add('notice', [
                'alert'   => 'success',
                'title'   => $title,
                'message' => $message
            ]);
    }

    /**
     * Dodaje komunikat błędu
     *
     * @param Sprawozdanie $parentObject
     * @param string       $title
     * @param string       $message
     *
     * @return void
     */
    public function addErrorFlash($parentObject, $title, $message)
    {
        $parentObject
            ->get('session')
            ->getFlashBag()
            ->add('notice', [
                'alert'   => 'danger',
                'title'   => $title,
                'message' => $message
            ]);
    }

    /**
     * Sprawdza uprawnienia do sprawozdania
     *
     * @todo Serio HTTP Not Found 404 jeśli brak uprawnień?
     *
     * @param Sprawozdanie $report
     * @param int          $beneficjentId
     *
     * @throws NotFoundHttpException
     *
     * @return void
     */
    public function checkSprawozdaniePermission($report, $beneficjentId)
    {
        $errorMessage = 'Nie znaleziono sprawozdania!';
        if ($report === null) {
            throw $this->createNotFoundException($errorMessage);
        }
        if ($report->getCreatorId() != $beneficjentId) {
            throw $this->createNotFoundException($errorMessage);
        }
    }

    /**
     * Wypisuje komunikat błędu
     *
     * @param type $message
     * @param \Exception|null $previous
     *
     * @return NotFoundHttpException
     */
    public function createNotFoundException($message = 'Not Found', \Exception $previous = null)
    {
        return new NotFoundHttpException($message, $previous);
    }
    
    /**
     * Ustawia repozytorium odpowiednio dla programu.
     *
     * @param Program|null $program
     *
     * @return SprawozdanieService
     */
    public function wyznaczRepozytoriumDlaProgramu(Program $program = null)
    {
        $klasaEncji = Program::jakaEncjaDlaProgramu($program);

        $this->sprawozdanieRepository = $this
            ->entityManager
            ->getRepository($klasaEncji)
        ;
        
        return $this;
    }
}
