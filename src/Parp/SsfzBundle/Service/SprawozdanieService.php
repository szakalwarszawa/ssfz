<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Repository\SprawozdanieRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Dostęp do repozytorium sprawozdań
 */
class SprawozdanieService
{
    /**
     * @var SprawozdanieRepository
     */
    private $uzytkownikRepository;

    /**
     * Konstruktor
     *
     * @param SprawozdanieRepository $sprawozdanieRepository
     */
    public function __construct($sprawozdanieRepository)
    {
        $this->sprawozdanieRepository = $sprawozdanieRepository;
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
     * @param int          $beneficjentId
     * @param int          $umowaId
     *
     * @return Listę sprawozdań
     */
    public function datatableSprawozdanie($parentObject, $beneficjentId, $umowaId)
    {
        return $parentObject->get('datatable')
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
                    'r.creatorId = :creatorId and r.umowaId = :umowaId and r.czyNajnowsza = :czyNajnowsza',
                    array(
                        'creatorId' => (string) $beneficjentId,
                        'czyNajnowsza' => (string) true,
                        'umowaId' => (string) $umowaId,
                    )
                )
                ->setOrder('r.dataRejestracji', 'desc');
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
            ->add('notice', array(
                'alert' => 'success',
                'title' => $title,
                'message' => $message
            ));
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
            ->add('notice', array(
                'alert' => 'danger',
                'title' => $title,
                'message' => $message
            ));
    }

    /**
     * Sprawdza uprawnienia do sprawozdania
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
     * @param \Exception $previous
     *
     * @return NotFoundHttpException
     */
    public function createNotFoundException($message = 'Not Found', \Exception $previous = null)
    {
        return new NotFoundHttpException($message, $previous);
    }
}
