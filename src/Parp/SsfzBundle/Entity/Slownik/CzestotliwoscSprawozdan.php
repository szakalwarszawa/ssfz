<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;

/**
 * CzestotliwoscSprawozdan
 *
 * @ORM\Table(name="slownik_czestotliwosc_sprawozdan")
 * @ORM\Entity
 */
class CzestotliwoscSprawozdan
{
    const ROCZNA = 1;
    const POLROCZNA = 2;

    /**
     * ID programu.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Nazwa częstotliwości.
     *
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=64, unique=true)
     */
    protected $nazwa;

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
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getNazwa();
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return CzestotliwoscSprawozdan
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        
        return $this;
    }
    
    /**
     * Czy częstotliwość roczna.
     *
     * @return bool
     */
    public function czyRoczna()
    {
        return CzestotliwoscSprawozdan::ROCZNA === (int) $this->id;
    }
    
    /**
     * Czy częstotliwość półroczna.
     *
     * @return bool
     */
    public function czyPolroczna()
    {
        return CzestotliwoscSprawozdan::POLROCZNA === (int) $this->id;
    }
}
