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
     * Znajduje sprawozdanie spółki przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|SprawozdanieSpolki
     */
    public function findOneByIdSprawozdania(int $idSprawozdania): ?SprawozdanieSpolki
    {
        $result = $this
            ->createQueryBuilder('ss')
            ->where('ss.sprawozdanieId = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result[0] : null;
    }
}
