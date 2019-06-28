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
     *     name="kwota_por_do_50000_pln_malych_przedsiebiorstwa",
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
     *     name="kwota_por_od_50000_do_100000_pln_malych_przedsiebiorstwa",
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
     *     name="kwota_por_od_100001_do_500000_pln_malych_przedsiebiorstwa",
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
     *     name="kwota_por_od_500001_pln_malych_przedsiebiorstwa",
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
     *     name="kwota_por_do_50000_pln_srednich_przedsiebiorstwa",
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
     *     name="kwota_por_od_50000_do_100000_pln_srednich_przedsiebiorstwa",
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
     *     name="kwota_por_od_100001_do_500000_pln_srednich_przedsiebiorstwa",
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
     *     name="kwota_por_od_500001_pln_srednich_przedsiebiorstwa",
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
     *     name="kwota_por_do_50000_pln_dla_fund_pozyczkowych",
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
     *     name="kwota_por_od_50001_do_100000_pln_dla_fund_pozyczkowych",
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
     *     name="kwota_por_od_100001_do_500000_pln_dla_fund_pozyczkowych",
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
     *     name="kwota_por_od_500001_pln_dla_fund_pozyczkowych",
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
     *     name="kwota_por_do_50000_pln_dla_innych_podmiotow",
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
     *     name="kwota_por_od_50001_do_100000_pln_dla_innych_podmiotow",
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
     *     name="kwota_por_od_100001_do_500000_pln_dla_innych_podmiotow",
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
     *     name="kwota_por_od_500001_pln_dla_innych_podmiotow",
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
     *     name="liczba_por_wyplaconych_mikro_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_mikro_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_mikro_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_nieodzyskanych_mikro_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_male_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_male_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_male_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_nieodzyskanych_male_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_srednie_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_czesciowo_splaconych_srednie_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_calkowicie_splaconych_srednie_przedsiebiorstwa",
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
     *     name="liczba_por_wyplaconych_nieodzyskanych_srednie_przedsiebiorstwa",
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
    public function setSprawozdanie(SprawozdaniePoreczeniowe $sprawozdanie)
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
        $this->kwotaPoreczenDo50000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaMikroPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaMalychPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaSrednichPrzedsiebiorstw = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytObrotowyDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytObrotowyOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytObrotowyOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytObrotowyOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytInwestycyjnyDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytInwestycyjnyOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytInwestycyjnyOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaKredytInwestycyjnyOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeObrotowaDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeObrotowaOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeObrotowaOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeObrotowaOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenNaPozyczkeInwestycyjnaOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenPozostalychDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenPozostalychOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenPozostalychOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenPozostalychOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaWadiowPoreczenPozostalychDo50000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaWadiowPoreczenPozostalychOd50001Do100000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaWadiowPoreczenPozostalychOd100001Do500000Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenWadiowPozostalychOd500001Pln = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnNaDzialaniaProdukcyjne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnNaDzialaniaHandlowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnNaDzialaniaUslugowe = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnNaDzialaniaBudownicze = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnNaDzialaniaInne = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnDlaBankow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaBankow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaBankow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaBankow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaFunduszyPozyczkowych = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenDo50000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd50001Do100000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd100001Do500000PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

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
        $this->kwotaPoreczenOd500001PlnDlaInnychPodmiotow = MoneyHelper::anyToDecimalString($kwotaPoreczen, 2, true);

        return $this;
    }
}
