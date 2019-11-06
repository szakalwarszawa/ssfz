<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Parp\SsfzBundle\Entity\DanePozyczek;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikWydzielony;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikOgolem;

/**
 * SprawozdaniePozyczkowe
 *
 * @ORM\Table(name="sfz_sprawozdanie_pozyczkowe")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdaniePozyczkoweRepository")
 */
class SprawozdaniePozyczkowe extends AbstractSprawozdanieSpo
{
    /**
     * Składniki ogółem.
     *
     * @var Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikOgolem",
     *      mappedBy="sprawozdanie",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     *  )
     */
    protected $skladnikiOgolem;

    /**
     * Składniki wydzielone.
     *
     * @var Callection
     *
     * @ORM\OneToMany(
     *      targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePozyczkoweSkladnikWydzielony",
     *      mappedBy="sprawozdanie",
     *      orphanRemoval=true,
     *      cascade={"persist", "remove"}
     *  )
     */
    protected $skladnikiWydzielone;

    /**
     * Minimalne oprocentowanie.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="minimalne_oprocentowanie",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $minimalneOprocentowanie;

    /**
     * Maksymalna wielkość pożyczki (zł).
     *
     * @var string
     *
     * @ORM\Column(
     *     name="maksymalna_wielkosc_pozyczki",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $maksymalnaWielkoscPozyczki;

    /**
     * Kwota dotacji SPO WKP – wartość z umowy o dofinansowanie
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_dotacji_z_umowy_o_dofinansowanie",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $kwotaDotacjiZUmowyODofinansowanie;

    /**
     * Kwota dotacji SPO WKP – wartość na koniec okresu sprawozdawczego
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_dotacji_na_koniec_okresu_sprawozdawczego",
     *     type="decimal",
     *     precision=15,
     *     scale=2,
     *     nullable=true
     * )
     */
    protected $kwotaDotacjiNaKoniecOkresuSprawozdawczego;

    /**
     * @var DanePozyczek
     *
     * @ORM\OneToOne(
     *     targetEntity="Parp\SsfzBundle\Entity\DanePozyczek",
     *     mappedBy="sprawozdanie",
     *     cascade={"persist"}
     * )
     */
    protected $danePozyczek;

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
     * Set minimalneOprocentowanie
     *
     * @param string $minimalneOprocentowanie
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setMinimalneOprocentowanie($minimalneOprocentowanie)
    {
        $this->minimalneOprocentowanie = $minimalneOprocentowanie;

        return $this;
    }

    /**
     * Get minimalneOprocentowanie
     *
     * @return string
     */
    public function getMinimalneOprocentowanie()
    {
        return $this->minimalneOprocentowanie;
    }

    /**
     * Set maksymalnaWielkoscPozyczki
     *
     * @param string $maksymalnaWielkoscPozyczki
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setMaksymalnaWielkoscPozyczki($maksymalnaWielkoscPozyczki)
    {
        $this->maksymalnaWielkoscPozyczki = $maksymalnaWielkoscPozyczki;

        return $this;
    }

    /**
     * Get maksymalnaWielkoscPozyczki
     *
     * @return string
     */
    public function getMaksymalnaWielkoscPozyczki()
    {
        return $this->maksymalnaWielkoscPozyczki;
    }

    /**
     * Add skladnikiOgolem
     *
     * @param SprawozdaniePozyczkoweSkladnikOgolem $skladnikiOgolem
     *
     * @return SprawozdaniePozyczkowe
     */
    public function addSkladnikiOgolem(SprawozdaniePozyczkoweSkladnikOgolem $skladnikiOgolem)
    {
        $this->skladnikiOgolem[] = $skladnikiOgolem;

        return $this;
    }

    /**
     * Remove skladnikiOgolem
     *
     * @param SprawozdaniePozyczkoweSkladnikOgolem $skladnikiOgolem
     *
     * @return SprawozdaniePozyczkowe
     */
    public function removeSkladnikiOgolem(SprawozdaniePozyczkoweSkladnikOgolem $skladnikiOgolem)
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
     * @param SprawozdaniePozyczkoweSkladnikWydzielony $skladnikiWydzielone
     *
     * @return SprawozdaniePozyczkowe
     */
    public function addSkladnikiWydzielone(SprawozdaniePozyczkoweSkladnikWydzielony $skladnikiWydzielone)
    {
        $this->skladnikiWydzielone[] = $skladnikiWydzielone;

        return $this;
    }

    /**
     * Remove skladnikiWydzielone
     *
     * @param SprawozdaniePozyczkoweSkladnikWydzielony $skladnikiWydzielone
     *
     * @return SprawozdaniePozyczkowe
     */
    public function removeSkladnikiWydzielone(SprawozdaniePozyczkoweSkladnikWydzielony $skladnikiWydzielone)
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
     * Zwraca dane pożyczek.
     *
     * @return DanePozyczek
     */
    public function getDanePozyczek()
    {
        return $this->danePozyczek;
    }

    /**
     * Ustala dane pożyczek.
     *
     * @param DanePozyczek $danePozyczek
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setDanePozyczek(DanePozyczek $danePozyczek = null)
    {
        $this->danePozyczek = $danePozyczek;

        return $this;
    }

    /**
     * @return string
     */
    public function getKwotaDotacjiZUmowyODofinansowanie()
    {
        return $this->kwotaDotacjiZUmowyODofinansowanie;
    }

    /**
     * @param string $kwotaDotacjiZUmowyODofinansowanie
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setKwotaDotacjiZUmowyODofinansowanie($kwotaDotacjiZUmowyODofinansowanie)
    {
        $this->kwotaDotacjiZUmowyODofinansowanie = $kwotaDotacjiZUmowyODofinansowanie;

        return $this;
    }

    /**
     * @return string
     */
    public function getKwotaDotacjiNaKoniecOkresuSprawozdawczego()
    {
        return $this->kwotaDotacjiNaKoniecOkresuSprawozdawczego;
    }

    /**
     * @param string $kwotaDotacjiNaKoniecOkresuSprawozdawczego
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setKwotaDotacjiNaKoniecOkresuSprawozdawczego($kwotaDotacjiNaKoniecOkresuSprawozdawczego)
    {
        $this->kwotaDotacjiNaKoniecOkresuSprawozdawczego = $kwotaDotacjiNaKoniecOkresuSprawozdawczego;

        return $this;
    }
}
