<?php
namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

/**
 * Spolka
 *
 * @ORM\Table(name="sfz_spolka_historia")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SpolkaHistoriaRepository")
 */
class SpolkaHistoria
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
     * @ORM\Column(name="spolka_id", type="integer", nullable=true)
     */
    private $spolkaId;

    /**
     * @var int
     *
     * @ORM\Column(name="uzytkownik_id", type="integer", nullable=true)
     */
    private $uzytkownikId;

    /**
     * @var Carbon\Carbon
     *
     * @ORM\Column(name="data_zmiany", type="datetime", nullable=true)
     */
    private $dataZmiany;

    /**
     * @var int
     *
     * @ORM\Column(name="umowa_id", type="integer", nullable=true)
     */
    private $umowaId;

    /**
     * @var int
     *
     * @ORM\Column(name="lp", type="integer", nullable=true)
     */
    private $lp;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=140, nullable=true)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="forma", type="string", length=140, nullable=true)
     */
    private $forma;

    /**
     * @var string
     *
     * @ORM\Column(name="siedziba_miasto", type="string", length=140, nullable=true)
     */
    private $siedzibaMiasto;

    /**
     * @var string
     *
     * @ORM\Column(name="siedziba_wojewodztwo", type="string", length=100, nullable=true)
     */
    private $siedzibaWojewodztwo;

    /**
     * @var string
     *
     * @ORM\Column(name="branza", type="string", length=100, nullable=true)
     */
    private $branza;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text", nullable=true)
     */
    private $opis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_powolania", type="datetime", nullable=true)
     */
    private $dataPowolania;

    /**
     * @var int
     *
     * @ORM\Column(name="krs", type="string", length=15, nullable=true)
     */
    private $krs;

    /**
     * @var int
     *
     * @ORM\Column(name="nip", type="string", length=15, nullable=true)
     */
    private $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_inwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwInwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_wsparcia", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwWsparcia;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_pryw", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwPryw;

    /**
     * @var bool
     *
     * @ORM\Column(name="zakonczona", type="boolean", nullable=true)
     */
    private $zakonczona;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wyjscia", type="datetime", nullable=true)
     */
    private $dataWyjscia;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_dezinwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwDezinwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="zwrot_inwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $zwrotInwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="npv", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $npv;

    /**
     * @var string
     *
     * @ORM\Column(name="udzialowcy", type="text", nullable=true)
     */
    private $udzialowcy;

    /**
     * @var string
     *
     * @ORM\Column(name="prezes", type="string", length=140, nullable=true)
     */
    private $prezes;

    /**
     * @var string
     *
     * @ORM\Column(name="zarzad_pozostali", type="text", nullable=true)
     */
    private $zarzadPozostali;

    /**
     * @var int
     *
     * @ORM\Column(name="lp_p", type="integer", nullable=true)
     */
    private $lpP;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa_p", type="string", length=140, nullable=true)
     */
    private $nazwaP;

    /**
     * @var string
     *
     * @ORM\Column(name="forma_p", type="string", length=140, nullable=true)
     */
    private $formaP;

    /**
     * @var string
     *
     * @ORM\Column(name="siedziba_miasto_p", type="string", length=140, nullable=true)
     */
    private $siedzibaMiastoP;

    /**
     * @var string
     *
     * @ORM\Column(name="siedziba_wojewodztwo_p", type="string", length=100, nullable=true)
     */
    private $siedzibaWojewodztwoP;

    /**
     * @var string
     *
     * @ORM\Column(name="branza_p", type="string", length=100, nullable=true)
     */
    private $branzaP;

    /**
     * @var string
     *
     * @ORM\Column(name="opis_p", type="text", nullable=true)
     */
    private $opisP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_powolania_p", type="datetime", nullable=true)
     */
    private $dataPowolaniaP;

    /**
     * @var int
     *
     * @ORM\Column(name="krs_p", type="string", length=15, nullable=true)
     */
    private $krsP;

    /**
     * @var int
     *
     * @ORM\Column(name="nip_p", type="string", length=15, nullable=true)
     */
    private $nipP;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_inwestycji_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwInwestycjiP;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_wsparcia_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwWsparciaP;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_pryw_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwPrywP;

    /**
     * @var bool
     *
     * @ORM\Column(name="zakonczona_p", type="boolean", nullable=true)
     */
    private $zakonczonaP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wyjscia_p", type="datetime", nullable=true)
     */
    private $dataWyjsciaP;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_dezinwestycji_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $kwDezinwestycjiP;

    /**
     * @var string
     *
     * @ORM\Column(name="zwrot_inwestycji_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $zwrotInwestycjiP;

    /**
     * @var string
     *
     * @ORM\Column(name="npv_p", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $npvP;

    /**
     * @var string
     *
     * @ORM\Column(name="udzialowcy_p", type="text", nullable=true)
     */
    private $udzialowcyP;

    /**
     * @var string
     *
     * @ORM\Column(name="prezes_p", type="string", length=140, nullable=true)
     */
    private $prezesP;

    /**
     * @var string
     *
     * @ORM\Column(name="zarzad_pozostali_p", type="text", nullable=true)
     */
    private $zarzadPozostaliP;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set spolkaId
     *
     * @param  integer $spolkaId
     * @return SpolkaHistoria
     */
    public function setSpolkaId($spolkaId)
    {
        $this->spolkaId = $spolkaId;

        return $this;
    }

    /**
     * Get spolkaId
     *
     * @return integer 
     */
    public function getSpolkaId()
    {
        return $this->spolkaId;
    }

    /**
     * Set uzytkownikId
     *
     * @param  integer $uzytkownikId
     * @return SpolkaHistoria
     */
    public function setUzytkownikId($uzytkownikId)
    {
        $this->uzytkownikId = $uzytkownikId;

        return $this;
    }

    /**
     * Get uzytkownikId
     *
     * @return integer 
     */
    public function getUzytkownikId()
    {
        return $this->uzytkownikId;
    }

    /**
     * Set dataZmiany
     *
     * @param  \Parp\SsfzBundle\Entity\Carbon\Carbon $dataZmiany
     * @return SpolkaHistoria
     */
    public function setDataZmiany(\Carbon\Carbon $dataZmiany)
    {
        $this->dataZmiany = $dataZmiany;

        return $this;
    }

    /**
     * Get dataZmiany
     *
     * @return Carbon\Carbon 
     */
    public function getDataZmiany()
    {
        return $this->dataZmiany;
    }

    /**
     * Set umowaId
     *
     * @param  integer $umowaId
     * @return SpolkaHistoria
     */
    public function setUmowaId($umowaId)
    {
        $this->umowaId = $umowaId;

        return $this;
    }

    /**
     * Get umowaId
     *
     * @return integer 
     */
    public function getUmowaId()
    {
        return $this->umowaId;
    }

    /**
     * Set lp
     *
     * @param  integer $lp
     * @return SpolkaHistoria
     */
    public function setLp($lp)
    {
        $this->lp = $lp;

        return $this;
    }

    /**
     * Get lp
     *
     * @return integer 
     */
    public function getLp()
    {
        return $this->lp;
    }

    /**
     * Set nazwa
     *
     * @param  string $nazwa
     * @return SpolkaHistoria
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
     * Set forma
     *
     * @param  string $forma
     * @return SpolkaHistoria
     */
    public function setForma($forma)
    {
        $this->forma = $forma;

        return $this;
    }

    /**
     * Get forma
     *
     * @return string 
     */
    public function getForma()
    {
        return $this->forma;
    }

    /**
     * Set siedzibaMiasto
     *
     * @param  string $siedzibaMiasto
     * @return SpolkaHistoria
     */
    public function setSiedzibaMiasto($siedzibaMiasto)
    {
        $this->siedzibaMiasto = $siedzibaMiasto;

        return $this;
    }

    /**
     * Get siedzibaMiasto
     *
     * @return string 
     */
    public function getSiedzibaMiasto()
    {
        return $this->siedzibaMiasto;
    }

    /**
     * Set siedzibaWojewodztwo
     *
     * @param  string $siedzibaWojewodztwo
     * @return SpolkaHistoria
     */
    public function setSiedzibaWojewodztwo($siedzibaWojewodztwo)
    {
        $this->siedzibaWojewodztwo = $siedzibaWojewodztwo;

        return $this;
    }

    /**
     * Get siedzibaWojewodztwo
     *
     * @return string 
     */
    public function getSiedzibaWojewodztwo()
    {
        return $this->siedzibaWojewodztwo;
    }

    /**
     * Set branza
     *
     * @param  string $branza
     * @return SpolkaHistoria
     */
    public function setBranza($branza)
    {
        $this->branza = $branza;

        return $this;
    }

    /**
     * Get branza
     *
     * @return string 
     */
    public function getBranza()
    {
        return $this->branza;
    }

    /**
     * Set opis
     *
     * @param  string $opis
     * @return SpolkaHistoria
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string 
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set dataPowolania
     *
     * @param  \DateTime $dataPowolania
     * @return SpolkaHistoria
     */
    public function setDataPowolania($dataPowolania)
    {
        $this->dataPowolania = $dataPowolania;

        return $this;
    }

    /**
     * Get dataPowolania
     *
     * @return \DateTime 
     */
    public function getDataPowolania()
    {
        return $this->dataPowolania;
    }

    /**
     * Set krs
     *
     * @param  integer $krs
     * @return SpolkaHistoria
     */
    public function setKrs($krs)
    {
        $this->krs = $krs;

        return $this;
    }

    /**
     * Get krs
     *
     * @return integer 
     */
    public function getKrs()
    {
        return $this->krs;
    }

    /**
     * Set nip
     *
     * @param  integer $nip
     * @return SpolkaHistoria
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return integer 
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set kwInwestycji
     *
     * @param  string $kwInwestycji
     * @return SpolkaHistoria
     */
    public function setKwInwestycji($kwInwestycji)
    {
        $this->kwInwestycji = $kwInwestycji;

        return $this;
    }

    /**
     * Get kwInwestycji
     *
     * @return string 
     */
    public function getKwInwestycji()
    {
        return $this->kwInwestycji;
    }

    /**
     * Set kwWsparcia
     *
     * @param  string $kwWsparcia
     * @return SpolkaHistoria
     */
    public function setKwWsparcia($kwWsparcia)
    {
        $this->kwWsparcia = $kwWsparcia;

        return $this;
    }

    /**
     * Get kwWsparcia
     *
     * @return string 
     */
    public function getKwWsparcia()
    {
        return $this->kwWsparcia;
    }

    /**
     * Set kwPryw
     *
     * @param  string $kwPryw
     * @return SpolkaHistoria
     */
    public function setKwPryw($kwPryw)
    {
        $this->kwPryw = $kwPryw;

        return $this;
    }

    /**
     * Get kwPryw
     *
     * @return string 
     */
    public function getKwPryw()
    {
        return $this->kwPryw;
    }

    /**
     * Set zakonczona
     *
     * @param  boolean $zakonczona
     * @return SpolkaHistoria
     */
    public function setZakonczona($zakonczona)
    {
        $this->zakonczona = $zakonczona;

        return $this;
    }

    /**
     * Get zakonczona
     *
     * @return boolean 
     */
    public function getZakonczona()
    {
        return $this->zakonczona;
    }

    /**
     * Set dataWyjscia
     *
     * @param  \DateTime $dataWyjscia
     * @return SpolkaHistoria
     */
    public function setDataWyjscia($dataWyjscia)
    {
        $this->dataWyjscia = $dataWyjscia;

        return $this;
    }

    /**
     * Get dataWyjscia
     *
     * @return \DateTime 
     */
    public function getDataWyjscia()
    {
        return $this->dataWyjscia;
    }

    /**
     * Set kwDezinwestycji
     *
     * @param  string $kwDezinwestycji
     * @return SpolkaHistoria
     */
    public function setKwDezinwestycji($kwDezinwestycji)
    {
        $this->kwDezinwestycji = $kwDezinwestycji;

        return $this;
    }

    /**
     * Get kwDezinwestycji
     *
     * @return string 
     */
    public function getKwDezinwestycji()
    {
        return $this->kwDezinwestycji;
    }

    /**
     * Set zwrotInwestycji
     *
     * @param  string $zwrotInwestycji
     * @return SpolkaHistoria
     */
    public function setZwrotInwestycji($zwrotInwestycji)
    {
        $this->zwrotInwestycji = $zwrotInwestycji;

        return $this;
    }

    /**
     * Get zwrotInwestycji
     *
     * @return string 
     */
    public function getZwrotInwestycji()
    {
        return $this->zwrotInwestycji;
    }

    /**
     * Set npv
     *
     * @param  string $npv
     * @return SpolkaHistoria
     */
    public function setNpv($npv)
    {
        $this->npv = $npv;

        return $this;
    }

    /**
     * Get npv
     *
     * @return string 
     */
    public function getNpv()
    {
        return $this->npv;
    }

    /**
     * Set udzialowcy
     *
     * @param  string $udzialowcy
     * @return SpolkaHistoria
     */
    public function setUdzialowcy($udzialowcy)
    {
        $this->udzialowcy = $udzialowcy;

        return $this;
    }

    /**
     * Get udzialowcy
     *
     * @return string 
     */
    public function getUdzialowcy()
    {
        return $this->udzialowcy;
    }

    /**
     * Set prezes
     *
     * @param  string $prezes
     * @return SpolkaHistoria
     */
    public function setPrezes($prezes)
    {
        $this->prezes = $prezes;

        return $this;
    }

    /**
     * Get prezes
     *
     * @return string 
     */
    public function getPrezes()
    {
        return $this->prezes;
    }

    /**
     * Set zarzadPozostali
     *
     * @param  string $zarzadPozostali
     * @return SpolkaHistoria
     */
    public function setZarzadPozostali($zarzadPozostali)
    {
        $this->zarzadPozostali = $zarzadPozostali;

        return $this;
    }

    /**
     * Get zarzadPozostali
     *
     * @return string 
     */
    public function getZarzadPozostali()
    {
        return $this->zarzadPozostali;
    }

    /**
     * Set lpP
     *
     * @param  integer $lpP
     * @return SpolkaHistoria
     */
    public function setLpP($lpP)
    {
        $this->lpP = $lpP;

        return $this;
    }

    /**
     * Get lpP
     *
     * @return integer 
     */
    public function getLpP()
    {
        return $this->lpP;
    }

    /**
     * Set nazwaP
     *
     * @param  string $nazwaP
     * @return SpolkaHistoria
     */
    public function setNazwaP($nazwaP)
    {
        $this->nazwaP = $nazwaP;

        return $this;
    }

    /**
     * Get nazwaP
     *
     * @return string 
     */
    public function getNazwaP()
    {
        return $this->nazwaP;
    }

    /**
     * Set forma
     *
     * @param  string $formaP
     * @return SpolkaHistoria
     */
    public function setFormaP($formaP)
    {
        $this->formaP = $formaP;

        return $this;
    }

    /**
     * Get forma
     *
     * @return string 
     */
    public function getFormaP()
    {
        return $this->formaP;
    }

    /**
     * Set siedzibaMiastoP
     *
     * @param  string $siedzibaMiastoP
     * @return SpolkaHistoria
     */
    public function setSiedzibaMiastoP($siedzibaMiastoP)
    {
        $this->siedzibaMiastoP = $siedzibaMiastoP;

        return $this;
    }

    /**
     * Get siedzibaMiastoP
     *
     * @return string 
     */
    public function getSiedzibaMiastoP()
    {
        return $this->siedzibaMiastoP;
    }

    /**
     * Set siedzibaWojewodztwoP
     *
     * @param  string $siedzibaWojewodztwoP
     * @return SpolkaHistoria
     */
    public function setSiedzibaWojewodztwoP($siedzibaWojewodztwoP)
    {
        $this->siedzibaWojewodztwoP = $siedzibaWojewodztwoP;

        return $this;
    }

    /**
     * Get siedzibaWojewodztwoP
     *
     * @return string 
     */
    public function getSiedzibaWojewodztwoP()
    {
        return $this->siedzibaWojewodztwoP;
    }

    /**
     * Set branzaP
     *
     * @param  string $branzaP
     * @return SpolkaHistoria
     */
    public function setBranzaP($branzaP)
    {
        $this->branzaP = $branzaP;

        return $this;
    }

    /**
     * Get branzaP
     *
     * @return string 
     */
    public function getBranzaP()
    {
        return $this->branzaP;
    }

    /**
     * Set opis
     *
     * @param  string $opisP
     * @return SpolkaHistoria
     */
    public function setOpisP($opisP)
    {
        $this->opisP = $opisP;

        return $this;
    }

    /**
     * Get opisP
     *
     * @return string 
     */
    public function getOpisP()
    {
        return $this->opisP;
    }

    /**
     * Set dataPowolaniaP
     *
     * @param  \DateTime $dataPowolaniaP
     * @return SpolkaHistoria
     */
    public function setDataPowolaniaP($dataPowolaniaP)
    {
        $this->dataPowolaniaP = $dataPowolaniaP;

        return $this;
    }

    /**
     * Get dataPowolaniaP
     *
     * @return \DateTime 
     */
    public function getDataPowolaniaP()
    {
        return $this->dataPowolaniaP;
    }

    /**
     * Set krsP
     *
     * @param  integer $krsP
     * @return SpolkaHistoria
     */
    public function setKrsP($krsP)
    {
        $this->krsP = $krsP;

        return $this;
    }

    /**
     * Get krsP
     *
     * @return integer 
     */
    public function getKrsP()
    {
        return $this->krsP;
    }

    /**
     * Set nipP
     *
     * @param  integer $nipP
     * @return SpolkaHistoria
     */
    public function setNipP($nipP)
    {
        $this->nipP = $nipP;

        return $this;
    }

    /**
     * Get nipP
     *
     * @return integer 
     */
    public function getNipP()
    {
        return $this->nipP;
    }

    /**
     * Set kwInwestycjiP
     *
     * @param  string $kwInwestycjiP
     * @return SpolkaHistoria
     */
    public function setKwInwestycjiP($kwInwestycjiP)
    {
        $this->kwInwestycjiP = $kwInwestycjiP;

        return $this;
    }

    /**
     * Get kwInwestycjiP
     *
     * @return string 
     */
    public function getKwInwestycjiP()
    {
        return $this->kwInwestycjiP;
    }

    /**
     * Set kwWsparciaP
     *
     * @param  string $kwWsparciaP
     * @return SpolkaHistoria
     */
    public function setKwWsparciaP($kwWsparciaP)
    {
        $this->kwWsparciaP = $kwWsparciaP;

        return $this;
    }

    /**
     * Get kwWsparciaP
     *
     * @return string 
     */
    public function getKwWsparciaP()
    {
        return $this->kwWsparciaP;
    }

    /**
     * Set kwPrywP
     *
     * @param  string $kwPrywP
     * @return SpolkaHistoria
     */
    public function setKwPrywP($kwPrywP)
    {
        $this->kwPrywP = $kwPrywP;

        return $this;
    }

    /**
     * Get kwPrywP
     *
     * @return string 
     */
    public function getKwPrywP()
    {
        return $this->kwPrywP;
    }

    /**
     * Set zakonczonaP
     *
     * @param  boolean $zakonczonaP
     * @return SpolkaHistoria
     */
    public function setZakonczonaP($zakonczonaP)
    {
        $this->zakonczonaP = $zakonczonaP;

        return $this;
    }

    /**
     * Get zakonczona
     *
     * @return boolean 
     */
    public function getZakonczonaP()
    {
        return $this->zakonczonaP;
    }

    /**
     * Set dataWyjsciaP
     *
     * @param  \DateTime $dataWyjsciaP
     * @return SpolkaHistoria
     */
    public function setDataWyjsciaP($dataWyjsciaP)
    {
        $this->dataWyjsciaP = $dataWyjsciaP;

        return $this;
    }

    /**
     * Get dataWyjsciaP
     *
     * @return \DateTime 
     */
    public function getDataWyjsciaP()
    {
        return $this->dataWyjsciaP;
    }

    /**
     * Set kwDezinwestycjiP
     *
     * @param  string $kwDezinwestycjiP
     * @return SpolkaHistoria
     */
    public function setKwDezinwestycjiP($kwDezinwestycjiP)
    {
        $this->kwDezinwestycjiP = $kwDezinwestycjiP;

        return $this;
    }

    /**
     * Get kwDezinwestycjiP
     *
     * @return string 
     */
    public function getKwDezinwestycjiP()
    {
        return $this->kwDezinwestycjiP;
    }

    /**
     * Set zwrotInwestycjiP
     *
     * @param  string $zwrotInwestycjiP
     * @return SpolkaHistoria
     */
    public function setZwrotInwestycjiP($zwrotInwestycjiP)
    {
        $this->zwrotInwestycjiP = $zwrotInwestycjiP;

        return $this;
    }

    /**
     * Get zwrotInwestycjiP
     *
     * @return string 
     */
    public function getZwrotInwestycjiP()
    {
        return $this->zwrotInwestycjiP;
    }

    /**
     * Set npvP
     *
     * @param  string $npvP
     * @return SpolkaHistoria
     */
    public function setNpvP($npvP)
    {
        $this->npvP = $npvP;

        return $this;
    }

    /**
     * Get npvP
     *
     * @return string 
     */
    public function getNpvP()
    {
        return $this->npvP;
    }

    /**
     * Set udzialowcyP
     *
     * @param  string $udzialowcyP
     * @return SpolkaHistoria
     */
    public function setUdzialowcyP($udzialowcyP)
    {
        $this->udzialowcyP = $udzialowcyP;

        return $this;
    }

    /**
     * Get udzialowcyP
     *
     * @return string 
     */
    public function getUdzialowcyP()
    {
        return $this->udzialowcyP;
    }

    /**
     * Set prezesP
     *
     * @param  string $prezesP
     * @return SpolkaHistoria
     */
    public function setPrezesP($prezesP)
    {
        $this->prezesP = $prezesP;

        return $this;
    }

    /**
     * Get prezesP
     *
     * @return string 
     */
    public function getPrezesP()
    {
        return $this->prezesP;
    }

    /**
     * Set zarzadPozostaliP
     *
     * @param  string $zarzadPozostaliP
     * @return SpolkaHistoria
     */
    public function setZarzadPozostaliP($zarzadPozostaliP)
    {
        $this->zarzadPozostaliP = $zarzadPozostaliP;

        return $this;
    }

    /**
     * Get zarzadPozostaliP
     *
     * @return string 
     */
    public function getZarzadPozostaliP()
    {
        return $this->zarzadPozostaliP;
    }

    /**
     * Wyzwalane przy operacji INSERT

     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->dataZmiany = new Carbon('Europe/Warsaw');
    }

    /**
     * Wyzwalane przy operacji UPDATE

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->dataZmiany = new Carbon('Europe/Warsaw');
    }
}
