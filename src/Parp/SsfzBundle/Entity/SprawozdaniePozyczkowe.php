<?php

namespace Parp\SsfzBundle\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity="SprawozdaniePozyczkoweSkladnikOgolem", mappedBy="sprawozdanie", cascade={"persist", "remove"})
     */
    protected $skladnikiOgolem;

    /**
     * Składniki wydzielone.
     *
     * @ORM\OneToMany(targetEntity="SprawozdaniePozyczkoweSkladnikWydzielony", mappedBy="sprawozdanie", cascade={"persist", "remove"})
     */
    protected $skladnikiWydzielone;

    /**
     * Minimalne oprocentowanie.
     *
     * @var string
     *
     * @ORM\Column(name="minimalne_oprocentowanie", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $minimalneOprocentowanie;

    /**
     * Maksymalna wielkość pożyczki (zł).
     *
     * @var string
     *
     * @ORM\Column(name="maksymalna_wielkosc_pozyczki", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $maksymalnaWielkoscPozyczki;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skladnikiOgolem = new ArrayCollection();
        $this->skladnikiWydzielone = new ArrayCollection();
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
     */
    public function removeSkladnikiOgolem(SprawozdaniePozyczkoweSkladnikOgolem $skladnikiOgolem)
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
     */
    public function removeSkladnikiWydzielone(SprawozdaniePozyczkoweSkladnikWydzielony $skladnikiWydzielone)
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
