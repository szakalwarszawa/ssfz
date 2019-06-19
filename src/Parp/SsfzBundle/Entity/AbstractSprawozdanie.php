<?php

namespace Parp\SsfzBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Parp\SsfzBundle\Exception\KomunikatDlaBeneficjentaException;
use Parp\SsfzBundle\Entity\Slownik\StatusSprawozdania;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * AbstractSprawozdanie
 */
class AbstractSprawozdanie
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
     * @var DateTime
     *
     * @ORM\Column(name="data_rejestracji", type="datetime", nullable=false)
     */
    protected $dataRejestracji;

    /**
     * @var int
     *
     * @ORM\Column(name="umowa_id", type="integer", nullable=false)
     */
    protected $umowaId;

    /**
     * @var int
     *
     * @ORM\Column(name="previous_version_id", type="integer", nullable=true)
     */
    protected $previousVersionId;

    /**
     * @ORM\ManyToOne(targetEntity="Umowa", inversedBy="sprawozdania")
     * @ORM\JoinColumn(name="umowa_id", referencedColumnName="id")
     */
    protected $umowa;

    /**
     * @var string
     *
     * @ORM\Column(name="numer_umowy", type="string", length=26, nullable=false)
     */
    protected $numerUmowy;

    /**
     * Okres sprawozdawczy.
     *
     * @var OkresSprawozdawczy
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy")
     * @ORM\JoinColumn(name="okres_id", referencedColumnName="id", nullable=false)
     */
    protected $okres;

    /**
     * @var string
     *
     * @ORM\Column(name="rok", type="string",length=4, nullable=false)
     */
    protected $rok;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status;

    /**
     * @var int
     *
     * @ORM\Column(name="wersja", type="integer", length=500, nullable=false)
     */
    protected $wersja;

    /**
     * @var bool
     *
     * @ORM\Column(name="czy_najnowsza_wersja", type="boolean", nullable=false)
     */
    protected $czyNajnowsza;

    /**
     * @var datetime
     *
     * @ORM\Column(name="data_przeslania_do_parp", type="datetime", nullable=true)
     */
    protected $dataPrzeslaniaDoParp;

    /**
     * @var int
     *
     * @ORM\Column(name="oceniajacy_parp_id", type="integer", nullable=true)
     */
    protected $oceniajacyId;

    /**
     * @var datetime
     *
     * @ORM\Column(name="data_zatwierdzenia_odeslania", type="datetime", nullable=true)
     */
    protected $dataZatwierdzenia;

    /**
     * @var string
     *
     * @ORM\Column(name="id_status", type="string", length=100, nullable=true)
     */
    protected $idStatus;

    /**
     * @var bool
     *
     * @ORM\Column(name="powiadomienie_wyslane", type="boolean", nullable=false)
     */
    protected $powiadomienieWyslane = false;

    /**
     * @var string
     *
     * @ORM\Column(name="uwagi", type="string", nullable=true)
     */
    protected $uwagi;

    /**
     * zwraca ID statusu
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
     * @return OkresSprawozdawczy
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
        return (int) $this->okres->getId();
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
     * Ustawia umowaId
     *
     * @param int $umowaId
     */
    public function setUmowaId($umowaId)
    {
        $this->umowaId = $umowaId;
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
     *
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
     * @param OkresSprawozdawczy $okres
     */
    public function setOkres(OkresSprawozdawczy $okres)
    {
        $this->okres = $okres;
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
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do podglądu.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @throws KomunikatDlaBeneficjentaException
     */
    public function sprawdzCzyUzytkownikMozeWyswietlac(Uzytkownik $uzytkownik)
    {
        $idWlasciciela = (int) $this->umowa->getBeneficjent()->getUzytkownik()->getId();

        if ((int) $uzytkownik->getId() !== $idWlasciciela) {
            throw new KomunikatDlaBeneficjentaException('Nie można wyświetlić - sprawozdanie należy do innego użytkownika.');
        }
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do edycji.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @throws KomunikatDlaBeneficjentaException
     */
    public function sprawdzCzyUzytkownikMozeEdytowac(Uzytkownik $uzytkownik)
    {
        $this->sprawdzCzyUzytkownikMozeWyswietlac($uzytkownik);
        
        if (!$this->czyNajnowsza) {
            throw new KomunikatDlaBeneficjentaException('Nie można edytować starych kopii sprawozdań.');
        }
        
        if (null !== $this->dataPrzeslaniaDoParp) {
            throw new KomunikatDlaBeneficjentaException('Nie można edytować - sprawozdanie już przesłano do PARP.');
        }
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do poprawy.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @throws KomunikatDlaBeneficjentaException
     */
    public function sprawdzCzyUzytkownikMozePoprawiac(Uzytkownik $uzytkownik)
    {
        $this->sprawdzCzyUzytkownikMozeWyswietlac($uzytkownik);
        
        if (!$this->czyNajnowsza) {
            throw new KomunikatDlaBeneficjentaException('Nie można poprawiać starych kopii sprawozdań.');
        }
        
        if (StatusSprawozdania::POPRAWA !== $this->status) {
            throw new KomunikatDlaBeneficjentaException('Nie można poprawiać - sprawozdanie już przesłano do PARP.');
        }
    }
    
    /**
     * Informuje, czy status sprawozdania to w trakcie poprawy.
     *
     * @return bool
     */
    public function czyStatusWTrakciePoprawy()
    {
        return (StatusSprawozdania::POPRAWA === $this->status);
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
     * Ustawia uwagi
     *
     * @param string $uwagi
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;
    }
}
