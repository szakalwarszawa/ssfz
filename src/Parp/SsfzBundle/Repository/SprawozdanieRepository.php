<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\AbstractSprawozdanie;

/**
 * Description of SprawozdanieRepository
 */
class SprawozdanieRepository extends EntityRepository
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
            ->where('s.creatorId = :creatorId')
            ->andWhere('s.umowaId = :umowaId')
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
}
