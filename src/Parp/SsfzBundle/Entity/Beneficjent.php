<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Dane profilu beneficjenta
 *
 * @ORM\Table(name="sfz_beneficjent")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\BeneficjentRepository")
 */
class Beneficjent
{
    /**
     * Identyfikator beneficjenta
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Nazwa beneficjenta
     *
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=255, nullable=true)
     */
    private $nazwa;

    /**
     * Dane adresowe - województwo
     *
     * @var string
     *
     * @ORM\Column(name="adr_wojewodztwo", type="string", length=100, nullable=true)
     */
    private $adrWojewodztwo;

    /**
     * Dane adresowe - miejscowość
     *
     * @var string
     *
     * @ORM\Column(name="adr_miejscowosc", type="string", length=100, nullable=true)
     */
    private $adrMiejscowosc;

    /**
     * Dane adresowe - ulica
     *
     * @var string
     *
     * @ORM\Column(name="adr_ulica", type="string", length=100, nullable=true)
     */
    private $adrUlica;

    /**
     * Dane adresowe - nr budynku
     *
     * @var string
     *
     * @ORM\Column(name="adr_budynek", type="string", length=10, nullable=true)
     */
    private $adrBudynek;

    /**
     * Dane adresowe - nr lokalu
     *
     * @var string
     *
     * @ORM\Column(name="adr_lokal", type="string", length=10, nullable=true)
     */
    private $adrLokal;

    /**
     * Dane adresowe - kod pocztowy
     *
     * @var string
     *
     * @ORM\Column(name="adr_kod", type="string", length=6, nullable=true)
     */
    private $adrKod;

    /**
     * Dane adresowe - poczta
     *
     * @var string
     *
     * @ORM\Column(name="adr_poczta", type="string", length=50, nullable=true)
     */
    private $adrPoczta;

    /**
     * Dane kobtakotowe - telefon stacjonarny
     *
     * @var string
     *
     * @ORM\Column(name="tel_stacjonarny", type="string", length=15, nullable=true)
     */
    private $telStacjonarny;

    /**
     * Dane kontaktowe - telefon komórkowy
     *
     * @var string
     *
     * @ORM\Column(name="tel_komorkowy", type="string", length=15, nullable=true)
     */
    private $telKomorkowy;

    /**
     * Dane kontaktowe - adres e-mail
     *
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=true)
     */
    private $email;

    /**
     * Dane kontaktowe - fax
     *
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=15, nullable=true)
     */
    private $fax;

    /**
     * Określa, czy profil jest kompletny (czy wszystkie wymagane pola są wypełnione)
     *
     * @var bool
     *
     * @ORM\Column(name="wypelniony", type="boolean", nullable=true)
     */
    private $wypelniony;

    /**
     * Encje OsobaZatrudniona powiązane z beneficjentem - osoby zatrudnione
     *
     * @ORM\OneToMany(targetEntity="OsobaZatrudniona", mappedBy="beneficjent", cascade={"persist", "remove"})
     */
    private $osobyZatrudnione;

    /**
     * Encje Umowa powiazane z beneficjentem - umowy
     *
     * @ORM\OneToMany(targetEntity="Umowa", mappedBy="beneficjent", cascade={"persist", "remove"})
     */
    private $umowy;

    /**
     * Encje Uzytkownik powiązane z beneficjentem - użytkownicy powiązaniu z profilem beneficjenta
     *
     * @ORM\OneToMany(targetEntity="Uzytkownik", mappedBy="beneficjent")
     */
    private $uzytkownicy;

    /**
     * Publiczny konstruktor
     */
    public function __construct()
    {
        $this->osobyZatrudnione = new ArrayCollection();
        $this->umowy = new ArrayCollection();
        $this->uzytkownicy = new ArrayCollection();
    }

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
     * Set nazwa
     *
     * @param  string $nazwa
     * @return Beneficjent
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
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
     * Set adrWojewodztwo
     *
     * @param  string $adrWojewodztwo
     * @return Beneficjent
     */
    public function setAdrWojewodztwo($adrWojewodztwo)
    {
        $this->adrWojewodztwo = $adrWojewodztwo;

        return $this;
    }

    /**
     * Get adrWojewodztwo
     *
     * @return string
     */
    public function getAdrWojewodztwo()
    {
        return $this->adrWojewodztwo;
    }

    /**
     * Set adrMiejscowosc
     *
     * @param  string $adrMiejscowosc
     *
     * @return Beneficjent
     */
    public function setAdrMiejscowosc($adrMiejscowosc)
    {
        $this->adrMiejscowosc = $adrMiejscowosc;

        return $this;
    }

    /**
     * Get adrMiejscowosc
     *
     * @return string
     */
    public function getAdrMiejscowosc()
    {
        return $this->adrMiejscowosc;
    }

    /**
     * Set adrUlica
     *
     * @param  string $adrUlica
     *
     * @return Beneficjent
     */
    public function setAdrUlica($adrUlica)
    {
        $this->adrUlica = $adrUlica;

        return $this;
    }

    /**
     * Get adrUlica
     *
     * @return string
     */
    public function getAdrUlica()
    {
        return $this->adrUlica;
    }

    /**
     * Set adrBudynek
     *
     * @param  string $adrBudynek
     *
     * @return Beneficjent
     */
    public function setAdrBudynek($adrBudynek)
    {
        $this->adrBudynek = $adrBudynek;

        return $this;
    }

    /**
     * Get adrBudynek
     *
     * @return string
     */
    public function getAdrBudynek()
    {
        return $this->adrBudynek;
    }

    /**
     * Set adrLokal
     *
     * @param  string $adrLokal
     * @return Beneficjent
     */
    public function setAdrLokal($adrLokal)
    {
        $this->adrLokal = $adrLokal;

        return $this;
    }

    /**
     * Get adrLokal
     *
     * @return string
     */
    public function getAdrLokal()
    {
        return $this->adrLokal;
    }

    /**
     * Set adrKod
     *
     * @param  string $adrKod
     *
     * @return Beneficjent
     */
    public function setAdrKod($adrKod)
    {
        $this->adrKod = $adrKod;

        return $this;
    }

    /**
     * Get adrKod
     *
     * @return string
     */
    public function getAdrKod()
    {
        return $this->adrKod;
    }

    /**
     * Set adrPoczta
     *
     * @param  string $adrPoczta
     *
     * @return Beneficjent
     */
    public function setAdrPoczta($adrPoczta)
    {
        $this->adrPoczta = $adrPoczta;

        return $this;
    }

    /**
     * Get adrPoczta
     *
     * @return string
     */
    public function getAdrPoczta()
    {
        return $this->adrPoczta;
    }

    /**
     * Set telStacjonarny
     *
     * @param  string $telStacjonarny
     * @return Beneficjent
     */
    public function setTelStacjonarny($telStacjonarny)
    {
        $this->telStacjonarny = $telStacjonarny;

        return $this;
    }

    /**
     * Get telStacjonarny
     *
     * @return string
     */
    public function getTelStacjonarny()
    {
        return $this->telStacjonarny;
    }

    /**
     * Set telKomorkowy
     *
     * @param  string $telKomorkowy
     * @return Beneficjent
     */
    public function setTelKomorkowy($telKomorkowy)
    {
        $this->telKomorkowy = $telKomorkowy;

        return $this;
    }

    /**
     * Get telKomorkowy
     *
     * @return string
     */
    public function getTelKomorkowy()
    {
        return $this->telKomorkowy;
    }

    /**
     * Set email
     *
     * @param  string $email
     *
     * @return Beneficjent
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set fax
     *
     * @param  string $fax
     *
     * @return Beneficjent
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set wypelniony
     *
     * @param  boolean $wypelniony
     *
     * @return Beneficjent
     */
    public function setWypelniony($wypelniony)
    {
        $this->wypelniony = $wypelniony;

        return $this;
    }

    /**
     * Get wypelniony
     *
     * @return boolean
     */
    public function getWypelniony()
    {
        return $this->wypelniony;
    }

    /**
     * Set umowy
     *
     * @param  Umowa $umowy
     *
     * @return Beneficjent
     */
    public function setUmowy($umowy)
    {
        $this->umowy = $umowy;

        return $this;
    }

    /**
     * Get umowy
     *
     * @return Collection
     */
    public function getUmowy()
    {
        return $this->umowy;
    }

    /**
     * set osobyZatrudnione
     *
     * @param  Collection $osobyZatrudnione
     * @return Beneficjent
     */
    public function setOsobyZatrudnione($osobyZatrudnione)
    {
        $this->osobyZatrudnione = $osobyZatrudnione;

        return $this;
    }

    /**
     * Get osobyZatrudnione
     *
     * @return Collection
     */
    public function getOsobyZatrudnione()
    {
        return $this->osobyZatrudnione;
    }

    /**
     * Get uzytkownicy
     *
     * @return Collection
     */
    public function getUzytkownicy()
    {
        return $this->uzytkownicy;
    }

    /**
     * Funkcja dodająca umowę do porfilu beneficjenta
     *
     * @param \Parp\SsfzBundle\Entity\Umowa $umowa
     */
    public function addUmowa(Umowa $umowa)
    {
        $umowa->setBeneficjent($this);
        $this->umowy->add($umowa);
    }

     /**
     * Funkcja dodająca osobę zatrudnioną do profilu beneficjenta
     *
     * @param OsobaZatrudniona $osoba
     */
    public function addOsobaZatrudniona(OsobaZatrudniona $osoba)
    {
        $osoba->setBeneficjent($this);
        $this->osobyZatrudnione->add($osoba);
    }

    /**
     * Funkcja usuwająca umowę z profilu beneficjenta
     *
     * @param \Parp\SsfzBundle\Entity\Umowa $umowa
     */
    public function removeUmowa(Umowa $umowa)
    {
        $this->umowy->removeElement($umowa);
    }
}
