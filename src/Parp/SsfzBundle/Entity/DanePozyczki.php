<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe;
use Parp\SsfzBundle\Helper\MoneyHelper;

/**
 * Pożyczkach dla SPO WKP 1.2.1.
 *
 * Uwaga!
 * Dane w formacie decimal (po stronie bazy danych) są przez Doctrine mapowane na typ PHP "string",
 * a nie na "float". Unika się w ten sposób utraty precyzji.
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/2.9/reference/types.html#decimal
 *
 * @ORM\Table(name="sfz_dane_pozyczek")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\DanePozyczkiRepository")
 *
 * @see bin/phpunit --configuration ./tests/phpunit.xml --no-coverage --bootstrap ./vendor/autoload.php tests/Parp/SsfzBundle/Entity/DanePozyczkiTest
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
     * @var SprawozdaniePozyczkowe
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePozyczkowe")
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

    /**
     * Liczba pożyczek obrotowych do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_do_10000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychDo10000Pln = 0;

    /**
     * Liczba pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_od_10001_do_30000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychOd10001Do30000Pln = 0;

    /**
     * Liczba pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_od_30001_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychOd30001Do50000Pln = 0;

    /**
     * Liczba pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_od_50001_do_120000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychOd50001Do120000Pln = 0;

    /**
     * Liczba pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_od_120001_do_300000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychOd120001Do300000Pln = 0;

    /**
     * Liczba pożyczek obrotowych od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_obrotowych_od_300001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek obrotowych od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekObrotowychOd300001Pln = 0;

    /**
     * Liczba pożyczek inwestycyjnych do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_do_10000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychDo10000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjnych od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_od_10001_do_30000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychOd10001Do30000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_od_30001_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychOd30001Do50000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_od_50001_do_120000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychOd50001Do120000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_od_120001_do_300000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychOd120001Do300000Pln = 0;
    
    /**
     * Liczba pożyczek inwestycyjnych od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjnych_od_300001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjnych od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnychOd300001Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_do_10000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychDo10000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_od_10001_do_30000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_od_30001_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_od_50001_do_120000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_od_120001_do_300000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = 0;

    /**
     * Liczba pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_inwestycyjno_obrotowych_od_300001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek inwestycyjno-obrotowych od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekInwestycyjnoObrotowychOd300001Pln = 0;

    /**
     * Liczba pożyczek na działania produkcyjne do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba pożyczek na działania produkcyjne od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne = 0;
   
    /**
     * Liczba pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba pożyczek na działania produkcyjne od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania produkcyjne od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba pożyczek na działania handlowe do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania handlowe od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania handlowe od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba pożyczek na działania usługowe do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania usługowe od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania usługowe od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba pożyczek na działania budownicze do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania budownicze od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania budownicze od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania rolnicze od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_rolnicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania rolnicze od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaRolnicze = 0;

    /**
     * Liczba pożyczek na działania inne do 10.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne do 10.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnNaDzialaniaInne = 0;

    /**
     * Liczba pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne od 10.001zł do 30.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne = 0;

    /**
     * Liczba pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne od 30.001zł do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne = 0;

    /**
     * Liczba pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne od 50.001zł do 120.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne = 0;

    /**
     * Liczba pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_120001_do_300000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne od 120.001zł do 300.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne = 0;

    /**
     * Liczba pożyczek na działania inne od 301.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_dzial_rinne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek na działania inne od 301.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnNaDzialaniaInne = 0;

    /**
     * Kwota pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek do 10.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )ewewe
     */
    protected $kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 301.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek do 10.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = '0.00';
    
    /**
     * Kwota pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 301.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek do 10.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 301.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek do 10.000zł dla innych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 30.001zł do 50.000zł dla innych_przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 120.001zł do 300.000zł dla inne przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_inne_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 301.000zł dla innych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = '0.00';

    /**
     * Kwota pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek do 10.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_inst_ekonomii_spol",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek od 301.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = '0.00';

    /**
     * Kwota pożyczek obrotowych do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_do_10000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychDo10000Pln = '0.00';

    /**
     * Kwota pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_od_10001_do_30000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychOd10001Do30000Pln = '0.00';

   /**
     * Kwota pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_od_30001_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychOd30001Do50000Pln = '0.00';

   /**
     * Kwota pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_od_50001_do_120000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychOd50001Do120000Pln = '0.00';

    /**
     * Kwota pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_od_120001_do_300000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychOd120001Do300000Pln = '0.00';

    /**
     * Kwota pożyczek obrotowych od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_obrotowych_od_300001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek obrotowych od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekObrotowychOd300001Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjnych do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_do_10000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychDo10000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjnych od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_od_10001_do_30000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychOd10001Do30000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_od_30001_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychOd30001Do50000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_od_50001_do_120000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychOd50001Do120000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_od_120001_do_300000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychOd120001Do300000Pln = '0.00';
    
    /**
     * Kwota pożyczek inwestycyjnych od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjnych_od_300001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjnych od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnychOd300001Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_do_10000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychDo10000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_od_10001_do_30000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_od_30001_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_od_50001_do_120000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_od_120001_do_300000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = '0.00';

    /**
     * Kwota pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_inwestycyjno_obrotowych_od_300001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek inwestycyjno-obrotowych od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekInwestycyjnoObrotowychOd300001Pln = '0.00';

    /**
     * Kwota pożyczek na działania produkcyjne do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota pożyczek na działania produkcyjne od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne = '0.00';
   
    /**
     * Kwota pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota pożyczek na działania produkcyjne od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania produkcyjne od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota pożyczek na działania handlowe do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania handlowe od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania handlowe od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania usługowe od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania usługowe od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota pożyczek na działania budownicze do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania budownicze od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania budownicze od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania rolnicze od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_rolnicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania rolnicze od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaRolnicze = '0.00';

    /**
     * Kwota pożyczek na działania inne do 10.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_do_10000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne do 10.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekDo10000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_10001_do_30000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne od 10.001zł do 30.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_30001_do_50000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne od 30.001zł do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_50001_do_120000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne od 50.001zł do 120.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_120001_do_300000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne od 120.001zł do 300.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota pożyczek na działania inne od 301.000zł.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_od_300001_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek na działania inne od 301.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPozyczekOd300001PlnNaDzialaniaInne = '0.00';

































    /**
     * Liczba pożyczek aktywnych ogółem.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_aktywnych_ogolem",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek aktywnych ogółem.",
     *         "default":0
     *     }
     * )
     */
    public $liczbaPozyczekAktywnychOgolem = 0;

    /**
     * Liczba pożyczek aktywnych spłacanych terminowo.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_aktywnych_splacanych_terminowo",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek aktywnych spłacanych terminowo.",
     *         "default":0
     *     }
     * )
     */
    public $liczbaPozyczekAktywnychSplacanychTerminowo = 0;

    /**
     * Liczba pożyczek aktywnych wymagających monitorowania.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_aktywnych_wymagajacych_monitorowania",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek aktywnych wymagających monitorowania.",
     *         "default":0
     *     }
     * )
     */
    public $liczbaPozyczekAktywnychWymagajacychMonitorowania = 0;

    /**
     * Liczba pożyczek straconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_straconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek straconych.",
     *         "default":0
     *     }
     * )
     */
    public $liczbaPozyczekStraconych = 0;

    /**
     * Kwota pożyczek aktywnych ogółem (PLN).
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_aktywnych_ogolem",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek aktywnych ogółem (PLN).",
     *         "default":0.00
     *     }
     * )
     */
    public $kwotaPozyczekAktywnychOgolem = '0.00';

    /**
     * Kwota pożyczek aktywnych spłacanych terminowo (PLN).
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_aktywnych_splacanych_terminowo",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek aktywnych spłacanych terminowo (PLN).",
     *         "default":0.00
     *     }
     * )
     */
    public $kwotaPozyczekAktywnychSplacanychTerminowo = '0.00';

    /**
     * Kwota pożyczek aktywnych wymagających szczególnego monitorowania (PLN).
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_aktywnych_wymagajacych_monitorowania",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek aktywnych wymagających szczególnego monitorowania (PLN).",
     *         "default":0.00
     *     }
     * )
     */
    public $kwotaPozyczekAktywnychWymagajacychMonitorowania = '0.00';

    /**
     * Kwota pożyczek straconych (PLN).
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_poz_straconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pożyczek straconych (PLN).",
     *         "default":0.00
     *     }
     * )
     */
    public $kwotaPozyczekStraconych = '0.00';

    /**
     * Współczynnik strat w danym okresie wg liczby pożyczek.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="wspolczynnik_strat_w_danym_okresie_wg_liczby_poz",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Współczynnik strat w danym okresie wg liczby pożyczek.",
     *         "default":0.00
     *     }
     * )
     */
    public $wspolczynnikStratWDanymOkresieWgLiczbyPozyczek = '0.00';

    /**
     * Współczynnik strat w całym okresie wg liczby pożyczek.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="wspolczynnik_strat_w_calym_okresie_wg_liczby_poz",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Współczynnik strat w całym okresie wg liczby pożyczek.",
     *         "default":0.00
     *     }
     * )
     */
    public $wspolczynnikStratWCalymOkresieWgLiczbyPozyczek = '0.00';

    /**
     * Współczynnik strat w danym okresie wg kwoty pożyczek.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="wspolczynnik_strat_w_danym_okresie_wg_kwoty_poz",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Współczynnik strat w danym okresie wg kwoty pożyczek.",
     *         "default":0.00
     *     }
     * )
     */
    public $wspolczynnikStratWDanymOkresieWgKwotyPozyczek = '0.00';

    /**
     * Współczynnik strat w całym okresie wg kwoty pożyczek.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="wspolczynnik_strat_w_calym_okresie_wg_kwoty_poz",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Współczynnik strat w całym okresie wg kwoty pożyczek.",
     *         "default":0.00
     *     }
     * )
     */
    public $wspolczynnikStratWCalymOkresieWgKwotyPozyczek = '0.00';
































    /**
     * Konstruktor.
     *
     * @param SprawozdaniePozyczkowe|null $sprawozdanie
     */
    public function __construct(?SprawozdaniePozyczkowe $sprawozdanie = null)
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
     * Zwraca wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @return SprawozdaniePozyczkowe
     */
    public function getSprawozdanie()
    {
        return $this->sprawozdanie;
    }

    /**
     * Ustala wartość sprawozdania, do którego przypisano dane pożyczki.
     *
     * @param SprawozdaniePozyczkowe $sprawozdanie
     *
     * @return DanePozyczki
     */
    public function setSprawozdanie(SprawozdaniePozyczkowe $sprawozdanie)
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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

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
     * Ustala wartość liczby pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychDo10000Pln()
    {
        return $this->liczbaPozyczekObrotowychDo10000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychDo10000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychDo10000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOd10001Do30000Pln()
    {
        return $this->liczbaPozyczekObrotowychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychOd10001Do30000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychOd10001Do30000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOd30001Do50000Pln()
    {
        return $this->liczbaPozyczekObrotowychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychOd30001Do50000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychOd30001Do50000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOd50001Do120000Pln()
    {
        return $this->liczbaPozyczekObrotowychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychOd50001Do120000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychOd50001Do120000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOd120001Do300000Pln()
    {
        return $this->liczbaPozyczekObrotowychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychOd120001Do300000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychOd120001Do300000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOd300001Pln()
    {
        return $this->liczbaPozyczekObrotowychOd300001Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekObrotowychOd300001Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekObrotowychOd300001Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychDo10000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychDo10000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychDo10000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychDo10000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOd10001Do30000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychOd10001Do30000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychOd10001Do30000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOd30001Do50000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychOd30001Do50000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychOd30001Do50000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOd50001Do120000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychOd50001Do120000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychOd50001Do120000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOd120001Do300000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychOd120001Do300000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychOd120001Do300000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOd300001Pln()
    {
        return $this->liczbaPozyczekInwestycyjnychOd300001Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjnych od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnychOd300001Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnychOd300001Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychDo10000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychDo10000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychDo10000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychDo10000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOd300001Pln()
    {
        return $this->liczbaPozyczekInwestycyjnoObrotowychOd300001Pln;
    }

    /**
     * Ustala wartość liczby pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekInwestycyjnoObrotowychOd300001Pln(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekInwestycyjnoObrotowychOd300001Pln = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania produkcyjne od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania handlowe od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaHandlowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaHandlowe = abs($liczbaPozyczek);

        return $this;
    }







    /**
     * Zwraca wartość liczby pożyczek na działania usługowe do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby pożyczek na działania usługowe od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaUslugowe(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaUslugowe = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania budownicze od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaBudownicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaBudownicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaRolnicze()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość liczby pożyczek na działania rolnicze od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaRolnicze(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaRolnicze = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne do 10.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekDo10000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne do 10.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 301.000zł.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnNaDzialaniaInne()
    {
        return $this->liczbaPozyczekOd300001PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby pożyczek na działania inne od 301.000zł.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnNaDzialaniaInne(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnNaDzialaniaInne = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek do 10.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 10.001zł do 30.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 30.001zł do 50.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 50.001zł do 120.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 120.001zł do 300.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 301.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek do 10.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 10.001zł do 30.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 30.001zł do 50.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 50.001zł do 120.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 120.001zł do 300.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 301.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek do 10.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 10.001zł do 30.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 30.001zł do 50.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 50.001zł do 120.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 120.001zł do 300.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->kwotaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->kwotaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość kwoty pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychDo10000Pln()
    {
        return $this->kwotaPozyczekObrotowychDo10000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychDo10000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychDo10000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOd10001Do30000Pln()
    {
        return $this->kwotaPozyczekObrotowychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych od 10.001zł do30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychOd10001Do30000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychOd10001Do30000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOd30001Do50000Pln()
    {
        return $this->kwotaPozyczekObrotowychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychOd30001Do50000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychOd30001Do50000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOd50001Do120000Pln()
    {
        return $this->kwotaPozyczekObrotowychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychOd50001Do120000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychOd50001Do120000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOd120001Do300000Pln()
    {
        return $this->kwotaPozyczekObrotowychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychOd120001Do300000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychOd120001Do300000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOd300001Pln()
    {
        return $this->kwotaPozyczekObrotowychOd300001Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekObrotowychOd300001Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekObrotowychOd300001Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek obrotowych do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychDo10000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychDo10000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek obrotowych do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychDo10000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychDo10000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOd10001Do30000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychOd10001Do30000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychOd10001Do30000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOd30001Do50000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjnych od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychOd30001Do50000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychOd30001Do50000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOd50001Do120000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjnych od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychOd50001Do120000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychOd50001Do120000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOd120001Do300000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjnych od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychOd120001Do300000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychOd120001Do300000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjnych od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOd300001Pln()
    {
        return $this->kwotaPozyczekInwestycyjnychOd300001Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjnych od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnychOd300001Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnychOd300001Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychDo10000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychDo10000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychDo10000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychDo10000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOd300001Pln()
    {
        return $this->kwotaPozyczekInwestycyjnoObrotowychOd300001Pln;
    }

    /**
     * Ustala wartość kwoty pożyczek inwestycyjno-obrotowych od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekInwestycyjnoObrotowychOd300001Pln(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekInwestycyjnoObrotowychOd300001Pln = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania produkcyjne od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania produkcyjne od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe od 10.001zł do 30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania handlowe od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania handlowe od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaHandlowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }







    /**
     * Zwraca wartość liczby pożyczek na działania usługowe do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe od 10.001zł do 30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania usługowe od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania usługowe od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaUslugowe(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze od 10.001zł do 30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania budownicze od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania budownicze od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaBudownicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze od 10.001zł do 30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania rolnicze od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaRolnicze()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaRolnicze;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania rolnicze od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaRolnicze(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaRolnicze = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne do 10.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekDo10000PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekDo10000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne do 10.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekDo10000PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekDo10000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd10001Do30000PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne od 10.001zł do 30.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd10001Do30000PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd30001Do50000PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne od 30.001zł do 50.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd30001Do50000PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd50001Do120000PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne od 50.001zł do 120.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd50001Do120000PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd120001Do300000PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne od 120.001zł do 300.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd120001Do300000PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek na działania inne od 301.000zł.
     *
     * @return string
     */
    public function getKwotaPozyczekOd300001PlnNaDzialaniaInne()
    {
        return $this->kwotaPozyczekOd300001PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty pożyczek na działania inne od 301.000zł.
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekOd300001PlnNaDzialaniaInne(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekOd300001PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }





















































    /**
     * Zwraca liczbę pożyczek ogółem dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDlaMikroPrzedsiebiorstwOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw +
            $this->liczbaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw +
            $this->liczbaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw +
            $this->liczbaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw +
            $this->liczbaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw +
            $this->liczbaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek ogółem dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDlaMalychPrzedsiebiorstwOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw +
            $this->liczbaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw +
            $this->liczbaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw +
            $this->liczbaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw +
            $this->liczbaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw +
            $this->liczbaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek ogółem dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDlaSrednichPrzedsiebiorstwOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw +
            $this->liczbaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw +
            $this->liczbaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw +
            $this->liczbaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw +
            $this->liczbaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw +
            $this->liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek ogółem dla wszystkich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDlaPrzedsiebiorstwOgolem(): int
    {
        $sum =
            $this->getLiczbaPozyczekDlaMikroPrzedsiebiorstwOgolem() +
            $this->getLiczbaPozyczekDlaMalychPrzedsiebiorstwOgolem() +
            $this->getLiczbaPozyczekDlaSrednichPrzedsiebiorstwOgolem()
        ;

        return $sum;
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDlaMikroPrzedsiebiorstwOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnDlaMikroPrzedsiebiorstw +
            $this->kwotaPozyczekOd10001Do30000PlnDlaMikroPrzedsiebiorstw +
            $this->kwotaPozyczekOd30001Do50000PlnDlaMikroPrzedsiebiorstw +
            $this->kwotaPozyczekOd50001Do120000PlnDlaMikroPrzedsiebiorstw +
            $this->kwotaPozyczekOd120001Do300000PlnDlaMikroPrzedsiebiorstw +
            $this->kwotaPozyczekOd300001PlnDlaMikroPrzedsiebiorstw
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDlaMalychPrzedsiebiorstwOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnDlaMalychPrzedsiebiorstw +
            $this->kwotaPozyczekOd10001Do30000PlnDlaMalychPrzedsiebiorstw +
            $this->kwotaPozyczekOd30001Do50000PlnDlaMalychPrzedsiebiorstw +
            $this->kwotaPozyczekOd50001Do120000PlnDlaMalychPrzedsiebiorstw +
            $this->kwotaPozyczekOd120001Do300000PlnDlaMalychPrzedsiebiorstw +
            $this->kwotaPozyczekOd300001PlnDlaMalychPrzedsiebiorstw
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDlaSrednichPrzedsiebiorstwOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnDlaSrednichPrzedsiebiorstw +
            $this->kwotaPozyczekOd10001Do30000PlnDlaSrednichPrzedsiebiorstw +
            $this->kwotaPozyczekOd30001Do50000PlnDlaSrednichPrzedsiebiorstw +
            $this->kwotaPozyczekOd50001Do120000PlnDlaSrednichPrzedsiebiorstw +
            $this->kwotaPozyczekOd120001Do300000PlnDlaSrednichPrzedsiebiorstw +
            $this->kwotaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla wszystkich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPozyczekDlaPrzedsiebiorstwOgolem(): string
    {
        $sum =
            $this->getKwotaPozyczekDlaMikroPrzedsiebiorstwOgolem() +
            $this->getKwotaPozyczekDlaMalychPrzedsiebiorstwOgolem() +
            $this->getKwotaPozyczekDlaSrednichPrzedsiebiorstwOgolem()
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca liczbę pożyczek obrotowych ogółem.
     *
     * @return int
     */
    public function getLiczbaPozyczekObrotowychOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekObrotowychDo10000Pln +
            $this->liczbaPozyczekObrotowychOd10001Do30000Pln +
            $this->liczbaPozyczekObrotowychOd30001Do50000Pln +
            $this->liczbaPozyczekObrotowychOd50001Do120000Pln +
            $this->liczbaPozyczekObrotowychOd120001Do300000Pln +
            $this->liczbaPozyczekObrotowychOd300001Pln
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek inwestycyjnych ogółem.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnychOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekInwestycyjnychDo10000Pln +
            $this->liczbaPozyczekInwestycyjnychOd10001Do30000Pln +
            $this->liczbaPozyczekInwestycyjnychOd30001Do50000Pln +
            $this->liczbaPozyczekInwestycyjnychOd50001Do120000Pln +
            $this->liczbaPozyczekInwestycyjnychOd120001Do300000Pln +
            $this->liczbaPozyczekInwestycyjnychOd300001Pln
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek inwestycyjno-obrotowych ogółem.
     *
     * @return int
     */
    public function getLiczbaPozyczekInwestycyjnoObrotowychOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekInwestycyjnoObrotowychDo10000Pln +
            $this->liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln +
            $this->liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln +
            $this->liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln +
            $this->liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln +
            $this->liczbaPozyczekInwestycyjnoObrotowychOd300001Pln
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek ogółem dla wszystkich przeznaczeń.
     *
     * @return int
     */
    public function getLiczbaPozyczekDlaWszystkichPrzeznaczenOgolem(): int
    {
        $sum =
            $this->getLiczbaPozyczekObrotowychOgolem() +
            $this->getLiczbaPozyczekInwestycyjnychOgolem() +
            $this->getLiczbaPozyczekInwestycyjnoObrotowychOgolem()
        ;

        return $sum;
    }

    /**
     * Zwraca kwotę pożyczek obrotowych ogółem.
     *
     * @return string
     */
    public function getKwotaPozyczekObrotowychOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekObrotowychDo10000Pln +
            $this->kwotaPozyczekObrotowychOd10001Do30000Pln +
            $this->kwotaPozyczekObrotowychOd30001Do50000Pln +
            $this->kwotaPozyczekObrotowychOd50001Do120000Pln +
            $this->kwotaPozyczekObrotowychOd120001Do300000Pln +
            $this->kwotaPozyczekObrotowychOd300001Pln
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek inwestycyjnych ogółem.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnychOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekInwestycyjnychDo10000Pln +
            $this->kwotaPozyczekInwestycyjnychOd10001Do30000Pln +
            $this->kwotaPozyczekInwestycyjnychOd30001Do50000Pln +
            $this->kwotaPozyczekInwestycyjnychOd50001Do120000Pln +
            $this->kwotaPozyczekInwestycyjnychOd120001Do300000Pln +
            $this->kwotaPozyczekInwestycyjnychOd300001Pln
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek inwestycyjno-obrotowych ogółem.
     *
     * @return string
     */
    public function getKwotaPozyczekInwestycyjnoObrotowychOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekInwestycyjnoObrotowychDo10000Pln +
            $this->kwotaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln +
            $this->kwotaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln +
            $this->kwotaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln +
            $this->kwotaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln +
            $this->kwotaPozyczekInwestycyjnoObrotowychOd300001Pln
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla wszystkich przeznaczeń.
     *
     * @return string
     */
    public function getKwotaPozyczekDlaWszystkichPrzeznaczenOgolem(): string
    {
        $sum =
            $this->getKwotaPozyczekObrotowychOgolem() +
            $this->getKwotaPozyczekInwestycyjnychOgolem() +
            $this->getKwotaPozyczekInwestycyjnoObrotowychOgolem()
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w sektorze produkcyjnym.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaProdykcyjneOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w sektorze handlowym.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaHandloweOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaHandlowe +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaHandlowe
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w sektorze usługowy.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaUslugoweOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaUslugowe +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaUslugowe
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w sektorze budowniczym.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaBudowniczeOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaBudownicze +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaBudownicze
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w sektorze rolniczym.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaRolniczeOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaRolnicze +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaRolnicze
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek na działania pożyczkobiorcy w innych sektorach.
     *
     * @return int
     */
    public function getLiczbaPozyczekNaDzialaniaInneOgolem(): int
    {
        $sum =
            $this->liczbaPozyczekDo10000PlnNaDzialaniaInne +
            $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne +
            $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne +
            $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne +
            $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne +
            $this->liczbaPozyczekOd300001PlnNaDzialaniaInne
        ;

        return $sum;
    }

    /**
     * Zwraca liczbę pożyczek ogółem dla wszystkich sektorów działań pożyczkobiorcy.
     *
     * @return int
     */
    public function getLiczbaPozyczekOgolemDlaWszystkichSektorowDzialan(): int
    {
        $sum =
            $this->getLiczbaPozyczekNaDzialaniaProdykcyjneOgolem() +
            $this->getLiczbaPozyczekNaDzialaniaHandloweOgolem() +
            $this->getLiczbaPozyczekNaDzialaniaUslugoweOgolem() +
            $this->getLiczbaPozyczekNaDzialaniaBudowniczeOgolem() +
            $this->getLiczbaPozyczekNaDzialaniaRolniczeOgolem() +
            $this->getLiczbaPozyczekNaDzialaniaInneOgolem()
        ;

        return $sum;
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w sektorze produkcyjnym.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaProdykcyjneOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaProdukcyjne +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaProdukcyjne
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w sektorze handlowym.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaHandloweOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaHandlowe +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaHandlowe
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w sektorze usługowy.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaUslugoweOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaUslugowe +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaUslugowe
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w sektorze budowniczym.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaBudowniczeOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaBudownicze +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaBudownicze
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w sektorze rolniczym.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaRolniczeOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaRolnicze +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaRolnicze
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek na działania pożyczkobiorcy w innych sektorach.
     *
     * @return string
     */
    public function getKwotaPozyczekNaDzialaniaInneOgolem(): string
    {
        $sum =
            $this->kwotaPozyczekDo10000PlnNaDzialaniaInne +
            $this->kwotaPozyczekOd10001Do30000PlnNaDzialaniaInne +
            $this->kwotaPozyczekOd30001Do50000PlnNaDzialaniaInne +
            $this->kwotaPozyczekOd50001Do120000PlnNaDzialaniaInne +
            $this->kwotaPozyczekOd120001Do300000PlnNaDzialaniaInne +
            $this->kwotaPozyczekOd300001PlnNaDzialaniaInne
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca kwotę pożyczek ogółem dla wszystkich sektorów działań pożyczkobiorcy.
     *
     * @return string
     */
    public function getKwotaPozyczekOgolemDlaWszystkichSektorowDzialan(): string
    {
        $sum =
            $this->getKwotaPozyczekNaDzialaniaProdykcyjneOgolem() +
            $this->getKwotaPozyczekNaDzialaniaHandloweOgolem() +
            $this->getKwotaPozyczekNaDzialaniaUslugoweOgolem() +
            $this->getKwotaPozyczekNaDzialaniaBudowniczeOgolem() +
            $this->getKwotaPozyczekNaDzialaniaRolniczeOgolem() +
            $this->getKwotaPozyczekNaDzialaniaInneOgolem()
        ;

        return MoneyHelper::anyToDecimalString($sum, 2, true);
    }

    /**
     * Zwraca wartość liczby pożyczek aktywnych ogółem.
     *
     * @return int
     */
    public function getLiczbaPozyczekAktywnychOgolem()
    {
        return $this->liczbaPozyczekAktywnychOgolem;
    }

    /**
     * Ustala wartość liczby pożyczek aktywnych ogółem.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekAktywnychOgolem(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekAktywnychOgolem = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek aktywnych spłacanych terminowo.
     *
     * @return int
     */
    public function getLiczbaPozyczekAktywnychSplacanychTerminowo()
    {
        return $this->liczbaPozyczekAktywnychSplacanychTerminowo;
    }

    /**
     * Ustala wartość liczby pożyczek aktywnych spłacanych terminowo.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekAktywnychSplacanychTerminowo(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekAktywnychSplacanychTerminowo = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek aktywnych wymagających monitorowania.
     *
     * @return int
     */
    public function getLiczbaPozyczekAktywnychWymagajacychMonitorowania()
    {
        return $this->liczbaPozyczekAktywnychWymagajacychMonitorowania;
    }

    /**
     * Ustala wartość liczby pożyczek aktywnych wymagających monitorowania.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekAktywnychWymagajacychMonitorowania(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekAktywnychWymagajacychMonitorowania = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek straconych.
     *
     * @return int
     */
    public function getLiczbaPozyczekStraconych()
    {
        return $this->liczbaPozyczekStraconych;
    }

    /**
     * Ustala wartość liczby pożyczek straconych.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekStraconych(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekStraconych = abs($liczbaPozyczek);

        return $this;
    }

    /**
     * Zwraca wartość kwoty pożyczek aktywnych ogółem (PLN).
     *
     * @return string
     */
    public function getKwotaPozyczekAktywnychOgolem()
    {
        return $this->kwotaPozyczekAktywnychOgolem;
    }

    /**
     * Ustala wartość kwoty pożyczek aktywnych ogółem (PLN).
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekAktywnychOgolem(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekAktywnychOgolem = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość kwoty pożyczek aktywnych spłacanych terminowo (PLN).
     *
     * @return string
     */
    public function getKwotaPozyczekAktywnychSplacanychTerminowo()
    {
        return $this->kwotaPozyczekAktywnychSplacanychTerminowo;
    }

    /**
     * Ustala wartość kwoty pożyczek aktywnych spłacanych terminowo (PLN).
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekAktywnychSplacanychTerminowo(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekAktywnychSplacanychTerminowo = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość kwoty pożyczek aktywnych wymagających szczególnego monitorowania (PLN).
     *
     * @return string
     */
    public function getKwotaPozyczekAktywnychWymagajacychMonitorowania()
    {
        return $this->kwotaPozyczekAktywnychWymagajacychMonitorowania;
    }

    /**
     * Ustala wartość kwoty pożyczek aktywnych wymagających szczególnego monitorowania (PLN).
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekAktywnychWymagajacychMonitorowania(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekAktywnychWymagajacychMonitorowania = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość kwoty pożyczek straconych (PLN).
     *
     * @return string
     */
    public function getKwotaPozyczekStraconych()
    {
        return $this->kwotaPozyczekStraconych;
    }

    /**
     * Ustala wartość kwoty pożyczek straconych (PLN).
     *
     * @param string $kwotaPozyczek
     *
     * @return DanePozyczki
     */
    public function setKwotaPozyczekStraconych(string $kwotaPozyczek = '0.00')
    {
        $this->kwotaPozyczekStraconych = MoneyHelper::anyToDecimalString($kwotaPozyczek, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość współczynnika strat w danym okresie wg liczby pożyczek.
     *
     * @return string
     */
    public function getWspolczynnikStratWDanymOkresieWgLiczbyPozyczek()
    {
        return $this->wspolczynnikStratWDanymOkresieWgLiczbyPozyczek;
    }

    /**
     * Ustala wartość współczynnika strat w danym okresie wg liczby pożyczek.
     *
     * @param string $wspolczynnik
     *
     * @return DanePozyczki
     */
    public function setWspolczynnikStratWDanymOkresieWgLiczbyPozyczek(string $wspolczynnik = '0.00')
    {
        $this->wspolczynnikStratWDanymOkresieWgLiczbyPozyczek = MoneyHelper::anyToDecimalString($wspolczynnik, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość współczynnika strat w całym okresie wg liczby pożyczek.
     *
     * @return string
     */
    public function getWspolczynnikStratWCalymOkresieWgLiczbyPozyczek()
    {
        return $this->wspolczynnikStratWCalymOkresieWgLiczbyPozyczek;
    }

    /**
     * Ustala wartość współczynnika strat w całym okresie wg liczby pożyczek.
     *
     * @param string $wspolczynnik
     *
     * @return DanePozyczki
     */
    public function setWspolczynnikStratWCalymOkresieWgLiczbyPozyczek(string $wspolczynnik = '0.00')
    {
        $this->wspolczynnikStratWCalymOkresieWgLiczbyPozyczek = MoneyHelper::anyToDecimalString($wspolczynnik, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość współczynnika strat w danym okresie wg kwoty pożyczek.
     *
     * @return string
     */
    public function getWspolczynnikStratWDanymOkresieWgKwotyPozyczek()
    {
        return $this->wspolczynnikStratWDanymOkresieWgKwotyPozyczek;
    }

    /**
     * Ustala wartość współczynnika strat w danym okresie wg kwoty pożyczek.
     *
     * @param string $wspolczynnik
     *
     * @return DanePozyczki
     */
    public function setWspolczynnikStratWDanymOkresieWgKwotyPozyczek(string $wspolczynnik = '0.00')
    {
        $this->wspolczynnikStratWDanymOkresieWgKwotyPozyczek = MoneyHelper::anyToDecimalString($wspolczynnik, 2, true);

        return $this;
    }

    /**
     * Zwraca wartość współczynnika strat w całym okresie wg kwoty pożyczek.
     *
     * @return string
     */
    public function getWspolczynnikStratWCalymOkresieWgKwotyPozyczek()
    {
        return $this->wspolczynnikStratWCalymOkresieWgKwotyPozyczek;
    }

    /**
     * Ustala wartość współczynnika strat w całym okresie wg kwoty pożyczek.
     *
     * @param string $wspolczynnik
     *
     * @return DanePozyczki
     */
    public function setWspolczynnikStratWCalymOkresieWgKwotyPozyczek(string $wspolczynnik = '0.00')
    {
        $this->wspolczynnikStratWCalymOkresieWgKwotyPozyczek = MoneyHelper::anyToDecimalString($wspolczynnik, 2, true);

        return $this;
    }
}
