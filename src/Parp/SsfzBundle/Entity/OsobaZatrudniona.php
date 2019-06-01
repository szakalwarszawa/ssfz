<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OsobaZatrudniona
 *
 * @ORM\Table(name="sfz_osoba_zatrudniona")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\OsobaZatrudnionaRepository")
 */
class OsobaZatrudniona
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
     * @ORM\ManyToOne(targetEntity="Beneficjent", inversedBy="osobyZatrudnione")
     * @ORM\JoinColumn(name="beneficjent_id", referencedColumnName="id")
     */
    protected $beneficjent;

    /**
     * @var string
     *
     * @ORM\Column(name="imie", type="string", length=100, nullable=true)
     */
    protected $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=100, nullable=true)
     */
    protected $nazwisko;

    /**
     * @var string
     *
     * @ORM\Column(name="umowa_rodzaj", type="string", length=100, nullable=true)
     */
    protected $umowaRodzaj;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="umowa_data", type="datetime", nullable=true)
     */
    protected $umowaData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rozpoczecie_data", type="datetime", nullable=true)
     */
    protected $rozpoczecieData;

    /**
     * @var string
     *
     * @ORM\Column(name="stanowisko", type="string", length=100, nullable=true)
     */
    protected $stanowisko;

    /**
     * @var string
     *
     * @ORM\Column(name="wymiar", type="string", length=10, nullable=true)
     */
    protected $wymiar;

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
     * @param int $beneficjentId
     *
     * @return OsobaZatrudniona
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
     * @return OsobaZatrudniona
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
     * Set imie
     *
     * @param string $imie
     *
     * @return OsobaZatrudniona
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     *
     * @return OsobaZatrudniona
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set umowaRodzaj
     *
     * @param string $umowaRodzaj
     *
     * @return OsobaZatrudniona
     */
    public function setUmowaRodzaj($umowaRodzaj)
    {
        $this->umowaRodzaj = $umowaRodzaj;

        return $this;
    }

    /**
     * Get umowaRodzaj
     *
     * @return string
     */
    public function getUmowaRodzaj()
    {
        return $this->umowaRodzaj;
    }

    /**
     * Set umowaData
     *
     * @param \DateTime $umowaData
     *
     * @return OsobaZatrudniona
     */
    public function setUmowaData($umowaData)
    {
        $this->umowaData = $umowaData;

        return $this;
    }

    /**
     * Get umowaData
     *
     * @return \DateTime
     */
    public function getUmowaData()
    {
        return $this->umowaData;
    }

    /**
     * Set rozpoczecieData
     *
     * @param \DateTime $rozpoczecieData
     *
     * @return OsobaZatrudniona
     */
    public function setRozpoczecieData($rozpoczecieData)
    {
        $this->rozpoczecieData = $rozpoczecieData;

        return $this;
    }

    /**
     * Get rozpoczecieData
     *
     * @return \DateTime
     */
    public function getRozpoczecieData()
    {
        return $this->rozpoczecieData;
    }

    /**
     * Set stanowisko
     *
     * @param string $stanowisko
     *
     * @return OsobaZatrudniona
     */
    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * Get stanowisko
     *
     * @return string
     */
    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    /**
     * Set wymiar
     *
     * @param string $wymiar
     *
     * @return OsobaZatrudniona
     */
    public function setWymiar($wymiar)
    {
        $this->wymiar = $wymiar;

        return $this;
    }

    /**
     * Get wymiar
     *
     * @return string
     */
    public function getWymiar()
    {
        return $this->wymiar;
    }
}
