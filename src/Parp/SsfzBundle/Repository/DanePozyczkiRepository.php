<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\DanePozyczki;
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
     * @param bool $persist
     *
     * @return DanePozyczki
     */
    public function create(Sprawozdanie $sprawozdanie, $persist = false): DanePozyczki
    {
        $danePozyczki = new DanePozyczki();
        $danePozyczki->setSprawozdanie($sprawozdanie);
        if ($persist) {
            $this->persist($danePozyczki);
        }

        return $danePozyczki;
    }

    /**
     * Usuwa dane pożyczki.
     *
     * @param DanePozyczki $danepozyczki
     *
     * @return bool
     */
    public function delete(DanePozyczki $danePozyczki)
    {
        $this->_em->remove($danePozyczki);
        $this->_em->flush($danePozyczki);

        return true;
    }

    /**
     * Utrwala dane pożyczki.
     *
     * @param DanePozyczki $danePozyczki
     *
     * @return DanePozyczki
     */
    public function persist(DanePozyczki $danePozyczki)
    {
        $this->_em->persist($danePozyczki);
        $this->_em->flush($danePozyczki);

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
