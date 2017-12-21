<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Sprawozdanie;
/**
 * Description of SprawozdanieRepository
 */
class SprawozdanieRepository extends EntityRepository
{
    
    /**
     * Dodanie nowego sprawozdania do bazy danych
     * 
     * @param \Parp\SsfzBundle\Entity\Sprawozdanie $sprawozdanie
     * 
     * @return Sprawozdanie
     */
    public function persist(\Parp\SsfzBundle\Entity\Sprawozdanie $sprawozdanie)
    {
        $this->_em->persist($sprawozdanie);
        $this->_em->flush();
        
        return $sprawozdanie;
    }
}
