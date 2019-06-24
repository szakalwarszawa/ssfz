<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe;
use Parp\SsfzBundle\Helper\MoneyHelper;

/**
 * Dane poręczeń do sprawozdania dla SPO WKP 1.2.2.
 *
 * Uwaga!
 * Dane w formacie decimal (po stronie bazy danych) są przez Doctrine mapowane na typ PHP "string",
 * a nie na "float". Unika się w ten sposób utraty precyzji.
 * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/2.9/reference/types.html#decimal
 *
 * @ORM\Table(name="sfz_dane_poreczen")
 * @ORM\Entity(repositoryClass="Parp\SsfzBundle\Repository\DanePoreczenRepository")
 *
 * @see bin/phpunit --configuration ./tests/phpunit.xml --no-coverage --bootstrap ./vendor/autoload.php tests/Parp/SsfzBundle/Entity/DanePoreczenTest
 */
class DanePoreczen
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
     * @var SprawozdaniePoreczeniowe
     *
     * @ORM\ManyToOne(targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe")
     * @ORM\JoinColumn(name="sprawozdanie_id", referencedColumnName="id", nullable=false)
     */
    protected $sprawozdanie;

    /**
     * Liczba poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 50.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50000_do_100000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 100.001zł do 500.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_mikro_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_malych_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 50.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50000_do_100000_pln_malych_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_malych_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_malych_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń powyżej 500.000zł dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_srednich_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 50.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_srednich_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_obrotowy_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt obrotowy do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytObrotowyDo50000Pln = 0;

    /**
     * Liczba poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_obrotowy_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytObrotowyOd50001Do100000Pln = 0;

    /**
     * Liczba poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_obrotowy_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytObrotowyOd100001Do500000Pln = 0;

    /**
     * Liczba poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_obrotowy_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt obrotowy powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytObrotowyOd500001Pln = 0;

    /**
     * Liczba poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_inwestycyjny_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt inwestycyjny do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytInwestycyjnyDo50000Pln = 0;

    /**
     * Liczba poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_inwestycyjny_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln = 0;

    /**
     * Liczba poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_inwestycyjny_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln = 0;

    /**
     * Liczba poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_kredyt_inwestycyjny_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na kredyt inwestycyjny powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaKredytInwestycyjnyOd500001Pln = 0;

    /**
     * Liczba poręczeń na pożyczkę obrotową do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_obrotowa_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pożyczkę obrotową do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeObrotowaDo50000Pln = 0;

    /**
     * Liczba poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_obrotowa_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln = 0;

    /**
     * Liczba poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_obrotowa_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln = 0;

    /**
     * Liczba poręczeń na pożyczkę obrotową powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_obrotowa_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pożyczkę obrotową powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeObrotowaOd500001Pln = 0;

    /**
     * Liczba poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_inwestycyjna_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pozyczkę inwestycyjną do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln = 0;

    /**
     * Liczba poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_inwestycyjna_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln = 0;

    /**
     * Liczba poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_inwestycyjna_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln = 0;

    /**
     * Liczba poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_na_pozyczke_inwestycyjna_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln = 0;

    /**
     * Liczba pozostałych poręczeń do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychDo50000Pln = 0;

    /**
     * Liczba pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychOd50001Do100000Pln = 0;

    /**
     * Liczba pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychOd100001Do500000Pln = 0;

    /**
     * Liczba pozostałych poręczeń powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychOd500001Pln = 0;

    /**
     * Liczba wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_do_50000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów w pozostałych poręczeniach do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychDo50000Pln = 0;

    /**
     * Liczba wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_od_50001_do_100000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychOd50001Do100000Pln = 0;

    /**
     * Liczba wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_od_100001_do_500000_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychOd100001Do500000Pln = 0;

    /**
     * Liczba wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_od_500001_pln",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów w pozostałych poręczeniach powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychOd500001Pln = 0;

    /**
     * Liczba poręczeń na działania produkcyjne do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania produkcyjne do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania produkcyjne od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania produkcyjne od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania produkcyjne powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne = 0;

















































    /**
     * Liczba współpracujących banków.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wspolpracujacych_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba współpracujących banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWspolpracujacychBankow = 0;

    /**
     * Liczba współpracujących funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wspolpracujacych_funduszy_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba współpracujących funduszy pożyczkowych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWspolpracujacychFunduszyPozyczkowych = 0;

    /**
     * Liczba innych podmiotów współpracujących.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_innych_podmiotow_wspolpracujacych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba innych podmiotów współpracujących.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaInnychPodmiotowWspolpracujacych = 0;

    /**
     * Konstruktor.
     *
     * @param SprawozdaniePoreczeniowe|null $sprawozdanie
     */
    public function __construct(?SprawozdaniePoreczeniowe $sprawozdanie = null)
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
     * @return DanePozyczek
     */
    public function setSprawozdanie(SprawozdaniePozyczkowe $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Zwraca wartość liczby współpracujących banków.
     *
     * @return int
     */
    public function getLiczbaWspolpracujacychBankow()
    {
        return $this->liczbaWspolpracujacychBankow;
    }

    /**
     * Ustala wartość liczby współpracujących banków.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaWspolpracujacychBankow(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaWspolpracujacychBankow = abs($liczbaWspolpracujacych);

        return $this;
    }

    /**
     * Zwraca wartość liczby współpracujących funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaWspolpracujacychFunduszyPozyczkowych()
    {
        return $this->liczbaWspolpracujacychFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby współpracujących funduszy pożyczkowych.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaWspolpracujacychFunduszyPozyczkowych(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaWspolpracujacychFunduszyPozyczkowych = abs($liczbaWspolpracujacych);

        return $this;
    }

    /**
     * Zwraca wartość liczby innych podmiotów współpracujących.
     *
     * @return int
     */
    public function getLiczbaInnychPodmiotowWspolpracujacych()
    {
        return $this->liczbaInnychPodmiotowWspolpracujacych;
    }

    /**
     * Ustala wartość liczby innych podmiotów współpracujących.
     *
     * @param int $liczbaWspolpracujacych
     *
     * @return DanePoreczen
     */
    public function setLiczbaInnychPodmiotowWspolpracujacych(int $liczbaWspolpracujacych = 0)
    {
        $this->liczbaInnychPodmiotowWspolpracujacych = abs($liczbaWspolpracujacych);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo50000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekDo50000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do100000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd50001Do100000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd100001Do500000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd100001Do500000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd500001PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd500001PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo50000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekDo50000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do100000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd50001Do100000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd100001Do500000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd100001Do500000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd500001PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd500001PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo50000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekDo50000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do100000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd100001Do500000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd500001PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPozyczekOd500001PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytObrotowyDo50000Pln()
    {
        return $this->liczbaPoreczenNaKredytObrotowyDo50000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytObrotowyDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytObrotowyDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytObrotowyOd50001Do100000Pln()
    {
        return $this->liczbaPoreczenNaKredytObrotowyOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytObrotowyOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytObrotowyOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytObrotowyOd100001Do500000Pln()
    {
        return $this->liczbaPoreczenNaKredytObrotowyOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytObrotowyOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytObrotowyOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytObrotowyOd500001Pln()
    {
        return $this->liczbaPoreczenNaKredytObrotowyOd500001Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytObrotowyOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytObrotowyOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytInwestycyjnyDo50000Pln()
    {
        return $this->liczbaPoreczenNaKredytInwestycyjnyDo50000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytInwestycyjnyDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytInwestycyjnyDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln()
    {
        return $this->liczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln()
    {
        return $this->liczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaKredytInwestycyjnyOd500001Pln()
    {
        return $this->liczbaPoreczenNaKredytInwestycyjnyOd500001Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaKredytInwestycyjnyOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaKredytInwestycyjnyOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę obrotową do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeObrotowaDo50000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeObrotowaDo50000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę obrotową do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeObrotowaDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeObrotowaDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę obrotową powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeObrotowaOd500001Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeObrotowaOd500001Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę obrotową powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeObrotowaOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeObrotowaOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeInwestycyjnaDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln()
    {
        return $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln;
    }

    /**
     * Ustala wartość liczby poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenNaPozyczkeInwestycyjnaOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychDo50000Pln()
    {
        return $this->liczbaPoreczenPozostalychDo50000Pln;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychOd50001Do100000Pln()
    {
        return $this->liczbaPoreczenPozostalychOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychOd100001Do500000Pln()
    {
        return $this->liczbaPoreczenPozostalychOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychOd500001Pln()
    {
        return $this->liczbaPoreczenPozostalychOd500001Pln;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychDo50000Pln()
    {
        return $this->liczbaWadiowPoreczenPozostalychDo50000Pln;
    }

    /**
     * Ustala wartość liczby wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychDo50000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychDo50000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychOd50001Do100000Pln()
    {
        return $this->liczbaWadiowPoreczenPozostalychOd50001Do100000Pln;
    }

    /**
     * Ustala wartość liczby wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychOd50001Do100000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychOd50001Do100000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychOd100001Do500000Pln()
    {
        return $this->liczbaWadiowPoreczenPozostalychOd100001Do500000Pln;
    }

    /**
     * Ustala wartość liczby wadiów w pozostałych poręczeniachod 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychOd100001Do500000Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychOd100001Do500000Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychOd500001Pln()
    {
        return $this->liczbaWadiowPoreczenPozostalychOd500001Pln;
    }

    /**
     * Ustala wartość liczby wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychOd500001Pln(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWadiowPozostalychOd500001Pln = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania produkcyjne do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania produkcyjne do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }
}
