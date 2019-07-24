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
     *
     * @return SprawozdanieSpolki
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Ustawia $liczbaPorzadkowa
     *
     * @param int $liczbaPorzadkowa
     *
     * @return SprawozdanieSpolki
     */
    public function setLiczbaPorzadkowa($liczbaPorzadkowa)
    {
        $this->liczbaPorzadkowa = $liczbaPorzadkowa;

        return $this;
    }

    /**
     * Ustawia $nazwaSpolki
     *
     * @param string $nazwaSpolki
     *
     * @return SprawozdanieSpolki
     */
    public function setNazwaSpolki($nazwaSpolki)
    {
        $this->nazwaSpolki = $nazwaSpolki;

        return $this;
    }

    /**
     * Ustawia $krs
     *
     * @param string $krs
     *
     * @return SprawozdanieSpolki
     */
    public function setKrs($krs)
    {
        $this->krs = $krs;

        return $this;
    }

    /**
     * Ustawia $uzyskanePrzychody
     *
     * @param float $uzyskanePrzychody
     *
     * @return SprawozdanieSpolki
     */
    public function setUzyskanePrzychody($uzyskanePrzychody)
    {
        $this->uzyskanePrzychody = $uzyskanePrzychody;

        return $this;
    }

    /**
     * Ustawia $planowanePrzychody
     *
     * @param float $planowanePrzychody
     *
     * @return SprawozdanieSpolki
     */
    public function setPlanowanePrzychody($planowanePrzychody)
    {
        $this->planowanePrzychody = $planowanePrzychody;

        return $this;
    }

    /**
     * Ustawia $ebitda
     *
     * @param float $ebitda
     *
     * @return SprawozdanieSpolki
     */
    public function setEbitda($ebitda)
    {
        $this->ebitda = $ebitda;

        return $this;
    }

    /**
     * Ustawia $ncf
     *
     * @param float $ncf
     *
     * @return SprawozdanieSpolki
     */
    public function setNcf($ncf)
    {
        $this->ncf = $ncf;

        return $this;
    }

    /**
     * Ustawia $sumaBilansowa
     *
     * @param float $sumaBilansowa
     *
     * @return SprawozdanieSpolki
     */
    public function setSumaBilansowa($sumaBilansowa)
    {
        $this->sumaBilansowa = $sumaBilansowa;

        return $this;
    }

    /**
     * Ustawia $zatrudnienieEtaty
     *
     * @param int $zatrudnienieEtaty
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnienieEtaty($zatrudnienieEtaty)
    {
        $this->zatrudnienieEtaty = $zatrudnienieEtaty;

        return $this;
    }

    /**
     * Ustawia $zatrudnioneKobiety
     *
     * @param int $zatrudnioneKobiety
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnioneKobiety($zatrudnioneKobiety)
    {
        $this->zatrudnioneKobiety = $zatrudnioneKobiety;

        return $this;
    }

    /**
     * Ustawia $zatrudnieniMezczyzni
     *
     * @param int $zatrudnieniMezczyzni
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnieniMezczyzni($zatrudnieniMezczyzni)
    {
        $this->zatrudnieniMezczyzni = $zatrudnieniMezczyzni;

        return $this;
    }

    /**
     * Ustawia $zatrudnienieInneFormy
     *
     * @param int $zatrudnienieInneFormy
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnienieInneFormy($zatrudnienieInneFormy)
    {
        $this->zatrudnienieInneFormy = $zatrudnienieInneFormy;

        return $this;
    }

    /**
     * Ustawia $zatrudnienieInneFormyKobiety
     *
     * @param int $zatrudnienieInneFormyKobiety
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnienieInneFormyKobiety($zatrudnienieInneFormyKobiety)
    {
        $this->zatrudnienieInneFormyKobiety = $zatrudnienieInneFormyKobiety;

        return $this;
    }

    /**
     * Ustawia $zatrudnienieInneFormyMezczyzni
     *
     * @param int $zatrudnienieInneFormyMezczyzni
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnienieInneFormyMezczyzni($zatrudnienieInneFormyMezczyzni)
    {
        $this->zatrudnienieInneFormyMezczyzni = $zatrudnienieInneFormyMezczyzni;

        return $this;
    }

    /**
     * Ustawia $zatrudnieniewStosunkuDoPoprzedniegoRoku
     *
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoRoku
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoRoku($zatrudnieniewStosunkuDoPoprzedniegoRoku)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoRoku = $zatrudnieniewStosunkuDoPoprzedniegoRoku;

        return $this;
    }

    /**
     * Ustawia $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     *
     * @param int $zatrudnieniewStosunkuDoPoprzedniegoOkresu
     *
     * @return SprawozdanieSpolki
     */
    public function setZatrudnieniewStosunkuDoPoprzedniegoOkresu($zatrudnieniewStosunkuDoPoprzedniegoOkresu)
    {
        $this->zatrudnieniewStosunkuDoPoprzedniegoOkresu = $zatrudnieniewStosunkuDoPoprzedniegoOkresu;

        return $this;
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
