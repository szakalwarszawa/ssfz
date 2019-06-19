<?php

namespace Parp\SsfzBundle\Entity\Slownik;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Form\Type\SprawozdanieType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePozyczkoweType;
use Parp\SsfzBundle\Form\Type\SprawozdaniePoreczenioweType;

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
     * Częstotliwość sprawozdań w programie.
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
        return Program::FUNDUSZ_ZALAZKOWY_POIG_31 === (int) $this->id;
    }
    
    /**
     * Czy dany program to fundusz zalążkowy.
     *
     * @return bool
     */
    public function czyFunduszZalazkowy()
    {
        return Program::FUNDUSZ_ZALAZKOWY_POIG_31 === (int) $this->id;
    }
    
    /**
     * Czy dany program to fundusz pożyczkowy.
     *
     * @return bool
     */
    public function czyFunduszPozyczkowy()
    {
        return Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121 === (int) $this->id;
    }
    
    /**
     * Czy dany program to fundusz poręczeniowy.
     *
     * @return bool
     */
    public function czyFunduszPoreczeniowy()
    {
        return Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122 === (int) $this->id;
    }
    
    /**
     * Zwraca nazwę encji ze sprawozdaniami używaną w programie.
     *
     * @param Program|null $program
     *
     * @return string
     */
    public static function jakaEncjaDlaProgramu(Program $program = null)
    {
        $programId =
            null === $program
            ? 0
            : (int) $program->getId()
        ;
        
        switch ($programId) {
            case Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121:
                return SprawozdaniePozyczkowe::class;

            case Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122:
                return SprawozdaniePoreczeniowe::class;

            case Program::FUNDUSZ_ZALAZKOWY_POIG_31:
            default:
                return Sprawozdanie::class;
        }
    }
    
    /**
     * Zwraca nazwę FormType dla sprawozdań używaną w programie.
     *
     * @param Program|null $program
     *
     * @return string
     */
    public static function jakiFormularzDlaProgramu(Program $program = null)
    {
        $programId =
            null === $program
            ? 0
            : (int) $program->getId()
        ;
        
        switch ($programId) {
            case Program::FUNDUSZ_POZYCZKOWY_SPO_WKP_121:
                return SprawozdaniePozyczkoweType::class;

            case Program::FUNDUSZ_PORECZENIOWY_SPO_WKP_122:
                return SprawozdaniePoreczenioweType::class;

            case Program::FUNDUSZ_ZALAZKOWY_POIG_31:
            default:
                return SprawozdanieType::class;
        }
    }

    /**
     * Set czestotliwoscSprawozdan
     *
     * @param CzestotliwoscSprawozdan $czestotliwoscSprawozdan
     *
     * @return Program
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
