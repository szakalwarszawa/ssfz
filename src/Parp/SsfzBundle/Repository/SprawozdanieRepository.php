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
            'okresId' => $sprawozdanie->getOkresId(),
            'rok' => $sprawozdanie->getRok(),
        ]);
        
        return count($wynik) > 0;
    }
}
