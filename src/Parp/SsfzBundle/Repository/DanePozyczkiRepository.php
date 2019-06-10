<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\Ssfz\Entity\DanePozyczki;
use Parp\SsfzBundle\Entity\Sprawozdanie;

/**
 * Repozytorium DanePozyczkiRepository.
 */
class DanePozyczkiRepository extends EntityRepository
{
    /**
     * Tworzy nowe dane pożyczki przypisane do sprawozdania.
     *
     * @param Sprawozdanie $sprawozdanie
     * @param boolean $flush
     *
     * @return DanePozyczki
     */
    public function create(Sprawozdanie $sprawozdanie, $flush = false): DanePozyczki
    {
        $danePozyczki = new DanePozyczki();
        $danePozyczki->setSprawozdanie($sprawozdanie);
        $this->_em->persist($danePozyczki);
        if ($flush) {
            $this->_em->flush($danePozyczki);
        }

        return $danePozyczki;
    }

    /**
     * Znajduje dane pożyczek przypisane do zadanego sprawozdania.
     *
     * @param Sprawozdanie $sprawozdanie
     *
     * @return array|DanePozyczki[]
     */
    public function findBySprawozdanie(Sprawozdanie $sprawozdanie): array
    {
        $idSprawozdania = $sprawozdanie->getId();

        return $this->findByIdSprawozdania($idSprawozdania);
    }

    /**
     * Znajduje dane pożyczek przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return array|DanePozyczki[]
     */
    public function findByIdSprawozdania(int $idSprawozdania): array
    {
        return $this
            ->createQueryBuilder('dp')
            ->leftJoin('dp.sprawozdanie', 's')
            ->where('s.id = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;
    }
}
