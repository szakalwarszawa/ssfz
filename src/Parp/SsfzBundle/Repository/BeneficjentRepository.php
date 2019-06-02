<?php

namespace Parp\SsfzBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\Beneficjent;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BeneficjentRepository
 */
class BeneficjentRepository extends EntityRepository
{
    /**
     * Tworzy nowy profil beneficjenta i wiąże go z podaną w parametrze
     * encją Uzytkownik
     *
     * @param  \Parp\SsfzBundle\Entity\Uzytkownik $uzytkownik
     * @return \Parp\SsfzBundle\Entity\Beneficjent
     */
    public function addNewBeneficjent(Uzytkownik $uzytkownik)
    {
        $beneficjent = new Beneficjent();
        $beneficjent->setUzytkownik($uzytkownik);
        $this->_em->persist($beneficjent);
        $this->_em->flush();

        return $beneficjent;
    }

    /**
     * Aktualizuje encję Beneficjent
     *
     * @param Beneficjent     $beneficjent
     * @param ArrayCollection $originalUmowy
     * @param ArrayCollection $originalOsoby
     */
    public function updateBeneficjent(Beneficjent &$beneficjent, ArrayCollection $originalUmowy, ArrayCollection $originalOsoby)
    {
        $this->updateBeneficjentUmowy($beneficjent, $originalUmowy);
        $this->updateBeneficjentOsoby($beneficjent, $originalOsoby);
        $this->updateBeneficjentWypelniony($beneficjent);
        $this->_em->persist($beneficjent);
        $this->_em->flush();
    }

    /**
     * Aktualizuje powiązane z beneficjentem umowy
     *
     * @param type                                        $beneficjent
     * @param \Parp\SsfzBundle\Repository\ArrayCollection $originalUmowy
     */
    private function updateBeneficjentUmowy(&$beneficjent, ArrayCollection $originalUmowy)
    {
        foreach ($originalUmowy as $umowa) {
            if (false === $beneficjent->getUmowy()->contains($umowa)) {
                $this->_em->remove($umowa);
            }
        }
        foreach ($beneficjent->getUmowy() as $umowa) {
            $umowa->setBeneficjent($beneficjent);
        }
    }

    /**
     * Aktualizuje powiązane z beneficjentem osoby zatrudnione
     *
     * @param type                                        $beneficjent
     * @param \Parp\SsfzBundle\Repository\ArrayCollection $originalOsoby
     */
    private function updateBeneficjentOsoby(&$beneficjent, ArrayCollection $originalOsoby)
    {
        foreach ($originalOsoby as $osoba) {
            if (false === $beneficjent->getOsobyZatrudnione()->contains($osoba)) {
                $this->_em->remove($osoba);
            }
        }
        foreach ($beneficjent->getOsobyZatrudnione() as $osoba) {
            $osoba->setBeneficjent($beneficjent);
        }
    }

    /**
     * Ustawia wartość pola wypełniony w zależności od kompletnosci profilu
     *
     * @param type $beneficjent
     */
    private function updateBeneficjentWypelniony(&$beneficjent)
    {
        $beneficjent->setWypelniony(false);

        if (count($beneficjent->getUmowy()) > 0 && count($beneficjent->getOsobyZatrudnione()) > 0) {
            $beneficjent->setWypelniony(true);
        }
    }
}
