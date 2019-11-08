<?php

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Spolka
 *
 * @ORM\Table(name="sfz_spolka")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\SpolkaRepository")
 */
class Spolka
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
     * @ORM\ManyToOne(targetEntity="Umowa", inversedBy="spolki")
     * @ORM\JoinColumn(name="umowa_id", referencedColumnName="id")
     */
    protected $umowa;

    /**
     * @var int
     *
     * @ORM\Column(name="lp", type="integer", nullable=true)
     */
    protected $liczbaPorzadkowa;

    /**
     * @var string
     *
     * @Assert\Length(
     *      max = 1000,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="nazwa", type="string", length=140, nullable=true)
     */
    protected $nazwa;

    /**
     * @var string
     *
     * @Assert\Length(
     *      max = 140,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="forma", type="string", length=140, nullable=true)
     */
    protected $forma;

    /**
     * @var string
     *
     *  @Assert\Length(
     *      max = 140,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="siedziba_miasto", type="string", length=140, nullable=true)
     */
    protected $siedzibaMiasto;

    /**
     * @var string
     *
     * @ORM\Column(name="siedziba_wojewodztwo", type="string", length=100, nullable=true)
     */
    protected $siedzibaWojewodztwo;

    /**
     * @var string
     *
     * @ORM\Column(name="branza", type="string", length=100, nullable=true)
     */
    protected $branza;

    /**
     * @var string
     *  @Assert\Length(
     *      max = 1000,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="opis", type="text", nullable=true)
     */
    protected $opis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_powolania", type="datetime", nullable=true)
     */
    protected $dataPowolania;

    /**
     * @var int
     *
     * @Assert\Regex(pattern="'/^[0-9]{10}$/'", match = false, message="Niepoprawny nr KRS.")
     *
     * @ORM\Column(name="krs", type="string", length=15, nullable=true)
     */
    protected $krs;

    /**
     * @var int
     *
     * @ORM\Column(name="nip", type="string", length=15, nullable=true)
     */
    protected $nip;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_inwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kwInwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_wsparcia", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kwWsparcia;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_pryw", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kwPryw;

    /**
     * @var bool
     *
     * @ORM\Column(name="zakonczona", type="boolean", nullable=true)
     */
    protected $zakonczona;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wyjscia", type="datetime", nullable=true)
     */
    protected $dataWyjscia;

    /**
     * @var string
     *
     * @ORM\Column(name="kw_dezinwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $kwDezinwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="zwrot_inwestycji", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $zwrotInwestycji;

    /**
     * @var string
     *
     * @ORM\Column(name="npv", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected $npv;

    /**
     * @var string
     *
     * @Assert\Length(
     *      max = 1000,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="udzialowcy", type="text", nullable=true)
     */
    protected $udzialowcy;

    /**
     * @var string
     *
     * @Assert\Length(
     *      max = 140,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="prezes", type="string", length=140, nullable=true)
     */
    protected $prezes;

    /**
     * @var string
     *  @Assert\Length(
     *      max = 1000,
     *      maxMessage = "W polu nie może znajdować się więcej niż {{ limit }} znaków."
     * )
     *
     * @ORM\Column(name="zarzad_pozostali", type="text", nullable=true)
     */
    protected $zarzadPozostali;

    /**
     * @return type????????????????????????????????????
     */
    public function getZakonczonaDodatkowe()
    {
        return $this->getZakonczona();
    }

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
     * Set umowaId
     *
     * @param int $umowaId
     *
     * @return Spolka
     */
    public function setUmowaId($umowaId)
    {
        $this->umowaId = $umowaId;

        return $this;
    }

    /**
     * Get umowaId
     *
     * @return int
     */
    public function getUmowaId()
    {
        return $this->umowaId;
    }

    /**
     * Set umowa
     *
     * @param Umowa $umowa
     *
     * @return Spolka
     */
    public function setUmowa($umowa)
    {
        $this->umowa = $umowa;

        return $this;
    }

    /**
     * Get umowa
     *
     * @return Umowa
     */
    public function getUmowa()
    {
        return $this->umowa;
    }

    /**
     * Set lp
     *
     * @param int $liczbaPorzadkowa
     *
     * @return Spolka
     */
    public function setLp($liczbaPorzadkowa)
    {
        $this->liczbaPorzadkowa = $liczbaPorzadkowa;

        return $this;
    }

    /**
     * Get lp
     *
     * @return int
     */
    public function getLp()
    {
        return $this->liczbaPorzadkowa;
    }

    /**
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Spolka
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
     * @param string $forma
     *
     * @return Spolka
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
     * @param string $siedzibaMiasto
     *
     * @return Spolka
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
     *
     * @return Spolka
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
     * @param string $branza
     *
     * @return Spolka
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
     * @param string $opis
     *
     * @return Spolka
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
     * @param \DateTime $dataPowolania
     *
     * @return Spolka
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
     * @param string $krs
     *
     * @return Spolka
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
     * Set nip
     *
     * @param string $nip
     *
     * @return Spolka
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
     * Set kwInwestycji
     *
     * @param string $kwInwestycji
     *
     * @return Spolka
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
     * @param string $kwWsparcia
     *
     * @return Spolka
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
     * @param string $kwPryw
     *
     * @return Spolka
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
     * @param bool $zakonczona
     *
     * @return Spolka
     */
    public function setZakonczona($zakonczona)
    {
        $this->zakonczona = $zakonczona;

        return $this;
    }

    /**
     * Get zakonczona
     *
     * @return bool
     */
    public function getZakonczona()
    {
        return $this->zakonczona;
    }

    /**
     * Set dataWyjscia
     *
     * @param \DateTime $dataWyjscia
     *
     * @return Spolka
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
     * @param string $kwDezinwestycji
     *
     * @return Spolka
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
     * @param string $zwrotInwestycji
     *
     * @return Spolka
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
     * @param string $npv
     *
     * @return Spolka
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
     * @param string $udzialowcy
     *
     * @return Spolka
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
     * @param string $prezes
     *
     * @return Spolka
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
     * @param string $zarzadPozostali
     *
     * @return Spolka
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
     * Walidacje
     *
     * @param ExecutionContextInterface $context kontekst wywołania
     *
     * @Assert\Callback
     *
     * @return void
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (1 === $this->getZakonczona() && (null === $this->getDataWyjscia() || '' === $this->getDataWyjscia())) {
            $context->buildViolation('Należy wypełnić pole')
                ->atPath('dataWyjscia')
                ->addViolation();
        }
        if (
            1 === $this->getZakonczona() &&
            (null === $this->getKwDezinwestycji() ||
                '' === $this->getKwDezinwestycji())
        ) {
            $context->buildViolation('Należy wypełnić pole')
                ->atPath('kwDezinwestycji')
                ->addViolation();
        }
        if (
            1 === $this->getZakonczona() &&
            (null === $this->getZwrotInwestycji() ||
                '' === $this->getZwrotInwestycji())
        ) {
            $context->buildViolation('Należy wypełnić pole')
                ->atPath('zwrotInwestycji')
                ->addViolation();
        }
        if (
            1 === $this->getZakonczona() &&
            (null === $this->getNpv() ||
                '' === $this->getNpv())
        ) {
            $context->buildViolation('Należy wypełnić pole')
                ->atPath('npv')
                ->addViolation();
        }
        if (preg_match('/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/', $this->getKwPryw())
            && preg_match('/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/', $this->getKwWsparcia())
            && preg_match('/^([-])?[0-9]{1,13}[\.\,][0-9]{2}$/', $this->getKwInwestycji())
        ) {
            $sum = number_format(
                ($this->getKwPryw() + $this->getKwWsparcia()),
                2,
                '.',
                ''
            );
            if (
                    (float)number_format($this->getKwInwestycji(),
                    2,
                    '.',
                    '') !== (float)$sum
            ) {
                $context->buildViolation('Suma kwot ze środków wsparcia i środków prywatnych musi równać'
                    . ' się kwocie inwestycji.')
                    ->atPath('kwPryw')
                    ->addViolation();
                $context->buildViolation('Suma kwot ze środków wsparcia i środków prywatnych musi równać się'
                    . ' kwocie inwestycji.')
                    ->atPath('kwWsparcia')
                    ->addViolation();
            }
        }
    }
}
