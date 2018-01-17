<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * SprawozdanieSpolki
 *
 * @ORM\Table(name="sfz_sprawozdanie_spolki")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdanieSpolkiRepository")
 */
class SprawozdanieSpolki
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
     * @ORM\Column(name="sprawozdanie_id", type="integer", nullable=false)
     */
    private $sprawozdanieId;

    /**
     * @var int
     *
     * @ORM\Column(name="lp", type="integer")
     */
    private $liczbaPorzadkowa;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_spolki", type="string", length=140, nullable=false)
     */
    private $nazwaSpolki;

    /**
     * @var int
     * 
     * @Assert\Regex(pattern="'/^[0-9]{10}$/'", match = false, message="Niepoprawny nr KRS.")
     *
     * @ORM\Column(name="krs", type="string", length=15, nullable=true)
     */
    private $krs;

    /**
     * @var string
     *
     * @ORM\Column(name="uzyskane_przychody", type="decimal",precision=15,scale=2, nullable=false)
     */
    private $uzyskanePrzychody;

    /**
     * @var string
     *
     * @ORM\Column(name="planowane_przychody", type="decimal",precision=15, scale=2, nullable=false)
     */
    private $planowanePrzychody;

    /**
     * @var string
     *
     * @ORM\Column(name="ebitda", type="decimal",precision=15, scale=2, nullable=false)
     */
    private $ebitda;

    /**
     * @var string
     *
     * @ORM\Column(name="ncf", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $ncf;

    /**
     * @var string
     *
     * @ORM\Column(name="suma_bilansowa", type="decimal",precision=15, scale=2,  nullable=false)
     */
    private $sumaBilansowa;

    /**
     * @var integer
     *
     * @ORM\Column(name="zatrudnienie_etaty", type="integer", nullable=false)
     */
    private $zatrudnienieEtaty;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnione_kobiety", type="integer",  nullable=false)
     */
    private $zatrudnioneKobiety;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnieni_mezczyzni", type="integer", nullable=false)
     */
    private $zatrudnieniMezczyzni;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy", type="integer", nullable=false)
     */
    private $zatrudnienieInneFormy;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy_kobiety", type="integer", nullable=false)
     */
    private $zatrudnienieInneFormyKobiety;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy_mezczyzni", type="integer", nullable=false)
     */
    private $zatrudnienieInneFormyMezczyzni;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_w_stosunku_do_poprzedniego_roku", type="integer", nullable=false)
     */
    private $zatrudnieniewStosunkuDoPoprzedniegoRoku;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_w_stosunku_do_poprzedniego_okresu", type="integer", nullable=false)
     */
    private $zatrudnieniewStosunkuDoPoprzedniegoOkresu;

    /**
     * @ORM\ManyToOne(targetEntity="Sprawozdanie", inversedBy="sprawozdaniaSpolek", cascade = {"persist"})
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id")
     */
    private $sprawozdanie;

    /**
     * Set sprawozdanie
     *
     * @param  Sprawozdanie $sprawozdanie
     * @return SprawozdanieSpolki
     */
    public function setSprawozdanie($sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Get sprawozdanie
     *
     * @return Sprawozdanie 
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }

    /**
     * zwraca id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * zwraca sprawozdanieId
     *
     * @return int
     */
    public function getSprawozdanieId()
    {
        return $this->sprawozdanieId;
    }

    /**
     * zwraca lp
     *
     * @return int
     */
    public function getLiczbaPorzadkowa()
    {
        return $this->liczbaPorzadkowa;
    }

    /**
     * zwraca nazwaSpolki
     *
     * @return string
     */
    public function getNazwaSpolki()
    {
        return $this->nazwaSpolki;
    }

    /**
     * zwraca krs
     *
     * @return string
     */
    public function getKrs()
    {
        return $this->krs;
    }

    /**
     * zwraca uzyskanePrzychody
     *
     * @return decimal
     */
    public function getUzyskanePrzychody()
    {
        return $this->uzyskanePrzychody;
    }

    /**
     * zwraca planowanePrzychody
     *
     * @return decimal
     */
    public function getPlanowanePrzychody()
    {
        return $this->planowanePrzychody;
    }

    /**
     * zwraca ebitda
     *
     * @return decimal
     */
    public function getEbitda()
    {
        return $this->ebitda;
    }

    /**
     * zwraca ncf
     *
     * @return decimal
     */
    public function getNcf()
    {
        return $this->ncf;
    }

    /**
     * zwraca sumaBilansowa
     *
     * @return decimal
     */
    public function getSumaBilansowa()
    {
        return $this->sumaBilansowa;
    }

    /**
     * zwraca zatrudnienieEtaty
     *
     * @return int
     */
    public function getZatrudnienieEtaty()
    {
        return $this->zatrudnienieEtaty;
    }

    /**
     * zwraca zatrudnioneKobiety
     *
     * @return int
     */
    public function getZatrudnioneKobiety()
    {
        return $this->zatrudnioneKobiety;
    }

    /**
     * zwraca zatrudnieniMezczyzni
     *
     * @return int
     */
    public function getZatrudnieniMezczyzni()
    {
        return $this->zatrudnieniMezczyzni;
    }

    /**
     * zwraca zatrudnienieInneFormy
     *
     * @return int
     */
    public function getZatrudnienieInneFormy()
    {
        return $this->zatrudnienieInneFormy;
    }

    /**
     * zwraca zatrudnienieInneFormyKobiety
     *
     * @return int
     */
    public function getZatrudnienieInneFormyKobiety()
    {
        return $this->zatrudnienieInneFormyKobiety;
    }

    /**
     * zwraca zatrudnienieInneFormyMezczyzni
     *
     * @return int
     */
    public function getZatrudnienieInneFormyMezczyzni()
    {
        return $this->zatrudnienieInneFormyMezczyzni;
    }

    /**
     * zwraca zatrudnieniewStosunkuDoPoprzedniegoRoku
     *
     * @return int
     */
    public function getZatrudnieniewStosunkuDoPoprzedniegoRoku()
    {
        return $this->zatrudnieniewStosunkuDoPoprzedniegoRoku;
    }

    /**
     * zwraca zatrudnieniewStosunkuDoPoprzedniegoOkresu
     *
     * @return int
     */
    public function getZatrudnieniewStosunkuDoPoprzedniegoOkresu()
    {
        return $this->zatrudnieniewStosunkuDoPoprzedniegoOkresu;
    }

    /**
     * ustawia id
     * 
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * ustawia $liczbaPorzadkowa
     * 
     * @param int $liczbaPorzadkowa
     */
    public function setLiczbaPorzadkowa($liczbaPorzadkowa)
    {
        $this->liczbaPorzadkowa = $liczbaPorzadkowa;
    }

    /**
     * ustawia $nazwaSpolki
     * 
     * @param string $nazwaSpolki
     */
    public function setNazwaSpolki($nazwaSpolki)
    {
        $this->nazwaSpolki = $nazwaSpolki;
    }

    /**
     * ustawia $krs
     * 
     * @param string $krs
     */
    public function setKrs($krs)
    {
        $this->krs = $krs;
    }

    /**
     * ustawia $uzyskanePrzychody
     * 
     * @param decimal $uzyskanePrzychody
     */
    public function setUzyskanePrzychody($uzyskanePrzychody)
    {
        $this->uzyskanePrzychody = $uzyskanePrzychody;
    }

    /**
     * ustawia $planowanePrzychody
     * 
     * @param decimal $planowanePrzychody
     */
    public function setPlanowanePrzychody($planowanePrzychody)
    {
        $this->planowanePrzychody = $planowanePrzychody;
    }

    /**
     * ustawia $ebitda
     * 
     * @param decimal $ebitda
     */
    public function setEbitda($ebitda)
    {
        $this->ebitda = $ebitda;
    }

    /**
     * ustawia $ncf
     * 
     * @param decimal $ncf
     */
    public function setNcf($ncf)
    {
        $this->ncf = $ncf;
    }

    /**
     * ustawia $sumaBilansowa
     * 
     * @param decimal $sumaBilansowa
     */
    public function setSumaBilansowa($sumaBilansowa)
    {
        $this->sumaBilansowa = $sumaBilansowa;
    }

    /**
     * ustawia $zatrudnienieEtaty
     * 
     * @param int $zatrudnienieEtaty
     */
    public function setZatrudnienieEtaty($zatrudnienieEtaty)
    {
        $this->zatrudnienieEtaty = $zatrudnienieEtaty;
    }

    /**
     * ustawia $zatrudnioneKobiety
     * 
     * @param int $zatrudnioneKobiety
     */
    public function setZatrudnioneKobiety($zatrudnioneKobiety)
    {
        $this->zatrudnioneKobiety = $zatrudnioneKobiety;
    }

    /**
     * ustawia $zatrudnieniMezczyzni
     * 
     * @param int $zatrudnieniMezczyzni
     */
    public function setZatrudnieniMezczyzni($zatrudnieniMezczyzni)
    {
        $this->zatrudnieniMezczyzni = $zatrudnieniMezczyzni;
    }

    /**
     * ustawia $zatrudnienieInneFormy
     * 
     * @param int $zatrudnienieInneFormy
     */
    public function setZatrudnienieInneFormy($zatrudnienieInneFormy)
    {
        $this->zatrudnienieInneFormy = $zatrudnienieInneFormy;
    }

    /**
     * ustawia $zatrudnienieInneFormyKobiety
     * 
     * @param int $zatrudnienieInneFormyKobiety
     */
    public function setZatrudnienieInneFormyKobiety($zatrudnienieInneFormyKobiety)
    {
        $this->zatrudnienieInneFormyKobiety = $zatrudnienieInneFormyKobiety;
    }

    /**
     * ustawia $zatrudnienieInneFormyMezczyzni
     * 
     * @param int $zatrudnienieInneFormyMezczyzni
     */
    public function setZatrudnienieInneFormyMezczyzni($zatrudnienieInneFormyMezczyzni)
    {
        $this->zatrudnienieInneFormyMezczyzni = $zatrudnienieInneFormyMezczyzni;
    }

    /**
     * ustawia $zatrudnieniewStosunkuDoPoprzedniegoRoku
     * 
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoRoku
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoRoku($zatrudnieniewStosunkuDoPoprzedniegoRoku)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoRoku = $zatrudnieniewStosunkuDoPoprzedniegoRoku;
    }

    /**
     * ustawia $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     * 
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoOkresu($zatrudnieniewStosunkuDoPoprzedniegoOkresu)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoOkresu = $zatrudnieniewStosunkuDoPoprzedniegoOkresu;
    }

    /**
     * Konstruktor
     */
    public function __construct()
    {
        
    }
    
    /**
     * @Assert\Callback
     * 
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {    
        if ($this->getZatrudnienieEtaty() != ($this->getZatrudnieniMezczyzni() + $this->getZatrudnioneKobiety())) {
            $context->buildViolation('Suma pól "w tym kobiety" oraz "w tym mężczyźni" musi być równa wartości w polu "Zatrudnienie (etaty)" spółka ( '.$this->getNazwaSpolki().' )')
                ->atPath('rok')
                ->addViolation();
        }
        if ($this->getZatrudnienieInneFormy() != ($this->getZatrudnienieInneFormyMezczyzni() + $this->getZatrudnienieInneFormyKobiety())) {
            $context->buildViolation('Suma pól "w tym kobiety" oraz "w tym mężczyźni" musi być równa wartości w polu "Zatrudnienie (inne formy)" spółka ( '.$this->getNazwaSpolki().' )')
                ->atPath('rok')
                ->addViolation();
        }
    }
}
