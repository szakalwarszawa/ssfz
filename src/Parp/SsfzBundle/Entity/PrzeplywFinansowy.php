<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * PrzeplywFinansowy
 *
 * @ORM\Table(name="sfz_przeplyw_finansowy")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\PrzeplywFinansowyRepository")
 */
class PrzeplywFinansowy
{

    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var int
     *
     * @ORM\Column(name="creator_id", type="integer", nullable=false)
     */
    private $creatorId;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="data_rejestracji", type="datetime", nullable=false)
     */
    private $dataRejestracji;
    
    /**
     * @var int
     *
     * @ORM\Column(name="sprawozdanie_id", type="integer", nullable=false)
     */
    private $sprawozdanieId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="$saldo_poczatkowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $saldoPoczatkowe;
    
    /**
     * @var string
     *
     * @ORM\Column(name="wplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $wplywy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="wyjscia_z_inwestycji", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $wyjsciaZInwestycji;
    
    /**
     * @var string
     *
     * @ORM\Column(name="udzial_w_zyskach", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $udzialWZyskach;
    
    /**
     * @var string
     *
     * @ORM\Column(name="inne_wplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $inneWplywy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="wyplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $wyplywy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="wejcia_kapitalowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $wejsciaKapitalowe;
    
    /**
     * @var string
     *
     * @ORM\Column(name="preinkubacja_pomyslow", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $preinkubacjaPomyslow;
    
    /**
     * @var string
     *
     * @ORM\Column(name="wydatki_operacyjne", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $wydatkiOperacyjne;
    
    /**
     * @var string
     *
     * @ORM\Column(name="podatki", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $podatki;
    
    /**
     * @var string
     *
     * @ORM\Column(name="inne_wyplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $inneWyplywy;
    
    /**
     * @var string
     *
     * @ORM\Column(name="saldo_koncowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $saldoKoncowe;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_w_inkubatorze", type="integer", nullable=false)
     */
    private $liczbaPomyslowWInkubatorze;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych", type="integer", nullable=false)
     */
    private $liczbaPomyslowOcenionych;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych_pozytywnie", type="integer", nullable=false)
     */
    private $liczbaPomyslowOcenionychPozytywnie;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych_negatywnie", type="integer", nullable=false)
     */
    private $liczbaPomyslowOcenionychNegatywnie;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_zakonczonych_preinkubacji", type="integer", nullable=false)
     */
    private $liczbaZakonczonychPreinkubacji;
    
    /**
     * @var int
     *
     * @ORM\Column(name="liczba_dokonanych_inwestycji", type="integer", nullable=false)
     */
    private $liczbaDokonanychInwestycji;
    
    /**
     * zwraca Id
     *
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }
    
    /**
     * zwraca creatorId
     *
     * @return int
     */
    public function getCreatorId() 
    {
        return $this->creatorId;
    }

    /**
     * zwraca dataRejestracji
     *
     * @return DateTime
     */
    public function getDataRejestracji() 
    {
        return $this->dataRejestracji;
    }

    /**
     * zwraca sprawozdanieID
     *
     * @return int
     */
    public function getSprawozdanieId() 
    {
        return $this->sprawozdanieId;
    }

    /**
     * zwraca saldoPoczatkowe
     *
     * @return decimal
     */
    public function getSaldoPoczatkowe() 
    {
        return $this->saldoPoczatkowe;
    }

    /**
     * zwraca wplywy
     *
     * @return decimal
     */
    public function getWplywy() 
    {
        return $this->wplywy;
    }

    /**
     * zwraca wyjsciaZInwestycji
     *
     * @return decimal
     */
    public function getWyjsciaZInwestycji() 
    {
        return $this->wyjsciaZInwestycji;
    }

    /**
     * zwraca udzialWZyskach
     *
     * @return decimal
     */
    public function getUdzialWZyskach() 
    {
        return $this->udzialWZyskach;
    }

    /**
     * zwraca inneWplywy
     *
     * @return decimal
     */
    public function getInneWplywy() 
    {
        return $this->inneWplywy;
    }

    /**
     * zwraca wyplywy
     *
     * @return decimal
     */
    public function getWyplywy() 
    {
        return $this->wyplywy;
    }

    /**
     * zwraca wejsciaKapitalowe
     *
     * @return decimal
     */
    public function getWejsciaKapitalowe() 
    {
        return $this->wejsciaKapitalowe;
    }

    /**
     * zwraca preinkubacjaPomyslow
     *
     * @return decimal
     */
    public function getPreinkubacjaPomyslow()
    {
        return $this->preinkubacjaPomyslow;
    }

    /**
     * zwraca wydatkiOperacyjne
     *
     * @return decimal
     */
    public function getWydatkiOperacyjne() 
    {
        return $this->wydatkiOperacyjne;
    }

    /**
     * zwraca podatki
     *
     * @return decimal
     */
    public function getPodatki() 
    {
        return $this->podatki;
    }

    /**
     * zwraca inneWyplywy
     *
     * @return decimal
     */
    public function getInneWyplywy() 
    {
        return $this->inneWyplywy;
    }

    /**
     * zwraca saldoKoncowe
     *
     * @return decimal
     */
    public function getSaldoKoncowe() 
    {
        return $this->saldoKoncowe;
    }

    /**
     * zwraca liczbaPomyslowWInkubatorze
     *
     * @return int
     */
    public function getLiczbaPomyslowWInkubatorze() 
    {
        return $this->liczbaPomyslowWInkubatorze;
    }

    /**
     * zwraca liczbaPomyslowOcenionych
     * 
     * @return int
     */
    public function getLiczbaPomyslowOcenionych() 
    {
        return $this->liczbaPomyslowOcenionych;
    }

    /**
     * zwraca liczbaPomyslowOcenionychPozytywnie
     *
     * @return int
     */
    public function getLiczbaPomyslowOcenionychPozytywnie() 
    {
        return $this->liczbaPomyslowOcenionychPozytywnie;
    }

    /**
     * zwraca liczbaPomyslowOcenionychNegatywnie
     *
     * @return int
     */
    public function getLiczbaPomyslowOcenionychNegatywnie() 
    {
        return $this->liczbaPomyslowOcenionychNegatywnie;
    }

    /**
     * zwraca liczbaZakonczonychPreinkubacji
     *
     * @return int
     */
    public function getLiczbaZakonczonychPreinkubacji() 
    {
        return $this->liczbaZakonczonychPreinkubacji;
    }

    /**
     * zwraca liczbaDokonanychInwestycji
     *
     * @return int
     */
    public function getLiczbaDokonanychInwestycji() 
    {
        return $this->liczbaDokonanychInwestycji;
    }

    
    /**
     * ustawia $id
     * 
     * @param int $id
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * ustawia $creatorId
     * 
     * @param int $creatorId
     */
    public function setCreatorId($creatorId)       
    {
        $this->creatorId = $creatorId;
    }

    /**
     * ustawia $dataRejestracji
     * 
     * @param DateTime $dataRejestracji
     */
    public function setDataRejestracji($dataRejestracji) 
    {
        $this->dataRejestracji = $dataRejestracji;
    }

    /**
     * ustawia $sprawozdanieId
     * 
     * @param int $sprawozdanieId
     */
    public function setSprawozdanieId($sprawozdanieId) 
    {
        $this->sprawozdanieId = $sprawozdanieId;
    }

    /**
     * ustawia $saldoPoczatkowe
     * 
     * @param decimal $saldoPoczatkowe
     */
    public function setSaldoPoczatkowe($saldoPoczatkowe) 
    {
        $this->saldoPoczatkowe = $saldoPoczatkowe;
    }

    /**
     * ustawia $wplywy
     * 
     * @param decimal $wplywy
     */
    public function setWplywy($wplywy) 
    {
        $this->wplywy = $wplywy;
    }

    /**
     * ustawia $wyjsciaZInwestycji
     * 
     * @param decimal $wyjsciaZInwestycji
     */
    public function setWyjsciaZInwestycji($wyjsciaZInwestycji) 
    {
        $this->wyjsciaZInwestycji = $wyjsciaZInwestycji;
    }

    /**
     * ustawia $udzialWZyskach
     * 
     * @param decimal $udzialWZyskach
     */
    public function setUdzialWZyskach($udzialWZyskach) 
    {
        $this->udzialWZyskach = $udzialWZyskach;
    }

    /**
     * ustawia $inneWplywy
     * 
     * @param decimal $inneWplywy
     */
    public function setInneWplywy($inneWplywy) 
    {
        $this->inneWplywy = $inneWplywy;
    }

    /**
     * ustawia $wyplywy
     * 
     * @param decimal $wyplywy
     */
    public function setWyplywy($wyplywy) 
    {
        $this->wyplywy = $wyplywy;
    }

    /**
     * ustawia $wejsciaKapitalowe
     * 
     * @param decimal $wejsciaKapitalowe
     */
    public function setWejsciaKapitalowe($wejsciaKapitalowe) 
    {
        $this->wejsciaKapitalowe = $wejsciaKapitalowe;
    }

    /**
     * ustawia $preinkubacjaPomyslow
     * 
     * @param decimal $preinkubacjaPomyslow
     */
    public function setPreinkubacjaPomyslow($preinkubacjaPomyslow) 
    {
        $this->preinkubacjaPomyslow = $preinkubacjaPomyslow;
    }

    /**
     * ustawia $wydatkiOperacyjne
     * 
     * @param decimal $wydatkiOperacyjne
     */
    public function setWydatkiOperacyjne($wydatkiOperacyjne) 
    {
        $this->wydatkiOperacyjne = $wydatkiOperacyjne;
    }

    /**
     * ustawia $podatki
     * 
     * @param decimal $podatki
     */
    public function setPodatki($podatki) 
    {
        $this->podatki = $podatki;
    }

    /**
     * ustawia $inneWyplywy
     * 
     * @param decimal $inneWyplywy
     */
    public function setInneWyplywy($inneWyplywy) 
    {
        $this->inneWyplywy = $inneWyplywy;
    }

    /**
     * ustawia $saldoKoncowe
     * 
     * @param decimal $saldoKoncowe
     */
    public function setSaldoKoncowe($saldoKoncowe) 
    {
        $this->saldoKoncowe = $saldoKoncowe;
    }

    /**
     * ustawia $liczbaPomyslowWInkubatorze
     * 
     * @param int $liczbaPomyslowWInkubatorze
     */
    public function setLiczbaPomyslowWInkubatorze($liczbaPomyslowWInkubatorze) 
    {
        $this->liczbaPomyslowWInkubatorze = $liczbaPomyslowWInkubatorze;
    }

    /**
     * ustawia $liczbaPomyslowOcenionych
     * 
     * @param int $liczbaPomyslowOcenionych
     */
    public function setLiczbaPomyslowOcenionych($liczbaPomyslowOcenionych) 
    {
        $this->liczbaPomyslowOcenionych = $liczbaPomyslowOcenionych;
    }

    /**
     * ustawia $liczbaPomyslowOcenionychPozytywnie
     * 
     * @param int $liczbaPomyslowOcenionychPozytywnie
     */
    public function setLiczbaPomyslowOcenionychPozytywnie($liczbaPomyslowOcenionychPozytywnie) 
    {
        $this->liczbaPomyslowOcenionychPozytywnie = $liczbaPomyslowOcenionychPozytywnie;
    }

    /**
     * ustawia $liczbaPomyslowOcenionychNegatywnie
     * 
     * @param int $liczbaPomyslowOcenionychNegatywnie
     */
    public function setLiczbaPomyslowOcenionychNegatywnie($liczbaPomyslowOcenionychNegatywnie) 
    {
        $this->liczbaPomyslowOcenionychNegatywnie = $liczbaPomyslowOcenionychNegatywnie;
    }

    /**
     * ustawia $liczbaZakonczonychPreinkubacji
     * 
     * @param int $liczbaZakonczonychPreinkubacji
     */
    public function setLiczbaZakonczonychPreinkubacji($liczbaZakonczonychPreinkubacji) 
    {
        $this->liczbaZakonczonychPreinkubacji = $liczbaZakonczonychPreinkubacji;
    }

    /**
     * ustawia $liczbaDokonanychInwestycji
     * 
     * @param int $liczbaDokonanychInwestycji
     */
    public function setLiczbaDokonanychInwestycji($liczbaDokonanychInwestycji) 
    {
        $this->liczbaDokonanychInwestycji = $liczbaDokonanychInwestycji;
    }

    /**
     * Metoda waliduje obiekt
     * 
     * @param ExecutionContextInterface $context
     * 
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        $wplywySum = floatval(str_replace(',', '.', $this->getWyjsciaZInwestycji())) + floatval(str_replace(',', '.', $this->getUdzialWZyskach())) + floatval(str_replace(',', '.', $this->getInneWplywy()));
        $wplywy = floatval(str_replace(',', '.', $this->getWplywy()));
        if (number_format((float) $wplywy, 2, '.', '') != number_format((float) $wplywySum, 2, '.', '')) {
            $context->buildViolation('Niewłaściwa suma ' . floatval(str_replace(',', '.', $this->getWplywy())) . ' ' . $wplywySum)
                ->atPath('wplywy')
                ->addViolation();
        }
        
        $wyplywySum = floatval(str_replace(',', '.', $this->getWejsciaKapitalowe())) + floatval(str_replace(',', '.', $this->getPreinkubacjaPomyslow())) + floatval(str_replace(',', '.', $this->getWydatkiOperacyjne())) + floatval(str_replace(',', '.', $this->getPodatki())) + floatval(str_replace(',', '.', $this->getInneWyplywy()));
        $wyplywy = floatval(str_replace(',', '.', $this->getWyplywy()));
        if (number_format((float) $wyplywy, 2, '.', '') != number_format((float) $wyplywySum, 2, '.', '')) {
            $context->buildViolation('Niewłaściwa suma')
                ->atPath('wyplywy')
                ->addViolation();
        }
        $saldoKoncoweSuma = floatval(str_replace(',', '.', $this->getWplywy())) +  floatval(str_replace(',', '.', $this->getSaldoPoczatkowe())) -  floatval(str_replace(',', '.', $this->getWyplywy()));
        $saldoKoncowe = floatval(str_replace(',', '.', $this->getSaldoKoncowe()));
        if (number_format((float) $saldoKoncowe, 2, '.', '') != number_format((float) $saldoKoncoweSuma, 2, '.', '')) {
            $roznica = $saldoKoncoweSuma -$saldoKoncowe;
            $message = 'Niewłaściwa suma'. $roznica;
            $context->buildViolation($message)
                ->atPath('saldoKoncowe')
                ->addViolation();
        }
    }

}
