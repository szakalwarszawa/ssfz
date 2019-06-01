<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umowa
 *
 * @ORM\Table(name="sfz_umowa")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\UmowaRepository")
 */
class Umowa
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="beneficjent_id", type="integer")
     */
    protected $beneficjentId;

    /**
     * @ORM\ManyToOne(targetEntity="Beneficjent", inversedBy="umowy")
     * @ORM\JoinColumn(name="beneficjent_id", referencedColumnName="id")
     */
    protected $beneficjent;

    /**
     * @var string
     *
     * @ORM\Column(name="numer", type="string", length=26)
     */
    protected $numer;

    /**
     * Encje Spolka powiazane z umową - spółki składające się na portfel
     *
     * @ORM\OneToMany(targetEntity="Spolka", mappedBy="umowa", cascade={"persist"})
     */
    protected $spolki;

    /**
     * Encje Spolka powiazane z umową - spółki składające się na portfel
     *
     * @ORM\OneToMany(targetEntity="Sprawozdanie", mappedBy="umowa", cascade={"persist"})
     */
    protected $sprawozdania;

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->spolki = new ArrayCollection();
        $this->sprawozdania = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set beneficjentId
     *
     * @param  int $beneficjentId
     *
     * @return Umowa
     */
    public function setBeneficjentId($beneficjentId)
    {
        $this->beneficjentId = $beneficjentId;

        return $this;
    }

    /**
     * Get beneficjentId
     *
     * @return int
     */
    public function getBeneficjentId()
    {
        return $this->beneficjentId;
    }

    /**
     * Set beneficjent
     *
     * @param Beneficjent $beneficjent
     *
     * @return Umowa
     */
    public function setBeneficjent($beneficjent)
    {
        $this->beneficjent = $beneficjent;

        return $this;
    }

    /**
     * Get beneficjent
     *
     * @return Beneficjent
     */
    public function getBeneficjent()
    {
        return $this->beneficjent;
    }

    /**
     * Set numer
     *
     * @param string $numer
     *
     * @return Umowa
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return string
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * Set spolki
     *
     * @param Collection Spolka $spolki
     *
     * @return Umowa
     */
    public function setSpolki($spolki)
    {
        $this->spolki = $spolki;

        return $this;
    }

    /**
     * Get spolki
     *
     * @return Collection
     */
    public function getSpolki()
    {
        return $this->spolki;
    }

    /**
     * Set spolki
     *
     * @param Collection $sprawozdania
     *
     * @return Umowa
     */
    public function setSprawozdania($sprawozdania)
    {
        $this->sprawozdania = $sprawozdania;

        return $this;
    }

    /**
     * Get sprawozdania
     *
     * @return Collection
     */
    public function getSprawozdania()
    {
        return $this->sprawozdania;
    }

    /**
     * Dodaje spółkę do portfela spółek umowy
     *
     * @param \Parp\SsfzBundle\Entity\Spolka $spolka
     */
    public function addSpolka(Spolka $spolka)
    {
        $spolka->setUmowa($this);
        $this->spolki->add($spolka);
    }

    /**
     * Dodaje sprawozdanie do wykazu sprawozdań.
     *
     * @param \Parp\SsfzBundle\Entity\Sprawozdanie $sprawozdanie
     */
    public function addSprawozdanie(Sprawozdanie $sprawozdanie)
    {
        $sprawozdanie->setUmowa($this);
        $this->sprawozdania->add($sprawozdanie);
    }
}
