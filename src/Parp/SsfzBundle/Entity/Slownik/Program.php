<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;

/**
 * Program
 *
 * @ORM\Table(name="slownik_programow")
 * @ORM\Entity
 */
class Program
{
    const FUNDUSZ_ZALAZKOWY_POIG_31 = 1;
    const FUNDUSZ_POZYCZKOWY_SPO_WKP_121 = 2;
    const FUNDUSZ_PORECZENIOWY_SPO_WKP_122 = 3;

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
     * Nazwa programu.
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
     * @return Program
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        
        return $this;
    }
    
    /**
     * Czy w umowach w danym programie jest portfel spółek.
     *
     * @return bool
     */
    public function czyJestPortfelSpolek()
    {
        return $this::FUNDUSZ_ZALAZKOWY_POIG_31 === (int) $this->id;
    }
}
