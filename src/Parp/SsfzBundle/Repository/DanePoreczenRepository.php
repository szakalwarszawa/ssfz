<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\DanePoreczen;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;

/**
 * Repozytorium DanePoreczenRepository.
 */
class DanePoreczenRepository extends EntityRepository
{
    /**
     * Tworzy nowe dane poręczeń przypisane do sprawozdania.
     *
     * @param SprawozdaniePoreczeniowe $sprawozdanie
     * @param bool $persist
     *
     * @return DanePoreczen
     */
    public function create(SprawozdaniePoreczeniowe $sprawozdanie, $persist = false): DanePoreczen
    {
        $danePoreczen = new DanePoreczen();
        $danePoreczen->setSprawozdanie($sprawozdanie);
        if ($persist) {
            $this->persist($danePoreczen);
        }

        return $danePoreczen;
    }

    /**
     * Usuwa dane poręczeń.
     *
     * @param DanePoreczen $danePoreczen
     *
     * @return bool
     */
    public function delete(DanePoreczen $danePoreczen)
    {
        $this->_em->remove($danePoreczen);
        $this->_em->flush($danePoreczen);

        return true;
    }

    /**
     * Utrwala dane poręczeń.
     *
     * @param DanePoreczen $danePoreczen
     *
     * @return DanePoreczen
     */
    public function persist(DanePoreczen $danePoreczen)
    {
        $this->_em->persist($danePoreczen);
        $this->_em->flush($danePoreczen);

        return $danePoreczen;
    }

    /**
     * Znajduje dane poręczeń przypisane do zadanego sprawozdania.
     *
     * @param SprawozdaniePoreczeniowe $sprawozdanie
     *
     * @return array|DanePoreczen[]
     */
    public function findBySprawozdanie(SprawozdaniePoreczeniowe $sprawozdanie): array
    {
        $idSprawozdania = $sprawozdanie->getId();

        return $this->findByIdSprawozdania($idSprawozdania);
    }

    /**
     * Znajduje dane poręczeń przypisane do zadanego ID sprawozdania.
     *
     * @param int $idSprawozdania
     *
     * @return null|DanePoreczen
     */
    public function findOneByIdSprawozdania(int $idSprawozdania): ?DanePoreczen
    {
        $result = $this
            ->createQueryBuilder('dp')
            ->leftJoin('dp.sprawozdanie', 's')
            ->where('s.id = :idSprawozdania')
            ->setParameter('idSprawozdania', $idSprawozdania)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result[0] : null;
    }
}
