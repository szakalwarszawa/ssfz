<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Sprawozdanie
 *
 * @ORM\Table(name="sfz_sprawozdanie")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SprawozdanieRepository")
 */
class Sprawozdanie
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
     * @ORM\Column(name="umowa_id", type="integer", nullable=false)
     */
    private $umowaId;

    /**
     * @var int
     *
     * @ORM\Column(name="previous_version_id", type="integer", nullable=true)
     */
    private $previousVersionId;

    /**
     * @ORM\ManyToOne(targetEntity="Umowa", inversedBy="sprawozdania")
     * @ORM\JoinColumn(name="umowa_id", referencedColumnName="id")
     */
    private $umowa;

    /**
     * @var string
     *
     * @ORM\Column(name="numer_umowy", type="string", length=26, nullable=false)
     */
    private $numerUmowy;

    /**
     * @var string
     *
     * @ORM\Column(name="okres", type="string", nullable=false)
     */
    private $okres;

    /**
     * @var int
     *
     * @ORM\Column(name="okres_id", type="integer", nullable=false)
     */
    private $okresId;

    /**
     * @var string
     *
     * @ORM\Column(name="rok", type="string",length=4, nullable=false)
     */
    private $rok;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="wersja", type="integer", length=500, nullable=false)
     */
    private $wersja;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_najnowsza_wersja", type="boolean", nullable=false)
     */
    private $czyNajnowsza;

    /**
     * @var datetime
     *
     * @ORM\Column(name="data_przeslania_do_parp", type="datetime", nullable=true)
     */
    private $dataPrzeslaniaDoParp;

    /**
     * @var int
     *
     * @ORM\Column(name="oceniajacy_parp_id", type="integer", nullable=true)
     */
    private $oceniajacyId;

    /**
     * @var datetime
     *
     * @ORM\Column(name="data_zatwierdzenia_odeslania", type="datetime", nullable=true)
     */
    private $dataZatwierdzenia;

    /**
     * @var string
     *
     * @ORM\Column(name="uwagi", type="string", nullable=true)
     */
    private $uwagi;

    /**
     * Encje SprawozdanieSpolki powiazane ze sprawozdaniem - sprawozdania spolek
     *
     * @ORM\OneToMany(targetEntity="SprawozdanieSpolki", mappedBy="sprawozdanie", cascade={"persist", "remove"})
     */
    private $sprawozdaniaSpolek;

    /**
     * @var type
     *  
     * @ORM\Column(name="id_status", type="string", length=100, nullable=true)
     */
    private $idStatus;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="powiadomienie_wyslane", type="boolean", nullable=false)
     */
    private $powiadomienieWyslane = false;

    /**
     * zwraca nazwa
     *
     * @return idStatus
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * ustawia idStatus
     * 
     * @param int $idStatus
     */
    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
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
     * zwraca creatorId
     *
     * @return int
     */
    public function getCreatorId()
    {
        return $this->creatorId;
    }

    /**
     * zwraca previosuVersionId
     *
     * @return int
     */
    public function getPreviousVersionId()
    {
        return $this->previousVersionId;
    }

    /**
     * zwraca creatorId
     *
     * @return DateTime
     */
    public function getDataRejestracji()
    {
        return $this->dataRejestracji;
    }

    /**
     * zwraca dataPrzeslaniaDoParp
     *
     * @return DateTiem
     */
    public function getDataPrzeslaniaDoParp()
    {
        return $this->dataPrzeslaniaDoParp;
    }

    /**
     * zwraca umowaId
     *
     * @return int
     */
    public function getUmowaId()
    {
        return $this->umowaId;
    }

    /**
     * zwraca umowę
     *
     * @return Umowa
     */
    public function getUmowa()
    {
        return $this->umowa;
    }

    /**
     * zwraca numer umowy
     *
     * @return string
     */
    public function getNumerUmowy()
    {
        return $this->numerUmowy;
    }

    /**
     * zwraca okres
     *
     * @return string
     */
    public function getOkres()
    {
        return $this->okres;
    }

    /**
     * zwraca okresId
     *
     * @return int
     */
    public function getOkresId()
    {
        return $this->okresId;
    }

    /**
     * zwraca rok
     *
     * @return int
     */
    public function getRok()
    {
        return $this->rok;
    }

    /**
     * zwraca status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * zwraca wersję
     *
     * @return int
     */
    public function getWersja()
    {
        return $this->wersja;
    }

    /**
     * zwraca czyNajnowsza
     *
     * @return boolean
     */
    public function getCzyNajnowsza()
    {
        return $this->czyNajnowsza;
    }

    /**
     * zwraca oceniajacyId
     *
     * @return int
     */
    public function getOceniajacyId()
    {
        return $this->oceniajacyId;
    }

    /**
     * zwraca dataZatwierdzenia
     *
     * @return DateTime
     */
    public function getDataZatwierdzenia()
    {
        return $this->dataZatwierdzenia;
    }

    /**
     * zwraca uwagi
     *
     * @return string
     */
    public function getUwagi()
    {
        return $this->uwagi;
    }

    /**
     * zwraca czy powiadomienie wyslane
     * 
     * @return boolean
     */
    public function getPowiadomienieWyslane()
    {
        return $this->powiadomienieWyslane;
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
     * ustawia creatorId
     * 
     * @param int $creatorId
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;
    }

    /**
     * ustawia dateRejestracji
     * 
     * @param datetime $dataRejestracji
     */
    public function setDataRejestracji($dataRejestracji)
    {
        $this->dataRejestracji = $dataRejestracji;
    }

    /**
     * Ustawia datePrzeslaniaDoParp
     * 
     * @param datetime $dataPrzeslaniaDoParp
     */
    public function setDataPrzeslaniaDoParp($dataPrzeslaniaDoParp)
    {
        $this->dataPrzeslaniaDoParp = $dataPrzeslaniaDoParp;
    }

    /**
     * Ustawia umowaId
     * 
     * @param int $umowaId
     */
    public function setUmowaId($umowaId)
    {
        $this->umowaId = $umowaId;
    }

    /**
     * Ustawia previousVersionID
     * 
     * @param int $previousVersionId
     */
    public function setPreviousVersionId($previousVersionId)
    {
        $this->previousVersionId = $previousVersionId;
    }

    /**
     * Ustawia umowa
     *
     * @param  Umowa $umowa
     * @return Spolka
     */
    public function setUmowa($umowa)
    {
        $this->umowa = $umowa;

        return $this;
    }

    /**
     * Ustawia numerUmowy
     * 
     * @param string $numerUmowy
     */
    public function setNumerUmowy($numerUmowy)
    {
        $this->numerUmowy = $numerUmowy;
    }

    /**
     * Ustawia okres
     * 
     * @param string $okres
     */
    public function setOkres($okres)
    {
        if ($okres == 'styczeń - czerwiec') {
            $this->okresId = 0;
        }
        if ($okres != 'styczeń - czerwiec') {
            $this->okresId = 1;
        }
        $this->okres = $okres;
    }

    /**
     * Ustawia okres
     * 
     * @param int $okresId
     */
    public function setOkresId($okresId)
    {
        $this->okresId = $okresId;
    }

    /**
     * Ustawia rok
     * 
     * @param string $rok
     */
    public function setRok($rok)
    {
        $this->rok = $rok;
    }

    /**
     * Ustawia status
     * 
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        if ($this->status && $this->id) {
            $this->idStatus = $this->status . ',' . $this->id;
        }
    }

    /**
     * Ustawia wersję
     * 
     * @param int $wersja
     */
    public function setWersja($wersja)
    {
        $this->wersja = $wersja;
    }

    /**
     * Ustawia  flage czy najnowsza
     * 
     * @param bool $czyNajnowsza
     */
    public function setCzyNajnowsza($czyNajnowsza)
    {
        $this->czyNajnowsza = $czyNajnowsza;
    }

    /**
     * Ustawia oceniajacyId
     * 
     * @param int $oceniajacyId
     */
    public function setOceniajacyId($oceniajacyId)
    {
        $this->oceniajacyId = $oceniajacyId;
    }

    /**
     * Ustawia dataZatwierdzenia
     * 
     * @param datetime $dataZatwierdzenia
     */
    public function setDataZatwierdzenia($dataZatwierdzenia)
    {
        $this->dataZatwierdzenia = $dataZatwierdzenia;
    }

    /**
     * Ustawia uwagi
     * 
     * @param string $uwagi
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;
    }

    /**
     * Ustawia status powiadomienia
     * 
     * @param type $powiadomienieWyslane
     */
    public function setPowiadomienieWyslane($powiadomienieWyslane)
    {
        $this->powiadomienieWyslane = $powiadomienieWyslane;
    }

    /**
     * Set sprawozdaniaSpolek
     *
     * @param  SprawozdanieSpolki $spr
     * @return Sprawozdanie
     */
    public function setSprawozdaniaSpolek($spr)
    {
        $this->sprawozdaniaSpolek = $spr;

        return $this;
    }

    /**
     * Get sprawozdaniaSpolek
     * 
     * @return Collection
     */
    public function getSprawozdaniaSpolek()
    {
        return $this->sprawozdaniaSpolek;
    }

    /**
     * Funkcja dodająca sprawozdanie spolki do sprawozdania
     * 
     * @param \Parp\SsfzBundle\Entity\SprawozdanieSpolki $sprSpolki
     */
    public function addSprawozdaniaSpolek(SprawozdanieSpolki $sprSpolki)
    {
        $sprSpolki->setSprawozdanie($this);
        $this->sprawozdaniaSpolek->add($sprSpolki);
    }

    /**
     * Funkcja usuwająca sprawozdanie spolki ze sprawozdania
     * 
     * @param \Parp\SsfzBundle\Entity\SprawozdanieSpolki $sprSpolki
     */
    public function removeSprawozdaniaSpolek(SprawozdanieSpolki $sprSpolki)
    {
        $this->sprawozdaniaSpolek->removeElement($sprSpolki);
    }

    /**
     * Znajduje sprawozdanie dla spółki o podanej nazwie
     *
     * @param string $nazwa Nazwa spółki której sprawozdania szukać
     */
    public function findSprawozdanieSpolkiByNazwaSpolki($nazwa)
    {
        foreach ($this->sprawozdaniaSpolek as $sprawozdanie) {
            if ($sprawozdanie->getNazwaSpolki() == $nazwa) {
                return $sprawozdanie;
            }
        }

        return null;
    }

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->sprawozdaniaSpolek = new ArrayCollection();
    }

    /**
     * @Assert\Callback
     * 
     * Metoda sprawdza parametry zdefiniowane dla spolek
     * 
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        foreach ($this->sprawozdaniaSpolek as $spolka) {
            $spolka->validate($context);
        }
    }
}
