<?php

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
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="creator_id", type="integer", nullable=false)
     */
    protected $creatorId;

    /**
     * @var datetime
     *
     * @ORM\Column(name="data_rejestracji", type="datetime", nullable=false)
     */
    protected $dataRejestracji;

    /**
     * @var int
     *
     * @ORM\Column(name="sprawozdanie_id", type="integer", nullable=false)
     */
    protected $sprawozdanieId;

    /**
     * @var string
     *
     * @ORM\Column(name="$saldo_poczatkowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $saldoPoczatkowe;

    /**
     * @var string
     *
     * @ORM\Column(name="wplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $wplywy;

    /**
     * @var string
     *
     * @ORM\Column(name="wyjscia_z_inwestycji", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $wyjsciaZInwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="udzial_w_zyskach", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $udzialWZyskach;

    /**
     * @var string
     *
     * @ORM\Column(name="inne_wplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $inneWplywy;

    /**
     * @var string
     *
     * @ORM\Column(name="wyplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $wyplywy;

    /**
     * @var string
     *
     * @ORM\Column(name="wejcia_kapitalowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $wejsciaKapitalowe;

    /**
     * @var string
     *
     * @ORM\Column(name="preinkubacja_pomyslow", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $preinkubacjaPomyslow;

    /**
     * @var string
     *
     * @ORM\Column(name="wydatki_operacyjne", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $wydatkiOperacyjne;

    /**
     * @var string
     *
     * @ORM\Column(name="podatki", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $podatki;

    /**
     * @var string
     *
     * @ORM\Column(name="inne_wyplywy", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $inneWyplywy;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_koncowe", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $saldoKoncowe;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_w_inkubatorze", type="integer", nullable=false)
     */
    protected $liczbaPomyslowWInkubatorze;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych", type="integer", nullable=false)
     */
    protected $liczbaPomyslowOcenionych;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych_pozytywnie", type="integer", nullable=false)
     */
    protected $liczbaPomyslowOcenionychPozytywnie;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_pomyslow_ocenionych_negatywnie", type="integer", nullable=false)
     */
    protected $liczbaPomyslowOcenionychNegatywnie;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_zakonczonych_preinkubacji", type="integer", nullable=false)
     */
    protected $liczbaZakonczonychPreinkubacji;

    /**
     * @var int
     *
     * @ORM\Column(name="liczba_dokonanych_inwestycji", type="integer", nullable=false)
     */
    protected $liczbaDokonanychInwestycji;

    /**
     * Zwraca Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Zwraca creatorId
     *
     * @return int
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * Zwraca dataRejestracji
     *
     * @return DateTime
     */
    public function getDataRejestracji()
    {
        return $this->dataRejestracji;
    }

    /**
     * Zwraca sprawozdanieID
     *
     * @return int
     */
    public function getSprawozdanieId()
    {
        return $this->sprawozdanieId;
    }

    /**
     * Zwraca saldoPoczatkowe
     *
     * @return float
     */
    public function getSaldoPoczatkowe()
    {
        return $this->saldoPoczatkowe;
    }

    /**
     * Zwraca wplywy
     *
     * @return float
     */
    public function getWplywy()
    {
        return $this->wplywy;
    }

    /**
     * Zwraca wyjsciaZInwestycji
     *
     * @return float
     */
    public function getWyjsciaZInwestycji()
    {
        return $this->wyjsciaZInwestycji;
    }

    /**
     * Zwraca udzialWZyskach
     *
     * @return float
     */
    public function getUdzialWZyskach()
    {
        return $this->udzialWZyskach;
    }

    /**
     * Zwraca inneWplywy
     *
     * @return float
     */
    public function getInneWplywy()
    {
        return $this->inneWplywy;
    }

    /**
     * Zwraca wyplywy
     *
     * @return float
     */
    public function getWyplywy()
    {
        return $this->wyplywy;
    }

    /**
     * Zwraca wejsciaKapitalowe
     *
     * @return float
     */
    public function getWejsciaKapitalowe()
    {
        return $this->wejsciaKapitalowe;
    }

    /**
     * Zwraca preinkubacjaPomyslow
     *
     * @return float
     */
    public function getPreinkubacjaPomyslow()
    {
        return $this->preinkubacjaPomyslow;
    }

    /**
     * Zwraca wydatkiOperacyjne
     *
     * @return float
     */
    public function getWydatkiOperacyjne()
    {
        return $this->wydatkiOperacyjne;
    }

    /**
     * Zwraca podatki
     *
     * @return float
     */
    public function getPodatki()
    {
        return $this->podatki;
    }

    /**
     * Zwraca inneWyplywy
     *
     * @return float
     */
    public function getInneWyplywy()
    {
        return $this->inneWyplywy;
    }

    /**
     * Zwraca saldoKoncowe
     *
     * @return float
     */
    public function getSaldoKoncowe()
    {
        return $this->saldoKoncowe;
    }

    /**
     * Zwraca liczbaPomyslowWInkubatorze
     *
     * @return int
     */
    public function getLiczbaPomyslowWInkubatorze()
    {
        return $this->liczbaPomyslowWInkubatorze;
    }

    /**
     * Zwraca liczbaPomyslowOcenionych
     *
     * @return int
     */
    public function getLiczbaPomyslowOcenionych()
    {
        return $this->liczbaPomyslowOcenionych;
    }

    /**
     * Zwraca liczbaPomyslowOcenionychPozytywnie
     *
     * @return int
     */
    public function getLiczbaPomyslowOcenionychPozytywnie()
    {
        return $this->liczbaPomyslowOcenionychPozytywnie;
    }

    /**
     * Zwraca liczbaPomyslowOcenionychNegatywnie
     *
     * @return int
     */
    public function getLiczbaPomyslowOcenionychNegatywnie()
    {
        return $this->liczbaPomyslowOcenionychNegatywnie;
    }

    /**
     * Zwraca liczbaZakonczonychPreinkubacji
     *
     * @return int
     */
    public function getLiczbaZakonczonychPreinkubacji()
    {
        return $this->liczbaZakonczonychPreinkubacji;
    }

    /**
     * Zwraca liczbaDokonanychInwestycji
     *
     * @return int
     */
    public function getLiczbaDokonanychInwestycji()
    {
        return $this->liczbaDokonanychInwestycji;
    }

    /**
     * Ustawia $id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Ustawia $creatorId
     *
     * @param int $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    /**
     * Ustawia $dataRejestracji
     *
     * @param DateTime $dataRejestracji
     */
    public function setDataRejestracji($dataRejestracji)
    {
        $this->dataRejestracji = $dataRejestracji;
    }

    /**
     * Ustawia $sprawozdanieId
     *
     * @param int $sprawozdanieId
     */
    public function setSprawozdanieId($sprawozdanieId)
    {
        $this->sprawozdanieId = $sprawozdanieId;
    }

    /**
     * Ustawia $saldoPoczatkowe
     *
     * @param float $saldoPoczatkowe
     */
    public function setSaldoPoczatkowe($saldoPoczatkowe)
    {
        $this->saldoPoczatkowe = $saldoPoczatkowe;
    }

    /**
     * Ustawia $wplywy
     *
     * @param float $wplywy
     */
    public function setWplywy($wplywy)
    {
        $this->wplywy = $wplywy;
    }

    /**
     * Ustawia $wyjsciaZInwestycji
     *
     * @param float $wyjsciaZInwestycji
     */
    public function setWyjsciaZInwestycji($wyjsciaZInwestycji)
    {
        $this->wyjsciaZInwestycji = $wyjsciaZInwestycji;
    }

    /**
     * Ustawia $udzialWZyskach
     *
     * @param float $udzialWZyskach
     */
    public function setUdzialWZyskach($udzialWZyskach)
    {
        $this->udzialWZyskach = $udzialWZyskach;
    }

    /**
     * Ustawia $inneWplywy
     *
     * @param float $inneWplywy
     */
    public function setInneWplywy($inneWplywy)
    {
        $this->inneWplywy = $inneWplywy;
    }

    /**
     * Ustawia $wyplywy
     *
     * @param float $wyplywy
     */
    public function setWyplywy($wyplywy)
    {
        $this->wyplywy = $wyplywy;
    }

    /**
     * Ustawia $wejsciaKapitalowe
     *
     * @param float $wejsciaKapitalowe
     */
    public function setWejsciaKapitalowe($wejsciaKapitalowe)
    {
        $this->wejsciaKapitalowe = $wejsciaKapitalowe;
    }

    /**
     * Ustawia $preinkubacjaPomyslow
     *
     * @param float $preinkubacjaPomyslow
     */
    public function setPreinkubacjaPomyslow($preinkubacjaPomyslow)
    {
        $this->preinkubacjaPomyslow = $preinkubacjaPomyslow;
    }

    /**
     * Ustawia $wydatkiOperacyjne
     *
     * @param float $wydatkiOperacyjne
     */
    public function setWydatkiOperacyjne($wydatkiOperacyjne)
    {
        $this->wydatkiOperacyjne = $wydatkiOperacyjne;
    }

    /**
     * Ustawia $podatki
     *
     * @param float $podatki
     */
    public function setPodatki($podatki)
    {
        $this->podatki = $podatki;
    }

    /**
     * Ustawia $inneWyplywy
     *
     * @param float $inneWyplywy
     */
    public function setInneWyplywy($inneWyplywy)
    {
        $this->inneWyplywy = $inneWyplywy;
    }

    /**
     * Ustawia $saldoKoncowe
     *
     * @param float $saldoKoncowe
     */
    public function setSaldoKoncowe($saldoKoncowe)
    {
        $this->saldoKoncowe = $saldoKoncowe;
    }

    /**
     * Ustawia $liczbaPomyslowWInkubatorze
     *
     * @param int $liczbaPomyslowWInkubatorze
     */
    public function setLiczbaPomyslowWInkubatorze($liczbaPomyslowWInkubatorze)
    {
        $this->liczbaPomyslowWInkubatorze = $liczbaPomyslowWInkubatorze;
    }

    /**
     * Ustawia $liczbaPomyslowOcenionych
     *
     * @param int $liczbaPomyslowOcenionych
     */
    public function setLiczbaPomyslowOcenionych($liczbaPomyslowOcenionych)
    {
        $this->liczbaPomyslowOcenionych = $liczbaPomyslowOcenionych;
    }

    /**
     * Ustawia $liczbaPomyslowOcenionychPozytywnie
     *
     * @param int $liczbaPomyslowOcenionychPozytywnie
     */
    public function setLiczbaPomyslowOcenionychPozytywnie($liczbaPomyslowOcenionychPozytywnie)
    {
        $this->liczbaPomyslowOcenionychPozytywnie = $liczbaPomyslowOcenionychPozytywnie;
    }

    /**
     * Ustawia $liczbaPomyslowOcenionychNegatywnie
     *
     * @param int $liczbaPomyslowOcenionychNegatywnie
     */
    public function setLiczbaPomyslowOcenionychNegatywnie($liczbaPomyslowOcenionychNegatywnie)
    {
        $this->liczbaPomyslowOcenionychNegatywnie = $liczbaPomyslowOcenionychNegatywnie;
    }

    /**
     * Ustawia $liczbaZakonczonychPreinkubacji
     *
     * @param int $liczbaZakonczonychPreinkubacji
     */
    public function setLiczbaZakonczonychPreinkubacji($liczbaZakonczonychPreinkubacji)
    {
        $this->liczbaZakonczonychPreinkubacji = $liczbaZakonczonychPreinkubacji;
    }

    /**
     * Ustawia $liczbaDokonanychInwestycji
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
