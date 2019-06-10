<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RolaRepository
 */
class RolaRepository extends EntityRepository
{
    /**
     * @param string $nazwy
     *
     * @return array
     */
    public function znajdzPoNazwach($nazwy)
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.nazwa in (?1)')
            ->setParameter(1, $nazwy)
            ->getQuery()
            ->getResult()
        ;
    }
}
