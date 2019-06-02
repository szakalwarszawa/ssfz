<?php
namespace Parp\SsfzBundle\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Program
 *
 * @ORM\Table(name="slownik_program")
 * @ORM\Entity
 */
class Program implements Serializable
{
    const FUNDUSZ_ZALAZKOWY_POIG_31 = 31;
    const FUNDUSZ_POZYCZKOWY_SPO_WKP_121 = 121;
    const FUNDUSZ_PORECZENIOWY_SPO_WKP_122 = 122;

    /**
     * ID programu.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * Kolejność sortowania na listach.
     *
     * @var int
     *
     * @ORM\Column(name="kolejnosc", type="integer")
     */
    protected $kolejnosc;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set kolejnosc
     *
     * @param integer $kolejnosc
     *
     * @return Program
     */
    public function setKolejnosc($kolejnosc)
    {
        $this->kolejnosc = $kolejnosc;

        return $this;
    }

    /**
     * Get kolejnosc
     *
     * @return integer
     */
    public function getKolejnosc()
    {
        return $this->kolejnosc;
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
     * @return Object
     */
    public function serialize()
    {
        return serialize(
            array(
            $this->id,
            $this->nazwa
            )
        );
    }

    /**
     * @param Object $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->nazwa
            ) = unserialize($serialized);
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
