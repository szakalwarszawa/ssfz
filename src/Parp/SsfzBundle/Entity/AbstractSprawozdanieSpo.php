<?php

namespace Parp\SsfzBundle\Entity;

use Date;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Parp\SsfzBundle\Entity\Slowniki\FormaPrawna;
use Parp\SsfzBundle\Entity\Slowniki\TakNie;

/**
 * AbstractSprawozdanieSpo
 */
class AbstractSprawozdanieSpo extends AbstractSprawozdanie
{
    /**
     * Nazwa funduszu.
     *
     * @var string
     *
     * @ORM\Column(name="nazwa_funduszu", type="string", nullable=true)
     */
    protected $nazwaFunduszu;

    /**
     * NIP.
     *
     * @var string
     *
     * @ORM\Column(name="nip", type="string", length=10, nullable=true)
     */
    protected $nip;

    /**
     * Numer KRS.
     *
     * @var string
     *
     * @ORM\Column(name="krs", type="string", length=10, nullable=true)
     */
    protected $krs;
    
    /**
     * Województwo ze słownika.
     *
     * @var Wojewodztwo
     *
     * @ORM\ManyToOne(targetEntity="Wojewodztwo")
     * @ORM\JoinColumn(name="wojewodztwo_id", referencedColumnName="id", nullable=true)
     */
    protected $wojewodztwo;

    /**
     * Dane podmiotu - miejscowość.
     *
     * @var string
     *
     * @ORM\Column(name="miejscowosc", type="string", length=100, nullable=true)
     */
    protected $miejscowosc;

    /**
     * Dane podmiotu - ulica.
     *
     * @var string
     *
     * @ORM\Column(name="ulica", type="string", length=100, nullable=true)
     */
    protected $ulica;

    /**
     * Dane podmiotu - nr budynku.
     *
     * @var string
     *
     * @ORM\Column(name="budynek", type="string", length=10, nullable=true)
     */
    protected $budynek;

    /**
     * Dane podmiotu - nr lokalu.
     *
     * @var string
     *
     * @ORM\Column(name="lokal", type="string", length=10, nullable=true)
     */
    protected $lokal;

    /**
     * Dane podmiotu - kod pocztowy.
     *
     * @var string
     *
     * @ORM\Column(name="kod_pocztowy", type="string", length=6, nullable=true)
     */
    protected $kodPocztowy;

    /**
     * Dane podmiotu - poczta.
     *
     * @var string
     *
     * @ORM\Column(name="poczta", type="string", length=50, nullable=true)
     */
    protected $poczta;

    /**
     * Dane kobtakotowe - telefon stacjonarny.
     *
     * @var string
     *
     * @ORM\Column(name="tel_stacjonarny", type="string", length=15, nullable=true)
     */
    protected $telStacjonarny;

    /**
     * Dane kontaktowe - telefon komórkowy.
     *
     * @var string
     *
     * @ORM\Column(name="tel_komorkowy", type="string", length=15, nullable=true)
     */
    protected $telKomorkowy;

    /**
     * Dane kontaktowe - adres e-mail.
     *
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=true)
     */
    protected $email;

    /**
     * Dane kontaktowe - fax.
     *
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=15, nullable=true)
     */
    protected $fax;

    /**
     * Rok założenia.
     *
     * @var string
     *
     * @ORM\Column(name="rok_zalozenia", type="string", length=4, nullable=true)
     */
    protected $rokZalozenia;
    
    /**
     * Forma prawna.
     *
     * @var FormaPrawna
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\FormaPrawna")
     * @ORM\JoinColumn(name="forma_prawna_id", referencedColumnName="id", nullable=true)
     */
    protected $formaPrawna;

    /**
     * Kapitał Pożyczkowy Funduszu Pożyczkowego.
     *
     * @var string
     *
     * @ORM\Column(name="kapital_ogolem", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kapitalOgolem;

    /**
     * w tym kapitał wydzielonego Funduszu Pożyczkowego prowadzonego zgodnie z zasadami gospodarowania monitorowanymi przez PARP.
     *
     * @var string
     *
     * @ORM\Column(name="kapital_wydzielony", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kapitalWydzielony;

    /**
     * Fundusz nie działa dla zysku.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\TakNie")
     * @ORM\JoinColumn(name="czy_nie_dziala_dla_zysku", referencedColumnName="id", nullable=true)
     */
    protected $czyNieDzialaDlaZysku;

    /**
     * Fundusz udziela pożyczek po analizie ryzyka niespłacenia i po ustanowieniu zabezpieczenia.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\TakNie")
     * @ORM\JoinColumn(name="czy_udziela_po_analizie_ryzyka", referencedColumnName="id", nullable=true)
     */
    protected $czyUdzielaPoAnalizieRyzyka;

    /**
     * Data zatwierdzenia zasad gospodarowania funduszem pożyczkowym przez PARP.
     *
     * @var Date
     *
     * @ORM\Column(name="data_zatwierdzenia_zasad_gosp", type="date", nullable=true)
     */
    protected $dataZatwierdzeniaZasadGospodarowania;

    /**
     * Pożyczki udzielane są przedsiębiorcom nie będącym w trudniej sytuacji.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\TakNie")
     * @ORM\JoinColumn(name="czy_nie_w_trudnej_sytuacji", referencedColumnName="id", nullable=true)
     */
    protected $czyNieWTrudnejSytuacji;

    /**
     * Fundusz posiada odpowiedni potencjał ekonomiczny.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\TakNie")
     * @ORM\JoinColumn(name="czy_odpowiedni_potencjal_ekonomiczny", referencedColumnName="id", nullable=true)
     */
    protected $czyOdpowiedniPotencjalEkonomiczny;

    /**
     * Fundusz zatrudnia pracowników posiadających odpowiednie kwalifikacje.
     *
     * @var TakNie
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slowniki\TakNie")
     * @ORM\JoinColumn(name="czy_pracownicy_posiadaja_kwalifikacje", referencedColumnName="id", nullable=true)
     */
    protected $czyPracownicyPosiadajaKwalifikacje;

    /**
     * Inne (nazwa definiowana przez fundusz)
     *
     * @var string
     *
     * @ORM\Column(name="inne", type="string", nullable=true)
     */
    protected $inne;

    /**
     * Czy dane są prawidłowe i wypełniono wszystkie wymagane pola.
     *
     * @var bool
     *
     * @ORM\Column(
     *      name="czy_dane_sa_prawidlowe",
     *      type="boolean",
     *      nullable=false,
     *      options={"default": false}
     * )
     */
    protected $czyDaneSaPrawidlowe = false;

    /**
     * Set nazwaFunduszu
     *
     * @param string $nazwaFunduszu
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setNazwaFunduszu($nazwaFunduszu)
    {
        $this->nazwaFunduszu = $nazwaFunduszu;

        return $this;
    }

    /**
     * Get nazwaFunduszu
     *
     * @return string
     */
    public function getNazwaFunduszu()
    {
        return $this->nazwaFunduszu;
    }

    /**
     * Set nip
     *
     * @param string $nip
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return string
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set krs
     *
     * @param string $krs
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setKrs($krs)
    {
        $this->krs = $krs;

        return $this;
    }

    /**
     * Get krs
     *
     * @return string
     */
    public function getKrs()
    {
        return $this->krs;
    }

    /**
     * Set miejscowosc
     *
     * @param string $miejscowosc
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setMiejscowosc($miejscowosc)
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    /**
     * Get miejscowosc
     *
     * @return string
     */
    public function getMiejscowosc()
    {
        return $this->miejscowosc;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set budynek
     *
     * @param string $budynek
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setBudynek($budynek)
    {
        $this->budynek = $budynek;

        return $this;
    }

    /**
     * Get budynek
     *
     * @return string
     */
    public function getBudynek()
    {
        return $this->budynek;
    }

    /**
     * Set lokal
     *
     * @param string $lokal
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setLokal($lokal)
    {
        $this->lokal = $lokal;

        return $this;
    }

    /**
     * Get lokal
     *
     * @return string
     */
    public function getLokal()
    {
        return $this->lokal;
    }

    /**
     * Set kodPocztowy
     *
     * @param string $kodPocztowy
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setKodPocztowy($kodPocztowy)
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    /**
     * Get kodPocztowy
     *
     * @return string
     */
    public function getKodPocztowy()
    {
        return $this->kodPocztowy;
    }

    /**
     * Set poczta
     *
     * @param string $poczta
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setPoczta($poczta)
    {
        $this->poczta = $poczta;

        return $this;
    }

    /**
     * Get poczta
     *
     * @return string
     */
    public function getPoczta()
    {
        return $this->poczta;
    }

    /**
     * Set telStacjonarny
     *
     * @param string $telStacjonarny
     *
     * @return AbstractSprawozdanieSpo
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
     * @param string $telKomorkowy
     *
     * @return AbstractSprawozdanieSpo
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
     * @param string $email
     *
     * @return AbstractSprawozdanieSpo
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
     * @param string $fax
     *
     * @return AbstractSprawozdanieSpo
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
     * Set rokZalozenia
     *
     * @param string $rokZalozenia
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setRokZalozenia($rokZalozenia)
    {
        $this->rokZalozenia = $rokZalozenia;

        return $this;
    }

    /**
     * Get rokZalozenia
     *
     * @return string
     */
    public function getRokZalozenia()
    {
        return $this->rokZalozenia;
    }

    /**
     * Set kapitalOgolem
     *
     * @param string $kapitalOgolem
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setKapitalOgolem($kapitalOgolem)
    {
        $this->kapitalOgolem = $kapitalOgolem;

        return $this;
    }

    /**
     * Get kapitalOgolem
     *
     * @return string
     */
    public function getKapitalOgolem()
    {
        return $this->kapitalOgolem;
    }

    /**
     * Set kapitalWydzielony
     *
     * @param string $kapitalWydzielony
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setKapitalWydzielony($kapitalWydzielony)
    {
        $this->kapitalWydzielony = $kapitalWydzielony;

        return $this;
    }

    /**
     * Get kapitalWydzielony
     *
     * @return string
     */
    public function getKapitalWydzielony()
    {
        return $this->kapitalWydzielony;
    }

    /**
     * Set powiadomienieWyslane
     *
     * @param TakNie $powiadomienieWyslane
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setPowiadomienieWyslane($powiadomienieWyslane)
    {
        $this->powiadomienieWyslane = $powiadomienieWyslane;

        return $this;
    }

    /**
     * Set wojewodztwo
     *
     * @param Wojewodztwo|null $wojewodztwo
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setWojewodztwo(Wojewodztwo $wojewodztwo = null)
    {
        $this->wojewodztwo = $wojewodztwo;

        return $this;
    }

    /**
     * Get wojewodztwo
     *
     * @return Wojewodztwo
     */
    public function getWojewodztwo()
    {
        return $this->wojewodztwo;
    }

    /**
     * Set formaPrawna
     *
     * @param FormaPrawna|null $formaPrawna
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setFormaPrawna(FormaPrawna $formaPrawna = null)
    {
        $this->formaPrawna = $formaPrawna;

        return $this;
    }

    /**
     * Get formaPrawna
     *
     * @return FormaPrawna
     */
    public function getFormaPrawna()
    {
        return $this->formaPrawna;
    }

    /**
     * Set czyNieDzialaDlaZysku
     *
     * @param TakNie $czyNieDzialaDlaZysku
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setCzyNieDzialaDlaZysku(TakNie $czyNieDzialaDlaZysku)
    {
        $this->czyNieDzialaDlaZysku = $czyNieDzialaDlaZysku;

        return $this;
    }

    /**
     * Get czyNieDzialaDlaZysku
     *
     * @return TakNie
     */
    public function getCzyNieDzialaDlaZysku()
    {
        return $this->czyNieDzialaDlaZysku;
    }

    /**
     * Set czyUdzielaPoAnalizieRyzyka
     *
     * @param TakNie $czyUdzielaPoAnalizieRyzyka
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setCzyUdzielaPoAnalizieRyzyka(TakNie $czyUdzielaPoAnalizieRyzyka)
    {
        $this->czyUdzielaPoAnalizieRyzyka = $czyUdzielaPoAnalizieRyzyka;

        return $this;
    }

    /**
     * Get czyUdzielaPoAnalizieRyzyka
     *
     * @return TakNie
     */
    public function getCzyUdzielaPoAnalizieRyzyka()
    {
        return $this->czyUdzielaPoAnalizieRyzyka;
    }

    /**
     * Set dataZatwierdzeniaZasadGospodarowania
     * Powinno przyjmować Date, ale formularz się wysypywał przy zapisie.
     *
     * @param DateTime|null $dataZatwierdzeniaZasadGospodarowania
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setDataZatwierdzeniaZasadGospodarowania(DateTime $dataZatwierdzeniaZasadGospodarowania = null)
    {
        $this->dataZatwierdzeniaZasadGospodarowania = $dataZatwierdzeniaZasadGospodarowania;

        return $this;
    }

    /**
     * Get dataZatwierdzeniaZasadGospodarowania
     *
     * @return Date
     */
    public function getDataZatwierdzeniaZasadGospodarowania()
    {
        return $this->dataZatwierdzeniaZasadGospodarowania;
    }

    /**
     * Set czyNieWTrudnejSytuacji
     *
     * @param TakNie $czyNieWTrudnejSytuacji
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setCzyNieWTrudnejSytuacji(TakNie $czyNieWTrudnejSytuacji)
    {
        $this->czyNieWTrudnejSytuacji = $czyNieWTrudnejSytuacji;

        return $this;
    }

    /**
     * Get czyNieWTrudnejSytuacji
     *
     * @return TakNie
     */
    public function getCzyNieWTrudnejSytuacji()
    {
        return $this->czyNieWTrudnejSytuacji;
    }

    /**
     * Set czyOdpowiedniPotencjalEkonomiczny
     *
     * @param TakNie $czyOdpowiedniPotencjalEkonomiczny
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setCzyOdpowiedniPotencjalEkonomiczny(TakNie $czyOdpowiedniPotencjalEkonomiczny)
    {
        $this->czyOdpowiedniPotencjalEkonomiczny = $czyOdpowiedniPotencjalEkonomiczny;

        return $this;
    }

    /**
     * Get czyOdpowiedniPotencjalEkonomiczny
     *
     * @return TakNie
     */
    public function getCzyOdpowiedniPotencjalEkonomiczny()
    {
        return $this->czyOdpowiedniPotencjalEkonomiczny;
    }

    /**
     * Set czyPracownicyPosiadajaKwalifikacje
     *
     * @param TakNie $czyPracownicyPosiadajaKwalifikacje
     *
     * @return SprawozdaniePozyczkowe
     */
    public function setCzyPracownicyPosiadajaKwalifikacje(TakNie $czyPracownicyPosiadajaKwalifikacje)
    {
        $this->czyPracownicyPosiadajaKwalifikacje = $czyPracownicyPosiadajaKwalifikacje;

        return $this;
    }

    /**
     * Get czyPracownicyPosiadajaKwalifikacje
     *
     * @return TakNie
     */
    public function getCzyPracownicyPosiadajaKwalifikacje()
    {
        return $this->czyPracownicyPosiadajaKwalifikacje;
    }

    /**
     * Set inne
     *
     * @param string $inne
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setInne($inne)
    {
        $this->inne = $inne;

        return $this;
    }

    /**
     * Get inne
     *
     * @return string
     */
    public function getInne()
    {
        return $this->inne;
    }

    /**
     * Wiąże sprawozdanie z nowymi składnikami.
     *
     * @return AbstractSprawozdanieSpo
     */
    public function powiazSkladnikiZeSprawozdaniem()
    {
        foreach ($this->skladnikiOgolem as $skladnik) {
            if (null === $skladnik->getSprawozdanie()) {
                $skladnik->setSprawozdanie($this);
            }
        }

        foreach ($this->skladnikiWydzielone as $skladnik) {
            if (null === $skladnik->getSprawozdanie()) {
                $skladnik->setSprawozdanie($this);
            }
        }
        
        return $this;
    }

    /**
     * Oblicza sumę składników.
     *
     * @return AbstractSprawozdanieSpo
     */
    public function obliczKapital()
    {
        $this->kapitalOgolem = 0;
        foreach ($this->skladnikiOgolem as $skladnik) {
            $kwota = $skladnik->getWartosc();
            if (!empty($kwota)) {
                $this->kapitalOgolem = bcadd($this->kapitalOgolem, $kwota, 2);
            }
        }

        $this->kapitalWydzielony = 0;
        foreach ($this->skladnikiWydzielone as $skladnik) {
            $kwota = $skladnik->getWartosc();
            if (!empty($kwota)) {
                $this->kapitalWydzielony = bcadd($this->kapitalWydzielony, $kwota, 2);
            }
        }
        
        return $this;
    }

    /**
     * Set czyDaneSaPrawidlowe
     *
     * @param bool $czyDaneSaPrawidlowe
     *
     * @return AbstractSprawozdanieSpo
     */
    public function setCzyDaneSaPrawidlowe($czyDaneSaPrawidlowe)
    {
        $this->czyDaneSaPrawidlowe = $czyDaneSaPrawidlowe;

        return $this;
    }

    /**
     * Get czyDaneSaPrawidlowe
     *
     * @return bool
     */
    public function getCzyDaneSaPrawidlowe()
    {
        return $this->czyDaneSaPrawidlowe;
    }
}
