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
 * @see bin/phpunit --configuration ./tests/phpunit.xml --no-coverage --bootstrap ./vendor/autoload.php
 * tests/Parp/SsfzBundle/Entity/DanePoreczenTest
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
     * @ORM\OneToOne(targetEntity="Parp\SsfzBundle\Entity\SprawozdaniePoreczeniowe", inversedBy="danePoreczen")
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
     * Liczba poręczeń na działania handlowe do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania handlowe do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania handlowe od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania handlowe od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania handlowe powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń na działania usługowe do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania usługowe do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania usługowe od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania usługowe od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania usługowe powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń na działania budowniczedo do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania budowniczedo do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń na działania budowniczeod 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania budowniczeod 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń na działania budowniczeod 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania budowniczeod 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania budowniczepowyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnNaDzialaniaBudownicze = 0;

   /**
     * Liczba poręczeń na działania inne do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania inne do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania inne od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania inne od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń na działania inne powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń na działania inne powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń dla banków do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla banków do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaBankow = 0;

    /**
     * Liczba poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla banków od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaBankow = 0;

    /**
     * Liczba poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla banków od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaBankow = 0;

    /**
     * Liczba poręczeń dla banków powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla banków powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaBankow = 0;

    /**
     * Liczba poręczeń dla funduszy pożyczkowych do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dla_fund_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla funduszy pożyczkowych do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dla_fund_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dla_fund_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń dla funduszy pożyczkowych powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dla_fund_pozyczkowych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla funduszy pożyczkowych powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń dla innych podmiotów do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_do_50000_pln_dla_innych_podmiotow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla innych podmiotów do 50.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenDo50000PlnDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_50001_do_100000_pln_dla_innych_podmiotow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla innych podmiotów od 50.001zł do 100.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_100001_do_500000_pln_dla_innych_podmiotow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla innych podmiotów od 100.001zł do 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_od_500001_pln_dla_innych_podmiotow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń dla innych podmiotów powyżej 500.000zł.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenOd500001PlnDlaInnychPodmiotow = 0;

    /**
     * Kwota poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 50.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50000_do_100000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 100.001zł do 500.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_mikro_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_malych_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 50.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50000_do_100000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 100.001zł do 500.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_male_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń powyżej 500.000zł dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 50.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50000_do_100000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń do 100.001zł do 500.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_srednie_przedsiebiorstwa",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_obrotowy_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt obrotowy do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytObrotowyDo50000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_obrotowy_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_obrotowy_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_obrotowy_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt obrotowy powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytObrotowyOd500001Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_inwestycyjny_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt inwestycyjny do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytInwestycyjnyDo50000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_inwestycyjny_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_inwestycyjny_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln = '0.00';

    /**
     * Kwota poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_kredyt_inwestycyjny_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na kredyt inwestycyjny powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaKredytInwestycyjnyOd500001Pln = '0.00';

    /**
     * Kwota poręczeń na pożyczkę obrotową do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_obrotowa_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pożyczkę obrotową do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeObrotowaDo50000Pln = '0.00';

    /**
     * Kwota poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_obrotowa_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pożyczkę obrotową od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln = '0.00';

    /**
     * Kwota poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_obrotowa_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pożyczkę obrotową od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln = '0.00';

    /**
     * Kwota poręczeń na pożyczkę obrotową powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_obrotowa_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pożyczkę obrotową powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeObrotowaOd500001Pln = '0.00';

    /**
     * Kwota poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_inwestycyjna_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pozyczkę inwestycyjną do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln = '0.00';

    /**
     * Kwota poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_inwestycyjna_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln = '0.00';

    /**
     * Kwota poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_inwestycyjna_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln = '0.00';

    /**
     * Kwota poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_na_pozyczke_inwestycyjna_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln = '0.00';

    /**
     * Kwota pozostałych poręczeń do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pozostałych poręczeń do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychDo50000Pln = '0.00';

    /**
     * Kwota pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pozostałych poręczeń od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychOd50001Do100000Pln = '0.00';

    /**
     * Kwota pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pozostałych poręczeń od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychOd100001Do500000Pln = '0.00';

    /**
     * Kwota pozostałych poręczeń powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota pozostałych poręczeń powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychOd500001Pln = '0.00';

    /**
     * Kwota wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_do_50000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota wadiów w pozostałych poręczeniach do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychDo50000Pln = '0.00';

    /**
     * Kwota wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_od_50001_do_100000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychOd50001Do100000Pln = '0.00';

    /**
     * Kwota wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_od_100001_do_500000_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychOd100001Do500000Pln = '0.00';

    /**
     * Kwota wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_od_500001_pln",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota wadiów w pozostałych poręczeniach powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychOd500001Pln = '0.00';

    /**
     * Kwota poręczeń na działania produkcyjne do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania produkcyjne do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania produkcyjne od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania produkcyjne od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania produkcyjne powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń na działania handlowe do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania handlowe do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania handlowe od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania handlowe od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania handlowe powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń na działania usługowe do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania usługowe do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania usługowe od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania usługowe od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania usługowe powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń na działania budowniczedo do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania budowniczedo do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń na działania budowniczeod 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania budowniczeod 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń na działania budowniczeod 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania budowniczeod 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania budowniczepowyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnNaDzialaniaBudownicze = '0.00';

   /**
     * Kwota poręczeń na działania inne do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania inne do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania inne od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania inne od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń na działania inne powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń na działania inne powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń dla banków do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla banków do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaBankow = '0.00';

    /**
     * Kwota poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla banków od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaBankow = '0.00';

    /**
     * Kwota poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla banków od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaBankow = '0.00';

    /**
     * Kwota poręczeń dla banków powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla banków powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaBankow = '0.00';

    /**
     * Kwota poręczeń dla funduszy pożyczkowych do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla funduszy pożyczkowych do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla funduszy pożyczkowych od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla funduszy pożyczkowych od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń dla funduszy pożyczkowych powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla funduszy pożyczkowych powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń dla innych podmiotów do 50.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_do_50000_pln_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla innych podmiotów do 50.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenDo50000PlnDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_50001_do_100000_pln_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla innych podmiotów od 50.001zł do 100.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_100001_do_500000_pln_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla innych podmiotów od 100.001zł do 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="kwota_por_od_500001_pln_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń dla innych podmiotów powyżej 500.000zł.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenOd500001PlnDlaInnychPodmiotow = '0.00';

    /**
     * Liczba poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_mikro_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_mikro_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_mikro_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_mikro_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_male_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_male_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_male_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_male_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_srednie_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_srednie_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_srednie_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_srednie_przeds",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw = 0;

    /**
     * Liczba poręczeń wypłaconych na kredyt obrotowy.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_na_kredyt_obrotowy",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na kredyt obrotowy.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaKredytObrotowy = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_na_kredyt_obrotowy",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_na_kredyt_obrotowy",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_na_kredyt_obrotowy",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy = 0;

    /**
     * Liczba poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_na_kredyt_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na kredyt inwestycyjny.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaKredytInwestycyjny = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_na_kredyt_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_na_kredyt_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_na_kredyt_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny = 0;

    /**
     * Liczba poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_na_pozyczke_obrot",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na pożyczkę obrotową.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaPozyczkeObrotowa = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_na_pozyczke_obrot",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_na_pozyczke_obrot",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_na_pozyczke_obrot",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa = 0;

    /**
     * Liczba poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_na_pozyczke_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na pożyczkę inwestycyjną.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaPozyczkeInwestycyjna = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_na_pozyczke_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_na_pozyczke_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_na_pozyczke_inwest",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna = 0;

    /**
     * Liczba pozostałych poręczeń wypłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_wyplaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychWyplaconych = 0;

    /**
     * Liczba pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_wyplaconych_czesciowo_splaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i częściowo spłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych = 0;

    /**
     * Liczba pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_wyplaconych_calkowicie_splaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i całkowicie spłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych = 0;

    /**
     * Liczba pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_pozostalych_wyplaconych_nieodzyskanych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i nieodzyskanych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenPozostalychWyplaconychNieodzyskanych = 0;

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_wyplaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychWyplaconych = 0;

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_wyplaconych_czesciowo_splaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych = 0;

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_wyplaconych_calkowicie_splaconych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych = 0;

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_wadiow_por_pozostalych_wyplaconych_nieodzyskanych",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych = 0;

    /**
     * Liczba poręczeń wypłaconych na działania produkcyjne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na działania produkcyjne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dzial_produkcyjne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne = 0;

    /**
     * Liczba poręczeń wypłaconych na działania handlowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na działania handlowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na działania handlowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dzial_handlowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na działania handlowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe = 0;

    /**
     * Liczba poręczeń wypłaconych na działania usługowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na działania usługowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na działania usługowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dzial_uslugowe",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na działania usługowe.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe = 0;

    /**
     * Liczba poręczeń wypłaconych na działania budownicze.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na działania budownicze.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na działania budownicze.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dzial_budownicze",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na działania budownicze.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze = 0;

    /**
     * Liczba poręczeń wypłaconych na działania inne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych na działania inne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych na działania inne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych na działania inne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dzial_inne",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych na działania inne.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne = 0;

    /**
     * Liczba poręczeń wypłaconych dla banków.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaBankow = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dla_bankow",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla banków.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychDlaBankow = 0;

    /**
     * Liczba poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dla_fund_pozyczk",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla funduszy pożyczkowych",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dla_fund_pozyczk",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dla_fund_pozyczk",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dla_fund_pozyczk",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych = 0;

    /**
     * Liczba poręczeń wypłaconych dla innych podmiotów.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_dla_innych_podm",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych dla innych podmiotów",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_dla_innych_podm",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_dla_innych_podm",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow = 0;

    /**
     * Liczba poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_por_wyplaconych_nieodzyskanych_dla_innych_podm",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba poręczeń wypłaconych i nieodzyskanych dla innych podmiotów",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow = 0;

    /**
     * Kwota poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_mikro_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_mikro_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_mikro_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_mikro_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_male_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_male_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_male_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_male_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_srednie_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_srednie_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_srednie_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_srednie_przeds",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw = '0.00';

    /**
     * Kwota poręczeń wypłaconych na kredyt obrotowy.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_na_kredyt_obrotowy",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na kredyt obrotowy.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaKredytObrotowy = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_na_kredyt_obrotowy",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_na_kredyt_obrotowy",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_na_kredyt_obrotowy",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy = '0.00';

    /**
     * Kwota poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_na_kredyt_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na kredyt inwestycyjny.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaKredytInwestycyjny = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_na_kredyt_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_na_kredyt_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_na_kredyt_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny = '0.00';

    /**
     * Kwota poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_na_pozyczke_obrot",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na pożyczkę obrotową.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaPozyczkeObrotowa = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_na_pozyczke_obrot",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_na_pozyczke_obrot",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_na_pozyczke_obrot",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa = '0.00';

    /**
     * Kwota poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_na_pozyczke_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na pożyczkę inwestycyjną.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaPozyczkeInwestycyjna = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_na_pozyczke_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_na_pozyczke_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_na_pozyczke_inwest",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna = '0.00';

    /**
     * Liczba pozostałych poręczeń wypłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_wyplaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychWyplaconych = '0.00';

    /**
     * Liczba pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_wyplaconych_czesciowo_splaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i częściowo spłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych = '0.00';

    /**
     * Liczba pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_wyplaconych_calkowicie_splaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i całkowicie spłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych = '0.00';

    /**
     * Liczba pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_pozostalych_wyplaconych_nieodzyskanych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pozostałych poręczeń wypłaconych i nieodzyskanych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenPozostalychWyplaconychNieodzyskanych = '0.00';

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_wyplaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychWyplaconych = '0.00';

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_wyplaconych_czesciowo_splaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych = '0.00';

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_wyplaconych_calkowicie_splaconych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych = '0.00';

    /**
     * Liczba wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_wadiow_por_pozostalych_wyplaconych_nieodzyskanych",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Liczba wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych = '0.00';

    /**
     * Kwota poręczeń wypłaconych na działania produkcyjne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na działania produkcyjne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dzial_produkcyjne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne = '0.00';

    /**
     * Kwota poręczeń wypłaconych na działania handlowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na działania handlowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na działania handlowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dzial_handlowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na działania handlowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych na działania usługowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na działania usługowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na działania usługowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dzial_uslugowe",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na działania usługowe.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe = '0.00';

    /**
     * Kwota poręczeń wypłaconych na działania budownicze.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na działania budownicze.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na działania budownicze.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dzial_budownicze",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na działania budownicze.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze = '0.00';

    /**
     * Kwota poręczeń wypłaconych na działania inne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych na działania inne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych na działania inne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych na działania inne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dzial_inne",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych na działania inne.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne = '0.00';

    /**
     * Kwota poręczeń wypłaconych dla banków.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla banków.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaBankow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla banków.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla banków.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dla_bankow",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla banków.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychDlaBankow = '0.00';

    /**
     * Kwota poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla funduszy pożyczkowych",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dla_fund_pozyczk",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych = '0.00';

    /**
     * Kwota poręczeń wypłaconych dla innych podmiotów.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych dla innych podmiotów",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_czesciowo_splaconych_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_calkowicie_splaconych_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow = '0.00';

    /**
     * Kwota poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @var string
     *
     * @ORM\Column(
     *     name="kwota_por_wyplaconych_nieodzyskanych_dla_innych_podm",
     *     type="decimal",
     *     precision=11,
     *     scale=2,
     *     nullable=false,
     *     options={
     *         "comment":"Kwota poręczeń wypłaconych i nieodzyskanych dla innych podmiotów",
     *         "default":0.00
     *     }
     * )
     */
    protected $kwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow = '0.00';

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
     *     name="liczba_wspolpracujacych_funduszy_pozyczk",
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
    public function setSprawozdanie(SprawozdaniePoreczeniowe $sprawozdanie)
    {
        $this->sprawozdanie = $sprawozdanie;

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw;
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
        $this->liczbaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw;
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
        $this->liczbaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw;
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
        $this->liczbaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw;
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
        $this->liczbaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

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
        $this->liczbaWadiowPoreczenPozostalychOd500001Pln = abs($liczbaPoreczen);

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

    /**
     * Zwraca wartość liczby poręczeń na działania handlowe do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenDo50000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania handlowe do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenOd500001PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania usługowe do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenDo50000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania usługowe do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenOd500001PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania budownicze do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenDo50000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń na działania budownicze do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania budownicze od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń na działania budownicze od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania budownicze od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń na działania budownicze od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenOd500001PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania inne do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnNaDzialaniaInne()
    {
        return $this->liczbaPoreczenDo50000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania inne do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnNaDzialaniaInne()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnNaDzialaniaInne()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń na działania inne powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnNaDzialaniaInne()
    {
        return $this->liczbaPoreczenOd500001PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń na działania inne powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla banków do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaBankow()
    {
        return $this->liczbaPoreczenDo50000PlnDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń dla banków do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaBankow()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaBankow()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla banków powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaBankow()
    {
        return $this->liczbaPoreczenOd500001PlnDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń dla banków powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla funduszy podatkowych do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń dla funduszy podatkowych do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla funduszy podatkowych od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń dla funduszy podatkowych od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla funduszy podatkowych od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń dla funduszy podatkowych od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla funduszy podatkowych powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń dla funduszy podatkowych powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla innych podmiotów do 50.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenDo50000PlnDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenDo50000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń dla innych podmiotów do 50.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenDo50000PlnDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenDo50000PlnDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd50001Do100000PlnDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd100001Do500000PlnDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @return int
     */
    public function getLiczbaPoreczenOd500001PlnDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenOd500001PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenOd500001PlnDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenOd500001PlnDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń do 50.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true);

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 50.001zł do 100.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 100.001zł do 500.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń powyżej 500.000zł dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń do 50.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 50.001zł do 100.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 100.001zł do 500.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń powyżej 500.000zł dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń do 50.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 50.001zł do 100.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń od 100.001zł do 500.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń powyżej 500.000zł dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytObrotowyDo50000Pln()
    {
        return $this->kwotaPoreczenNaKredytObrotowyDo50000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt obrotowy do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytObrotowyDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytObrotowyDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytObrotowyOd50001Do100000Pln()
    {
        return $this->kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt obrotowy od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytObrotowyOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytObrotowyOd100001Do500000Pln()
    {
        return $this->kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt obrotowy od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytObrotowyOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytObrotowyOd500001Pln()
    {
        return $this->kwotaPoreczenNaKredytObrotowyOd500001Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt obrotowy powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytObrotowyOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytObrotowyOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytInwestycyjnyDo50000Pln()
    {
        return $this->kwotaPoreczenNaKredytInwestycyjnyDo50000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt inwestycyjny do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytInwestycyjnyDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytInwestycyjnyDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln()
    {
        return $this->kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt inwestycyjny od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln()
    {
        return $this->kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt inwestycyjny od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaKredytInwestycyjnyOd500001Pln()
    {
        return $this->kwotaPoreczenNaKredytInwestycyjnyOd500001Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na kredyt inwestycyjny powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaKredytInwestycyjnyOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaKredytInwestycyjnyOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę obrotową do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeObrotowaDo50000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeObrotowaDo50000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę obrotową do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeObrotowaDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeObrotowaDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę obrotową od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę obrotową od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę obrotową powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeObrotowaOd500001Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeObrotowaOd500001Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę obrotową powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeObrotowaOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeObrotowaOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę inwestycyjną do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę inwestycyjną od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę inwestycyjną od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln()
    {
        return $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln;
    }

    /**
     * Ustala wartość kwoty poręczeń na pozyczkę inwestycyjną powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychDo50000Pln()
    {
        return $this->kwotaPoreczenPozostalychDo50000Pln;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychOd50001Do100000Pln()
    {
        return $this->kwotaPoreczenPozostalychOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychOd100001Do500000Pln()
    {
        return $this->kwotaPoreczenPozostalychOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychOd500001Pln()
    {
        return $this->kwotaPoreczenPozostalychOd500001Pln;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychDo50000Pln()
    {
        return $this->kwotaWadiowPoreczenPozostalychDo50000Pln;
    }

    /**
     * Ustala wartość kwoty wadiów w pozostałych poręczeniach do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychDo50000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychDo50000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychOd50001Do100000Pln()
    {
        return $this->kwotaWadiowPoreczenPozostalychOd50001Do100000Pln;
    }

    /**
     * Ustala wartość kwoty wadiów w pozostałych poręczeniach od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychOd50001Do100000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychOd50001Do100000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów w pozostałych poręczeniach od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychOd100001Do500000Pln()
    {
        return $this->kwotaWadiowPoreczenPozostalychOd100001Do500000Pln;
    }

    /**
     * Ustala wartość kwoty wadiów w pozostałych poręczeniachod 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychOd100001Do500000Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychOd100001Do500000Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychOd500001Pln()
    {
        return $this->kwotaWadiowPoreczenPozostalychOd500001Pln;
    }

    /**
     * Ustala wartość kwoty wadiów w pozostałych poręczeniach powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychOd500001Pln(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychOd500001Pln = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania produkcyjne do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania produkcyjne do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania produkcyjne od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania produkcyjne od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania produkcyjne powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania handlowe do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenDo50000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania handlowe do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania handlowe od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania handlowe od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenOd500001PlnNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania handlowe powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania usługowe do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenDo50000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania usługowe do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania usługowe od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania usługowe od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenOd500001PlnNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania usługowe powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania budownicze do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenDo50000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania budownicze do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania budownicze od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania budownicze od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania budownicze od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania budownicze od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenOd500001PlnNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania budownicze powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania inne do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnNaDzialaniaInne()
    {
        return $this->kwotaPoreczenDo50000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania inne do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnNaDzialaniaInne()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania inne od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnNaDzialaniaInne()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania inne od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń na działania inne powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnNaDzialaniaInne()
    {
        return $this->kwotaPoreczenOd500001PlnNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń na działania inne powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }





    /**
     * Zwraca wartość kwoty poręczeń dla banków do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaBankow()
    {
        return $this->kwotaPoreczenDo50000PlnDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla banków do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaBankow()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla banków od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaBankow()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla banków od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla banków powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaBankow()
    {
        return $this->kwotaPoreczenOd500001PlnDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla banków powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla funduszy podatkowych do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń dla funduszy podatkowych do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla funduszy podatkowych od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń dla funduszy podatkowych od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla funduszy podatkowych od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń dla funduszy podatkowych od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla funduszy podatkowych powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń dla funduszy podatkowych powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla innych podmiotów do 50.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenDo50000PlnDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenDo50000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla innych podmiotów do 50.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenDo50000PlnDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenDo50000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla innych podmiotów od 50.001zł do 100.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla innych podmiotów od 100.001zł do 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @return string
     */
    public function getKwotaPoreczenOd500001PlnDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenOd500001PlnDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń dla innych podmiotów powyżej 500.000zł.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenOd500001PlnDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenOd500001PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na kredyt obrotowy.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaKredytObrotowy()
    {
        return $this->liczbaPoreczenWyplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na kredyt obrotowy.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaKredytObrotowy(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaKredytObrotowy = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaKredytInwestycyjny()
    {
        return $this->liczbaPoreczenWyplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaKredytInwestycyjny(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaKredytInwestycyjny = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaPozyczkeObrotowa()
    {
        return $this->liczbaPoreczenWyplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaPozyczkeObrotowa(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaPozyczkeObrotowa = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaPozyczkeInwestycyjna()
    {
        return $this->liczbaPoreczenWyplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaPozyczkeInwestycyjna(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaPozyczkeInwestycyjna = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń wypłaconych.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychWyplaconych()
    {
        return $this->liczbaPoreczenPozostalychWyplaconych;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń wypłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychWyplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychWyplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych()
    {
        return $this->liczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychWyplaconychCzesciowoSplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych()
    {
        return $this->liczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychWyplaconychCalkowicieSplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @return int
     */
    public function getLiczbaPoreczenPozostalychWyplaconychNieodzyskanych()
    {
        return $this->liczbaPoreczenPozostalychWyplaconychNieodzyskanych;
    }

    /**
     * Ustala wartość liczby pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenPozostalychWyplaconychNieodzyskanych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenPozostalychWyplaconychNieodzyskanych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów pozostałych poręczeń wypłaconych.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychWyplaconych()
    {
        return $this->liczbaWadiowPoreczenPozostalychWyplaconych;
    }

    /**
     * Ustala wartość liczby wadiów pozostałych poręczeń wypłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychWyplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychWyplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych()
    {
        return $this->liczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych;
    }

    /**
     * Ustala wartość liczby wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych()
    {
        return $this->liczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych;
    }

    /**
     * Ustala wartość liczby wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @return int
     */
    public function getLiczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych()
    {
        return $this->liczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych;
    }

    /**
     * Ustala wartość liczby wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych(int $liczbaPoreczen = 0)
    {
        $this->liczbaWadiowPoreczenPozostalychWyplaconychNieodzyskanych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na działania produkcyjne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenWyplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na działania produkcyjne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na działania handlowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenWyplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na działania handlowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na działania usługowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenWyplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na działania usługowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na działania budownicze.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenWyplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na działania budownicze.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych na działania inne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNaDzialaniaInne()
    {
        return $this->liczbaPoreczenWyplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych na działania inne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla banków.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaBankow()
    {
        return $this->liczbaPoreczenWyplaconychDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla banków.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychDlaBankow()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychDlaBankow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychDlaBankow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychDlaBankow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenWyplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych dla innych podmiotów.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenWyplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych dla innych podmiotów.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość liczby poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @return int
     */
    public function getLiczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow()
    {
        return $this->liczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość liczby poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @param int $liczbaPoreczen
     *
     * @return DanePoreczen
     */
    public function setLiczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow(int $liczbaPoreczen = 0)
    {
        $this->liczbaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow = abs($liczbaPoreczen);

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla mikro przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla małych przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla średnich przedsiębiorstw.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychhDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na kredyt obrotowy.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaKredytObrotowy()
    {
        return $this->kwotaPoreczenWyplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na kredyt obrotowy.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaKredytObrotowy(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaKredytObrotowy = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na kredyt obrotowy.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytObrotowy = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na kredyt obrotowy.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytObrotowy = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na kredyt obrotowy.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaKredytObrotowy = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaKredytInwestycyjny()
    {
        return $this->kwotaPoreczenWyplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na kredyt inwestycyjny.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaKredytInwestycyjny(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaKredytInwestycyjny = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na kredyt inwestycyjny.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaKredytInwestycyjny = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na kredyt inwestycyjny.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaKredytInwestycyjny = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na kredyt inwestycyjny.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaKredytInwestycyjny = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaPozyczkeObrotowa()
    {
        return $this->kwotaPoreczenWyplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na pożyczkę obrotową.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaPozyczkeObrotowa(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaPozyczkeObrotowa = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na pożyczkę obrotową.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeObrotowa = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na pożyczkę obrotową.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeObrotowa = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na pożyczkę obrotową.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeObrotowa = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaPozyczkeInwestycyjna()
    {
        return $this->kwotaPoreczenWyplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na pożyczkę inwestycyjną.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaPozyczkeInwestycyjna(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaPozyczkeInwestycyjna = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na pożyczkę inwestycyjną.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaPozyczkeInwestycyjna = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na pożyczkę inwestycyjną.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaPozyczkeInwestycyjna = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na pożyczkę inwestycyjną.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaPozyczkeInwestycyjna = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń wypłaconych.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychWyplaconych()
    {
        return $this->kwotaPoreczenPozostalychWyplaconych;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń wypłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychWyplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychWyplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych()
    {
        return $this->kwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychWyplaconychCzesciowoSplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych()
    {
        return $this->kwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychWyplaconychCalkowicieSplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @return string
     */
    public function getKwotaPoreczenPozostalychWyplaconychNieodzyskanych()
    {
        return $this->kwotaPoreczenPozostalychWyplaconychNieodzyskanych;
    }

    /**
     * Ustala wartość kwoty pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenPozostalychWyplaconychNieodzyskanych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenPozostalychWyplaconychNieodzyskanych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów pozostałych poręczeń wypłaconych.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychWyplaconych()
    {
        return $this->kwotaWadiowPoreczenPozostalychWyplaconych;
    }

    /**
     * Ustala wartość kwoty wadiów pozostałych poręczeń wypłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychWyplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychWyplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych()
    {
        return $this->kwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych;
    }

    /**
     * Ustala wartość kwoty wadiów pozostałych poręczeń wypłaconych i częściowo spłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychWyplaconychCzesciowoSplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych()
    {
        return $this->kwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych;
    }

    /**
     * Ustala wartość kwoty wadiów pozostałych poręczeń wypłaconych i całkowicie spłaconych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychWyplaconychCalkowicieSplaconych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @return string
     */
    public function getKwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych()
    {
        return $this->kwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych;
    }

    /**
     * Ustala wartość kwoty wadiów pozostałych poręczeń wypłaconych i nieodzyskanych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaWadiowPoreczenPozostalychWyplaconychNieodzyskanych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na działania produkcyjne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenWyplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na działania produkcyjne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania produkcyjne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania produkcyjne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania produkcyjne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na działania handlowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenWyplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na działania handlowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania handlowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania handlowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania handlowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na działania usługowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenWyplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na działania usługowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania usługowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania usługowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania usługowe.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na działania budownicze.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenWyplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na działania budownicze.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania budownicze.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania budownicze.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania budownicze.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych na działania inne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNaDzialaniaInne()
    {
        return $this->kwotaPoreczenWyplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych na działania inne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych na działania inne
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych na działania inne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych na działania inne.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychNaDzialaniaInne = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla banków.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaBankow()
    {
        return $this->kwotaPoreczenWyplaconychDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla banków.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla banków.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla banków.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychDlaBankow()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychDlaBankow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla banków..
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychDlaBankow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychDlaBankow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenWyplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla funduszy pożyczkowych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla funduszy pożyczkowych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla funduszy pożyczkowych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych(
        string $kwotaPoreczen = '0.00'
    )
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla funduszy pożyczkowych.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych dla innych podmiotów.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenWyplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych dla innych podmiotów.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i częściowo spłaconych dla innych podmiotów.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCzesciowoSplaconychDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i całkowicie spłaconych dla innych podmiotów.
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychCalkowicieSplaconychDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

        return $this;
    }

    /**
     * Zwraca wartość kwoty poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @return string
     */
    public function getKwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow()
    {
        return $this->kwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow;
    }

    /**
     * Ustala wartość kwoty poręczeń wypłaconych i nieodzyskanych dla innych podmiotów
     *
     * @param string $kwotaPoreczen
     *
     * @return DanePoreczen
     */
    public function setKwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow(string $kwotaPoreczen = '0.00')
    {
        $this->kwotaPoreczenWyplaconychNieodzyskanychDlaInnychPodmiotow = MoneyHelper::anyToDecimalString(
            $kwotaPoreczen,
            2,
            true
        );

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
}
