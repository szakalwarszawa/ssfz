<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\SprawozdanieSpolki;

/**
 * Repozytorium SprawozdanieSpolkiRepository.
 */
class SprawozdanieSpolkiRepository extends EntityRepository
{
    /**
     * Znajduje sprawozdania spółek przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|SprawozdanieSpolki[]
     */
    public function findByIdSprawozdania(int $idSprawozdania): ?array
    {
        $result = $this
            ->createQueryBuilder('ss')
            ->leftJoin('ss.sprawozdanie', 's')
            ->where('s.id = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result : null;
    }
}
