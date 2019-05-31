<?php

namespace Parp\SsfzBundle\Service;

use Parp\SsfzBundle\Repository\UzytkownikRepository;
use Parp\SsfzBundle\Repository\RolaRepository;

/**
 * Dostęp do repozytorium ról.
 */
class RolaService
{
    /**
     * @var RolaRepository
     */
    private $rolaRepository;

    /**
     * Konstruktor
     *
     * @param RolaRepository $rolaRepository
     */
    public function __construct($rolaRepository)
    {
        $this->rolaRepository = $rolaRepository;
    }

    /**
     * Wyszukuje rolę po kryteriach
     *
     * @param array $criteria
     * @return Rola
     */
    public function findOneByCriteria(array $criteria = array())
    {
        return $this->rolaRepository->findOneBy($criteria);
    }
}
