<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaFunduszu;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Parp\SsfzBundle\Entity\Slownik\TakNie;
use Parp\SsfzBundle\Entity\DanePoreczen;

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
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="SprawozdaniePoreczenioweSkladnikOgolem",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $skladnikiOgolem;

    /**
     * Składniki wydzielone.
     *
     * @var Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="SprawozdaniePoreczenioweSkladnikWydzielony",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $skladnikiWydzielone;

    /**
     * Posiada wydzielony księgowo fundusz.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(
     *     name="czy_posiada_wydzielony_fundusz",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected $czyPosiadaWydzielonyFundusz;

    /**
     * Fundusz udziela poręczeń kredytów i pożyczek nie niżej oprocentowanych niż stopa referencyjna.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(
     *     name="czy_procent_nie_nizszy_od_stopy",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected $czyOprocentowanieNieNizszeOdStopy;

    /**
     * Poręczenia udzielane są za wynagrodzeniem.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(
     *     name="czy_za_wynagrodzeniem",
     *     referencedColumnName="id",
     *     nullable=true)
     */
    protected $czyZaWynagrodzeniem;

    /**
     * Poręczenia są udzielane w wysokości nie przekraczającej 80% zobowiązania którego dotyczą.
     *
     * @var bool
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\TakNie")
     * @ORM\JoinColumn(
     *     name="czy_nie_przekraczaja_80_procent",
     *     referencedColumnName="id",
     *     nullable=true
     * )
     */
    protected $czyNiePrzekraczaja80;

    /**
     * @var DanePoreczen
     *
     * @ORM\OneToOne(
     *     targetEntity="Parp\SsfzBundle\Entity\DanePoreczen",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist"}
     * )
     */
    protected $danePoreczen;

    /**
     * Kwota dotacji SPO WKP – wartość z umowy o dofinansowanie
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_dotacja_umowa_dofinansowanie",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $kwotaDotacjaUmowaDofinansowanie;

    /**
     * Kwota dotacji SPO WKP – wartość na koniec okresu sprawozdawczego
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_dotacja_koniec_okresu_sprawozdawczego",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $kwotaDotacjaKoniecOkresuSprawozdawczego;

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->skladnikiOgolem = new ArrayCollection();
        $this->skladnikiWydzielone = new ArrayCollection();
    }

    /**
     * Zwraca reprezentację tekstową obiektu.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * Set czyPosiadaWydzielonyFundusz
     *
     * @param bool $czyPosiadaWydzielonyFundusz
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
     * @return bool
     */
    public function getCzyPosiadaWydzielonyFundusz()
    {
        return $this->czyPosiadaWydzielonyFundusz;
    }

    /**
     * Set czyOprocentowanieNieNizszeOdStopy
     *
     * @param bool $czyOprocentowanieNieNizszeOdStopy
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
     * @return bool
     */
    public function getCzyOprocentowanieNieNizszeOdStopy()
    {
        return $this->czyOprocentowanieNieNizszeOdStopy;
    }

    /**
     * Set czyZaWynagrodzeniem
     *
     * @param bool $czyZaWynagrodzeniem
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
     * @return bool
     */
    public function getCzyZaWynagrodzeniem()
    {
        return $this->czyZaWynagrodzeniem;
    }

    /**
     * Set czyNiePrzekraczaja80
     *
     * @param bool $czyNiePrzekraczaja80
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
     * @return bool
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
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function removeSkladnikiOgolem(SprawozdaniePoreczenioweSkladnikOgolem $skladnikiOgolem)
    {
        $this->skladnikiOgolem->removeElement($skladnikiOgolem);

        return $this;
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
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function removeSkladnikiWydzielone(SprawozdaniePoreczenioweSkladnikWydzielony $skladnikiWydzielone)
    {
        $this->skladnikiWydzielone->removeElement($skladnikiWydzielone);

        return $this;
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

    /**
     * Zwraca dane poreczen.
     *
     * @return DanePoreczen
     */
    public function getDanePoreczen()
    {
        return $this->danePoreczen;
    }

    /**
     * Ustala dane poreczen.
     *
     * @param DanePoreczen $danePoreczen
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setDanePoreczen(DanePoreczen $danePoreczen = null)
    {
        $this->danePoreczen = $danePoreczen;

        return $this;
    }

    /**
     * @return string
     */
    public function getKwotaDotacjaUmowaDofinansowanie()
    {
        return $this->kwotaDotacjaUmowaDofinansowanie;
    }

    /**
     * @param string $kwotaDotacjaUmowaDofinansowanie
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setKwotaDotacjaUmowaDofinansowanie($kwotaDotacjaUmowaDofinansowanie)
    {
        $this->kwotaDotacjaUmowaDofinansowanie = $kwotaDotacjaUmowaDofinansowanie;

        return $this;
    }

    /**
     * @return string
     */
    public function getKwotaDotacjaKoniecOkresuSprawozdawczego()
    {
        return $this->kwotaDotacjaKoniecOkresuSprawozdawczego;
    }

    /**
     * @param string $kwotaDotacjaKoniecOkresuSprawozdawczego
     *
     * @return SprawozdaniePoreczeniowe
     */
    public function setKwotaDotacjaKoniecOkresuSprawozdawczego($kwotaDotacjaKoniecOkresuSprawozdawczego)
    {
        $this->kwotaDotacjaKoniecOkresuSprawozdawczego = $kwotaDotacjaKoniecOkresuSprawozdawczego;

        return $this;
    }
}
