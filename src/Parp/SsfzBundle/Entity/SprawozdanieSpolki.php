<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
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
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="lp", type="integer")
     */
    protected $liczbaPorzadkowa;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_spolki", type="string", length=140, nullable=false)
     */
    protected $nazwaSpolki;

    /**
     * @var int
     *
     * @Assert\Regex(pattern="'/^[0-9]{10}$/'", match = false, message="Niepoprawny nr KRS.")
     *
     * @ORM\Column(name="krs", type="string", length=15, nullable=true)
     */
    protected $krs;

    /**
     * @var string
     *
     * @ORM\Column(name="uzyskane_przychody", type="decimal",precision=15,scale=2, nullable=false)
     */
    protected $uzyskanePrzychody;

    /**
     * @var string
     *
     * @ORM\Column(name="planowane_przychody", type="decimal",precision=15, scale=2, nullable=false)
     */
    protected $planowanePrzychody;

    /**
     * @var string
     *
     * @ORM\Column(name="ebitda", type="decimal",precision=15, scale=2, nullable=false)
     */
    protected $ebitda;

    /**
     * @var string
     *
     * @ORM\Column(name="ncf", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $ncf;

    /**
     * @var string
     *
     * @ORM\Column(name="suma_bilansowa", type="decimal",precision=15, scale=2,  nullable=false)
     */
    protected $sumaBilansowa;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_etaty", type="integer", nullable=false)
     */
    protected $zatrudnienieEtaty;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnione_kobiety", type="integer",  nullable=false)
     */
    protected $zatrudnioneKobiety;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnieni_mezczyzni", type="integer", nullable=false)
     */
    protected $zatrudnieniMezczyzni;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy", type="integer", nullable=false)
     */
    protected $zatrudnienieInneFormy;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy_kobiety", type="integer", nullable=false)
     */
    protected $zatrudnienieInneFormyKobiety;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_inne_formy_mezczyzni", type="integer", nullable=false)
     */
    protected $zatrudnienieInneFormyMezczyzni;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_w_stosunku_do_poprzedniego_roku", type="integer", nullable=false)
     */
    protected $zatrudnieniewStosunkuDoPoprzedniegoRoku;

    /**
     * @var int
     *
     * @ORM\Column(name="zatrudnienie_w_stosunku_do_poprzedniego_okresu", type="integer", nullable=false)
     */
    protected $zatrudnieniewStosunkuDoPoprzedniegoOkresu;

    /**
     * @ORM\ManyToOne(
     *    targetEntity="Parp\SsfzBundle\Entity\SprawozdanieZalazkowe",
     *    inversedBy="sprawozdaniaSpolek",
     *    cascade={"persist"}
     * )
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id")
     */
    protected $sprawozdanie;

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
     * Zwraca ID sprawozdania.
     *
     * @return int|null
     */
    public function getSprawozdanieId()
    {
        if (null !== $this->sprawozdanie) {
            return $this->sprawozdanie->getId();
        }

        return null;
    }

    /**
     * Set sprawozdanie
     *
     * @param Sprawozdanie $sprawozdanie
     *
     * @return SprawozdanieSpolki
     */
    public function setSprawozdanie($sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Zwraca id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Zwraca lp
     *
     * @return int
     */
    public function getLiczbaPorzadkowa()
    {
        return $this->liczbaPorzadkowa;
    }

    /**
     * Zwraca nazwaSpolki
     *
     * @return string
     */
    public function getNazwaSpolki()
    {
        return $this->nazwaSpolki;
    }

    /**
     * Zwraca krs
     *
     * @return string
     */
    public function getKrs()
    {
        return $this->krs;
    }

    /**
     * Zwraca uzyskanePrzychody
     *
     * @return float
     */
    public function getUzyskanePrzychody()
    {
        return $this->uzyskanePrzychody;
    }

    /**
     * Zwraca planowanePrzychody
     *
     * @return float
     */
    public function getPlanowanePrzychody()
    {
        return $this->planowanePrzychody;
    }

    /**
     * Zwraca ebitda
     *
     * @return float
     */
    public function getEbitda()
    {
        return $this->ebitda;
    }

    /**
     * Zwraca ncf
     *
     * @return float
     */
    public function getNcf()
    {
        return $this->ncf;
    }

    /**
     * Zwraca sumaBilansowa
     *
     * @return float
     */
    public function getSumaBilansowa()
    {
        return $this->sumaBilansowa;
    }

    /**
     * Zwraca zatrudnienieEtaty
     *
     * @return int
     */
    public function getZatrudnienieEtaty()
    {
        return $this->zatrudnienieEtaty;
    }

    /**
     * Zwraca zatrudnioneKobiety
     *
     * @return int
     */
    public function getZatrudnioneKobiety()
    {
        return $this->zatrudnioneKobiety;
    }

    /**
     * Zwraca zatrudnieniMezczyzni
     *
     * @return int
     */
    public function getZatrudnieniMezczyzni()
    {
        return $this->zatrudnieniMezczyzni;
    }

    /**
     * Zwraca zatrudnienieInneFormy
     *
     * @return int
     */
    public function getZatrudnienieInneFormy()
    {
        return $this->zatrudnienieInneFormy;
    }

    /**
     * Zwraca zatrudnienieInneFormyKobiety
     *
     * @return int
     */
    public function getZatrudnienieInneFormyKobiety()
    {
        return $this->zatrudnienieInneFormyKobiety;
    }

    /**
     * Zwraca zatrudnienieInneFormyMezczyzni
     *
     * @return int
     */
    public function getZatrudnienieInneFormyMezczyzni()
    {
        return $this->zatrudnienieInneFormyMezczyzni;
    }

    /**
     * Zwraca zatrudnieniewStosunkuDoPoprzedniegoRoku
     *
     * @return int
     */
    public function getZatrudnieniewStosunkuDoPoprzedniegoRoku()
    {
        return $this->zatrudnieniewStosunkuDoPoprzedniegoRoku;
    }

    /**
     * Zwraca zatrudnieniewStosunkuDoPoprzedniegoOkresu
     *
     * @return int
     */
    public function getZatrudnieniewStosunkuDoPoprzedniegoOkresu()
    {
        return $this->zatrudnieniewStosunkuDoPoprzedniegoOkresu;
    }

    /**
     * Ustawia id
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }






    /**
     * Ustawia $liczbaPorzadkowa
     *
     * @param int $liczbaPorzadkowa
     */
    public function setLiczbaPorzadkowa($liczbaPorzadkowa)
    {
        $this->liczbaPorzadkowa = $liczbaPorzadkowa;
    }

    /**
     * Ustawia $nazwaSpolki
     *
     * @param string $nazwaSpolki
     */
    public function setNazwaSpolki($nazwaSpolki)
    {
        $this->nazwaSpolki = $nazwaSpolki;
    }

    /**
     * Ustawia $krs
     *
     * @param string $krs
     */
    public function setKrs($krs)
    {
        $this->krs = $krs;
    }

    /**
     * Ustawia $uzyskanePrzychody
     *
     * @param float $uzyskanePrzychody
     */
    public function setUzyskanePrzychody($uzyskanePrzychody)
    {
        $this->uzyskanePrzychody = $uzyskanePrzychody;
    }

    /**
     * Ustawia $planowanePrzychody
     *
     * @param float $planowanePrzychody
     */
    public function setPlanowanePrzychody($planowanePrzychody)
    {
        $this->planowanePrzychody = $planowanePrzychody;
    }

    /**
     * Ustawia $ebitda
     *
     * @param float $ebitda
     */
    public function setEbitda($ebitda)
    {
        $this->ebitda = $ebitda;
    }

    /**
     * Ustawia $ncf
     *
     * @param float $ncf
     */
    public function setNcf($ncf)
    {
        $this->ncf = $ncf;
    }

    /**
     * Ustawia $sumaBilansowa
     *
     * @param float $sumaBilansowa
     */
    public function setSumaBilansowa($sumaBilansowa)
    {
        $this->sumaBilansowa = $sumaBilansowa;
    }

    /**
     * Ustawia $zatrudnienieEtaty
     *
     * @param int $zatrudnienieEtaty
     */
    public function setZatrudnienieEtaty($zatrudnienieEtaty)
    {
        $this->zatrudnienieEtaty = $zatrudnienieEtaty;
    }

    /**
     * Ustawia $zatrudnioneKobiety
     *
     * @param int $zatrudnioneKobiety
     */
    public function setZatrudnioneKobiety($zatrudnioneKobiety)
    {
        $this->zatrudnioneKobiety = $zatrudnioneKobiety;
    }

    /**
     * Ustawia $zatrudnieniMezczyzni
     *
     * @param int $zatrudnieniMezczyzni
     */
    public function setZatrudnieniMezczyzni($zatrudnieniMezczyzni)
    {
        $this->zatrudnieniMezczyzni = $zatrudnieniMezczyzni;
    }

    /**
     * Ustawia $zatrudnienieInneFormy
     *
     * @param int $zatrudnienieInneFormy
     */
    public function setZatrudnienieInneFormy($zatrudnienieInneFormy)
    {
        $this->zatrudnienieInneFormy = $zatrudnienieInneFormy;
    }

    /**
     * Ustawia $zatrudnienieInneFormyKobiety
     *
     * @param int $zatrudnienieInneFormyKobiety
     */
    public function setZatrudnienieInneFormyKobiety($zatrudnienieInneFormyKobiety)
    {
        $this->zatrudnienieInneFormyKobiety = $zatrudnienieInneFormyKobiety;
    }

    /**
     * Ustawia $zatrudnienieInneFormyMezczyzni
     *
     * @param int $zatrudnienieInneFormyMezczyzni
     */
    public function setZatrudnienieInneFormyMezczyzni($zatrudnienieInneFormyMezczyzni)
    {
        $this->zatrudnienieInneFormyMezczyzni = $zatrudnienieInneFormyMezczyzni;
    }

    /**
     * Ustawia $zatrudnieniewStosunkuDoPoprzedniegoRoku
     *
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoRoku
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoRoku($zatrudnieniewStosunkuDoPoprzedniegoRoku)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoRoku = $zatrudnieniewStosunkuDoPoprzedniegoRoku;
    }

    /**
     * Ustawia $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     *
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoOkresu($zatrudnieniewStosunkuDoPoprzedniegoOkresu)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoOkresu = $zatrudnieniewStosunkuDoPoprzedniegoOkresu;
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
