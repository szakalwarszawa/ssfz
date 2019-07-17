<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\PrzeplywFinansowy;

/**
 * Description of PrzeplywFinansowyRepository
 */
class PrzeplywFinansowyRepository extends EntityRepository
{
    /**
     * Znajduje przepływ finansowy przypisany do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|PrzeplywFinansowy
     */
    public function findOneByIdSprawozdania(int $idSprawozdania): ?PrzeplywFinansowy
    {
        $result = $this
            ->createQueryBuilder('pf')
            ->where('pf.sprawozdanieId = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result[0] : null;
    }
}
