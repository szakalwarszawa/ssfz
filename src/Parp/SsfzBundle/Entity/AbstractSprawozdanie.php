<?php

namespace Parp\SsfzBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Parp\SsfzBundle\Exception\PublicVisibleExcpetion;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;
use Parp\SsfzBundle\Entity\Slownik\StatusSprawozdania;

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
     * Zwraca reprezentację tekstową obiektu.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

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
     *
     * @return AbstractSprawozdanie
     */
    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
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
        if (null !== $this->umowa) {
            return $this->umowa->getId();
        }

        return null;
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
     * Zwraca informację czy obiekt zawiera najnowszą wersję danych.
     *
     * @return bool
     */
    public function getCzyNajnowsza()
    {
        return $this->czyNajnowsza;
    }

    /**
     * Ustawia informację czy obiekt zwiera dane w najnowszej wersji.
     *
     * @param bool $czyNajnowsza
     *
     * @param AbstractSprawozdanie
     */
    public function setCzyNajnowsza(bool $czyNajnowsza): AbstractSprawozdanie
    {
        $this->czyNajnowsza = $czyNajnowsza;

        return $this;
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
     *
     * @return AbstractSprawozdanie
     */
    public function setUmowaId($umowaId)
    {
        $this->umowaId = $umowaId;

        return $this;
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
     *
     * @return AbstractSprawozdanie
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * ustawia creatorId
     *
     * @param int $creatorId
     *
     * @return AbstractSprawozdanie
     */
    public function setCreatorId($creatorId)
    {
        $this->creatorId = $creatorId;

        return $this;
    }

    /**
     * ustawia dateRejestracji
     *
     * @param datetime $dataRejestracji
     *
     * @return AbstractSprawozdanie
     */
    public function setDataRejestracji($dataRejestracji)
    {
        $this->dataRejestracji = $dataRejestracji;

        return $this;
    }

    /**
     * Ustawia datePrzeslaniaDoParp
     *
     * @param datetime $dataPrzeslaniaDoParp
     *
     * @return AbstractSprawozdanie
     */
    public function setDataPrzeslaniaDoParp($dataPrzeslaniaDoParp)
    {
        $this->dataPrzeslaniaDoParp = $dataPrzeslaniaDoParp;

        return $this;
    }

    /**
     * Ustawia previousVersionID
     *
     * @param int $previousVersionId
     *
     * @return AbstractSprawozdanie
     */
    public function setPreviousVersionId($previousVersionId)
    {
        $this->previousVersionId = $previousVersionId;

        return $this;
    }

    /**
     * Ustawia umowa
     *
     * @param  Umowa $umowa
     *
    * @return AbstractSprawozdanie
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
     *
     * @return AbstractSprawozdanie
     */
    public function setNumerUmowy($numerUmowy)
    {
        $this->numerUmowy = $numerUmowy;

        return $this;
    }

    /**
     * Ustawia okres
     *
     * @param OkresSprawozdawczy $okres
     *
     * @return AbstractSprawozdanie
     */
    public function setOkres(OkresSprawozdawczy $okres)
    {
        $this->okres = $okres;

        return $this;
    }

    /**
     * Ustawia rok
     *
     * @param string $rok
     *
     * @return AbstractSprawozdanie
     */
    public function setRok($rok)
    {
        $this->rok = $rok;

        return $this;
    }

    /**
     * Ustawia status
     *
     * @param int $status
     *
     * @return AbstractSprawozdanie
     */
    public function setStatus($status)
    {
        $this->status = $status;
        if ($this->status && $this->id) {
            $this->idStatus = $this->status . ',' . $this->id;
        }

        return $this;
    }

    /**
     * Ustawia wersję
     *
     * @param int $wersja
     *
     * @return AbstractSprawozdanie
     */
    public function setWersja($wersja)
    {
        $this->wersja = $wersja;

        return $this;
    }

    /**
     * Ustawia oceniajacyId
     *
     * @param int $oceniajacyId
     *
     * @return AbstractSprawozdanie
     */
    public function setOceniajacyId($oceniajacyId)
    {
        $this->oceniajacyId = $oceniajacyId;

        return $this;
    }

    /**
     * Ustawia dataZatwierdzenia
     *
     * @param datetime $dataZatwierdzenia
     *
     * @return AbstractSprawozdanie
     */
    public function setDataZatwierdzenia($dataZatwierdzenia)
    {
        $this->dataZatwierdzenia = $dataZatwierdzenia;

        return $this;
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do podglądu.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @return bool
     *
     * @throws PublicVisibleExcpetion
     */
    public function sprawdzCzyUzytkownikMozeWyswietlac(Uzytkownik $uzytkownik): bool
    {
        $idWlasciciela = (int) $this->umowa->getBeneficjent()->getUzytkownik()->getId();
        if ((int) $uzytkownik->getId() !== $idWlasciciela) {
            throw new PublicVisibleExcpetion('Nie można wyświetlić - sprawozdanie należy do innego użytkownika.');
        }

        return true;
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do edycji.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @return bool
     *
     * @throws PublicVisibleExcpetion
     */
    public function sprawdzCzyUzytkownikMozeEdytowac(Uzytkownik $uzytkownik)
    {
        $this->sprawdzCzyUzytkownikMozeWyswietlac($uzytkownik);
        
        if (!$this->czyNajnowsza) {
            throw new PublicVisibleExcpetion('Nie można edytować starych kopii sprawozdań.');
        }
        
        if (null !== $this->dataPrzeslaniaDoParp) {
            throw new PublicVisibleExcpetion('Nie można edytować - sprawozdanie już przesłano do PARP.');
        }

        return true;
    }
    
    /**
     * Wyrzuca wyjątek, jeśli użytkownik nie ma uprawnień do poprawy.
     *
     * @param Uzytkownik $uzytkownik
     *
     * @return bool
     *
     * @throws PublicVisibleExcpetion
     */
    public function sprawdzCzyUzytkownikMozePoprawiac(Uzytkownik $uzytkownik)
    {
        $this->sprawdzCzyUzytkownikMozeWyswietlac($uzytkownik);
        
        if (!$this->czyNajnowsza) {
            throw new PublicVisibleExcpetion('Nie można poprawiać starych kopii sprawozdań.');
        }
        
        if (StatusSprawozdania::POPRAWA !== $this->status) {
            throw new PublicVisibleExcpetion('Nie można poprawiać - sprawozdanie już przesłano do PARP.');
        }

        return true;
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
     *
     * @return AbstractSprawozdanie
     */
    public function setUwagi($uwagi)
    {
        $this->uwagi = $uwagi;

        return $this;
    }
}
