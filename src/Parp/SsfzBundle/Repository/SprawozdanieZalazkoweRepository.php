<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\SprawozdanieInterface;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;

/**
 * Repozytorium SprawozdanieZalazkoweRepository.
 */
class SprawozdanieZalazkoweRepository extends EntityRepository
{
    /**
     * Dodanie nowego sprawozdania do bazy danych
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return AbstractSprawozdanie
     */
    public function persist(AbstractSprawozdanie $sprawozdanie)
    {
        $this->_em->persist($sprawozdanie);
        $this->_em->flush();

        return $sprawozdanie;
    }
    
    /**
     * Sprawdzenie, czy już istnieje sprawozdanie o takich parametrach
     *
     * @param AbstractSprawozdanie $sprawozdanie
     *
     * @return bool
     */
    public function czyTakieJuzIstnieje(AbstractSprawozdanie $sprawozdanie)
    {
        $wynik = $this->findBy([
            'umowa' => $sprawozdanie->getUmowa(),
            'okres' => $sprawozdanie->getOkres(),
            'rok'   => $sprawozdanie->getRok(),
        ]);
        
        return count($wynik) > 0;
    }

    /**
     * Szuka najnowszego sprawozdania dla danego beneficjenta.
     *
     * @param integer $creatorId
     * @param integer $okresSprawozdawczyId
     * @param integer $rok
     * @param integer $umowaId
     *
     * @return AbstractSprawozdanie|null
     */
    public function findNajnowsze(
        int $creatorId,
        int $okresSprawozdawczyId,
        int $rok,
        int $umowaId
    ): ?AbstractSprawozdanie {
        $result = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.okres', 'o')
            ->leftJoin('s.umowa', 'u')
            ->where('s.creatorId = :creatorId')
            ->andWhere('u.id = :umowaId')
            ->andWhere('s.rok = :rok')
            ->andWhere('s.czyNajnowsza = TRUE')
            ->andWhere('o.id = :okresSprawozdawczyId')
            ->setParameter('creatorId', $creatorId)
            ->setParameter('umowaId', $umowaId)
            ->setParameter('rok', $rok)
            ->setParameter('okresSprawozdawczyId', $okresSprawozdawczyId)
            ->getQuery()
            ->getResult()
        ;

        return (count($result) > 0) ? $result[0] : null;
    }

    /**
     * Zwraca aktualne wersje sprawozdań (opcjonalnie zawężone do zadanej umowy i konta beneficjenta).
     *
     * @param int|null $idBeneficjenta
     * @param int|null $idUmowy
     *
     * @return SprawozdanieInterface[]
     */
    public function findAktualneWersjeSprawozdanBeneficjenta(?int $idBeneficjenta = null, ?int $idUmowy = null): array
    {
        $query = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.umowa', 'u')
            ->where('s.czyNajnowsza = TRUE')
        ;

        if (null !== $idBeneficjenta) {
            $query
                ->andWhere('s.creatorId = :idBeneficjenta')
                ->setParameter('idBeneficjenta', $idBeneficjenta)
            ;
        }

        if (null !== $idUmowy) {
            $query
                ->andWhere('u.id = :idUmowy')
                ->setParameter('idUmowy', $idUmowy)
            ;
        }

        $query
            ->orderBy('s.rok', 'ASC')
            ->addOrderBy('s.okres', 'ASC')
            ->addOrderBy('s.id', 'ASC')
        ;

        $result = $query
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    /**
     * Zwraca aktualne wersje sprawozdań (opcjonalnie zawężone do zadanej umowy i konta beneficjenta).
     *
     * @param int $creatorId
     * @param int $umowaId
     * @param int $okres
     * @param int $rok
     *
     * @return SprawozdanieInterface[]
     */
    public function findPreviousReport($creatorId, $umowaId, $okresId, $rok): array
    {
        $result = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.okres', 'o')
            ->leftJoin('s.umowa', 'u')
            ->where('s.creatorId = :creatorId')
            ->andWhere('u.id = :umowaId')
            ->andWhere('s.rok = :rok')
            ->andWhere('s.czyNajnowsza = TRUE')
            ->andWhere('o.id = :okresId')
            ->setParameter('creatorId', $creatorId)
            ->setParameter('umowaId', $umowaId)
            ->setParameter('rok', $rok)
            ->setParameter('okresId', $okresId)
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }
}
