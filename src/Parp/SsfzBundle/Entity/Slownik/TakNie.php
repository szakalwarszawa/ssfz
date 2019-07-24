<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;

/**
 * TakNie.
 *
 * @ORM\Table(name="slownik_tak_nie")
 * @ORM\Entity
 */
class TakNie
{
    const TAK = 1;
    const NIE = 2;

    const T = 1;
    const N = 2;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="wartosc", type="string", length=25, nullable=false, unique=true)
     */
    protected $wartosc;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=25, nullable=false, unique=true)
     */
    protected $kod;

    /**
     * Zwraca tekstową reprezentację obiektu.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->wartosc;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set wartosc.
     *
     * @param string $wartosc
     *
     * @return TSlownik
     */
    public function setWartosc($wartosc)
    {
        $this->wartosc = $wartosc;

        return $this;
    }

    /**
     * Get wartosc.
     *
     * @return string
     */
    public function getWartosc()
    {
        return $this->wartosc;
    }

    /**
     * Set kod.
     *
     * @param string $kod
     *
     * @return TSlownik
     */
    public function setKod($kod)
    {
        $this->kod = $kod;

        return $this;
    }

    /**
     * Get kod.
     *
     * @return string
     */
    public function getKod()
    {
        return $this->kod;
    }
    
    /**
     * Informuje, czy odpowiedź to TAK.
     *
     * @return bool
     */
    public function czyTak()
    {
        return $this->id === $this::TAK;
    }
    
    /**
     * Informuje, czy odpowiedź to NIE.
     *
     * @return bool
     */
    public function czyNie()
    {
        return $this->id === $this::NIE;
    }
}
