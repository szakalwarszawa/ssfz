<?php

namespace Parp\SsfzBundle\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawna;
use Doctrine\Common\Collections\ArrayCollection;
use Parp\SsfzBundle\Entity\Slownik\TakNie;

/**
 * SprawozdaniePoreczeniowe
 *
 * @ORM\Table(name="sfz_sprawozdanie_poreczeniowe")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdaniePoreczenioweRepository")
 */
class SprawozdaniePoreczeniowe extends AbstractSprawozdanieSpo
{
    /**
     * Składniki ogółem.
     *
     * @ORM\OneToMany(targetEntity="SprawozdaniePoreczenioweSkladnikOgolem", mappedBy="sprawozdanie", cascade={"persist", "remove"})
     */
    protected $skladnikiOgolem;

    /**
     * Składniki wydzielone.
     *
     * @ORM\OneToMany(targetEntity="SprawozdaniePoreczenioweSkladnikWydzielony", mappedBy="sprawozdanie", cascade={"persist", "remove"})
     */
    protected $skladnikiWydzielone;

    /**
     * Posiada wydzielony księgowo fundusz.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(name="czy_posiada_wydzielony_fundusz", referencedColumnName="id", nullable=true)
     */
    protected $czyPosiadaWydzielonyFundusz;

    /**
     * Fundusz udziela poręczeń kredytów i pożyczek nie niżej oprocentowanych niż stopa referencyjna.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(name="czy_procent_nie_nizszy_od_stopy", referencedColumnName="id", nullable=true)
     */
    protected $czyOprocentowanieNieNizszeOdStopy;

    /**
     * Poręczenia udzielane są za wynagrodzeniem.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(name="czy_za_wynagrodzeniem", referencedColumnName="id", nullable=true)
     */
    protected $czyZaWynagrodzeniem;

    /**
     * Poręczenia są udzielane w wysokości nie przekraczającej 80% zobowiązania którego dotyczą.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(name="czy_nie_przekraczaja_80_procent", referencedColumnName="id", nullable=true)
     */
    protected $czyNiePrzekraczaja80;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skladnikiOgolem = new ArrayCollection();
        $this->skladnikiWydzielone = new ArrayCollection();
    }

    /**
     * Set czyPosiadaWydzielonyFundusz
     *
     * @param boolean $czyPosiadaWydzielonyFundusz
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setCzyPosiadaWydzielonyFundusz($czyPosiadaWydzielonyFundusz)
    {
        $this->czyPosiadaWydzielonyFundusz = $czyPosiadaWydzielonyFundusz;

        return $this;
    }

    /**
     * Get czyPosiadaWydzielonyFundusz
     *
     * @return boolean
     */
    public function getCzyPosiadaWydzielonyFundusz()
    {
        return $this->czyPosiadaWydzielonyFundusz;
    }

    /**
     * Set czyOprocentowanieNieNizszeOdStopy
     *
     * @param boolean $czyOprocentowanieNieNizszeOdStopy
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setCzyOprocentowanieNieNizszeOdStopy($czyOprocentowanieNieNizszeOdStopy)
    {
        $this->czyOprocentowanieNieNizszeOdStopy = $czyOprocentowanieNieNizszeOdStopy;

        return $this;
    }

    /**
     * Get czyOprocentowanieNieNizszeOdStopy
     *
     * @return boolean
     */
    public function getCzyOprocentowanieNieNizszeOdStopy()
    {
        return $this->czyOprocentowanieNieNizszeOdStopy;
    }

    /**
     * Set czyZaWynagrodzeniem
     *
     * @param boolean $czyZaWynagrodzeniem
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setCzyZaWynagrodzeniem($czyZaWynagrodzeniem)
    {
        $this->czyZaWynagrodzeniem = $czyZaWynagrodzeniem;

        return $this;
    }

    /**
     * Get czyZaWynagrodzeniem
     *
     * @return boolean
     */
    public function getCzyZaWynagrodzeniem()
    {
        return $this->czyZaWynagrodzeniem;
    }

    /**
     * Set czyNiePrzekraczaja80
     *
     * @param boolean $czyNiePrzekraczaja80
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setCzyNiePrzekraczaja80($czyNiePrzekraczaja80)
    {
        $this->czyNiePrzekraczaja80 = $czyNiePrzekraczaja80;

        return $this;
    }

    /**
     * Get czyNiePrzekraczaja80
     *
     * @return boolean
     */
    public function getCzyNiePrzekraczaja80()
    {
        return $this->czyNiePrzekraczaja80;
    }

    /**
     * Add skladnikiOgolem
     *
     * @param SprawozdaniePoreczenioweSkladnikOgolem $skladnikiOgolem
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function addSkladnikiOgolem(SprawozdaniePoreczenioweSkladnikOgolem $skladnikiOgolem)
    {
        $this->skladnikiOgolem[] = $skladnikiOgolem;

        return $this;
    }

    /**
     * Remove skladnikiOgolem
     *
     * @param SprawozdaniePoreczenioweSkladnikOgolem $skladnikiOgolem
     */
    public function removeSkladnikiOgolem(SprawozdaniePoreczenioweSkladnikOgolem $skladnikiOgolem)
    {
        $this->skladnikiOgolem->removeElement($skladnikiOgolem);
    }

    /**
     * Get skladnikiOgolem
     *
     * @return Collection
     */
    public function getSkladnikiOgolem()
    {
        return $this->skladnikiOgolem;
    }

    /**
     * Add skladnikiWydzielone
     *
     * @param SprawozdaniePoreczenioweSkladnikWydzielony $skladnikiWydzielone
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function addSkladnikiWydzielone(SprawozdaniePoreczenioweSkladnikWydzielony $skladnikiWydzielone)
    {
        $this->skladnikiWydzielone[] = $skladnikiWydzielone;

        return $this;
    }

    /**
     * Remove skladnikiWydzielone
     *
     * @param SprawozdaniePoreczenioweSkladnikWydzielony $skladnikiWydzielone
     */
    public function removeSkladnikiWydzielone(SprawozdaniePoreczenioweSkladnikWydzielony $skladnikiWydzielone)
    {
        $this->skladnikiWydzielone->removeElement($skladnikiWydzielone);
    }

    /**
     * Get skladnikiWydzielone
     *
     * @return Collection
     */
    public function getSkladnikiWydzielone()
    {
        return $this->skladnikiWydzielone;
    }
}