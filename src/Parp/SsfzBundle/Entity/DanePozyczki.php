<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\Sprawozdanie;

/**
 * Pożyczkach dla SPO WKP 1.2.1.
 *
 * @ORM\Table(name="sfz_dane_pozyczek")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\DanePozyczkiRepository")
 */
class DanePozyczki
{
    /**
     * Identyfikator.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Sprawozdanie, do którego przypisano dane pożyczki.
     *
     * @var Sprawozdanie
     * 
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\Sprawozdanie")
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id", nullable=false)
     */
    protected $sprawozdanie;

    /**
     * Liczba pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek do 10.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )ewewe
     */
    protected $liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 301.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_male_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek do 10.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_male_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_male_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_male_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_120001_do_300000_pln_male_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = 0;
    
    /**
     * Liczba pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_male_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 301.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = 0;































    /**
     * Liczba pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_srednie_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek do 10.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_10001_do_30000_pln_srednie_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = 0;


    /**
    * Liczba pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_30001_do_50000_pln_srednie_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_50001_do_120000_pln_srednie_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_120001_do_300000_pln_srednie_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_srednie_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 301.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = 0;































    protected $liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = 0;
    protected $liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = 0;

    protected $liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = 0;
    protected $liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    protected $liczbaPozyczekObrotowwychDo10000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekObrotowwychOd300001Pln = 0;

    protected $liczbaPozyczekInwestycyjnychDo10000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekInwestycyjnychOd300001Pln = 0;

    protected $liczbaPozyczekInwestycyjnoObrotowychDo10000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = 0;
    protected $liczbaPozyczekInwestycyjnoObrotowychOd300001Pln = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaHandlowe = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaUslugowe = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaBudownicze = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaRolnicze = 0;

    protected $liczbaPozyczekDo10000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne = 0;
    protected $liczbaPozyczekOd300001PlnNaDzialaniaInne = 0;

    /**
     * Konstruktor.
     *
     * @param Sprawozdanie|null $sprawozdanie
     */
    public function __construct(?Sprawozdanie $sprawozdanie = null)
    {
        if (null !== $sprawozdanie) {
            $this->sprawozdanie = $sprawozdanie;
        }
    }

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
     * Zwraca iwartość dentyfikatora.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Ustala wartość identyfikatora.
     *
     * @param int  $id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Zwraca wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @return Sprawozdanie
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }

    /**
     * Ustala wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @param Sprawozdanie  $sprawozdanie
     *
     * @return self
     */
    public function setSprawozdanie(Sprawozdanie $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczekod 301.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return self
     */
    public function setLiczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }
}
