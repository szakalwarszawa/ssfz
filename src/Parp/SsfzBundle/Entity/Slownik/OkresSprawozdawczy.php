<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;

/**
 * OkresSprawozdawczy
 *
 * @ORM\Table(name="slownik_okresow_sprawozdawczych")
 * @ORM\Entity
 */
class OkresSprawozdawczy
{
    const CALY_ROK = 1;
    const STYCZEN_CZERWIEC = 2;
    const LIPIEC_GRUDZIEN = 3;

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
     * Częstotliwość sprawozdań, której dotyczy okres.
     *
     * @var CzestotliwoscSprawozdan
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\CzestotliwoscSprawozdan")
     * @ORM\JoinColumn(name="czestotliwosc_sprawozdan_id", referencedColumnName="id", nullable=false)
     */
    protected $czestotliwoscSprawozdan;

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
     * @return OkresSprawozdawczy
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
        
        return $this;
    }

    /**
     * Set czestotliwoscSprawozdan
     *
     * @param CzestotliwoscSprawozdan $czestotliwoscSprawozdan
     *
     * @return OkresSprawozdawczy
     */
    public function setCzestotliwoscSprawozdan(CzestotliwoscSprawozdan $czestotliwoscSprawozdan = null)
    {
        $this->czestotliwoscSprawozdan = $czestotliwoscSprawozdan;

        return $this;
    }

    /**
     * Get czestotliwoscSprawozdan
     *
     * @return CzestotliwoscSprawozdan
     */
    public function getCzestotliwoscSprawozdan()
    {
        return $this->czestotliwoscSprawozdan;
    }
}
