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

    /**
     * Liczba pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_inne_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek do 10.000zł dla innych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_10001_do_30000_pln_inne_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_30001_do_50000_pln_inne_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 30.001zł do 50.000zł dla innych_przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_50001_do_120000_pln_inne_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = 0;

    /**
    * Liczba pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_120001_do_300000_pln_inne_przedsiebiorstwa",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 120.001zł do 300.000zł dla inne przedsiębiorstw.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_inne_przedsiebiorstwa",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 301.000zł dla innych przedsiębiorstw.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = 0;

    /**
     * Liczba pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_do_10000_pln_inst_ekonomii_spol",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek do 10.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    /**
     * Liczba pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_10001_do_30000_pln_inst_ekonomii_spol",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    /**
     * Liczba pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_30001_do_50000_pln_inst_ekonomii_spol",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    /**
     * Liczba pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_50001_do_120000_pln_inst_ekonomii_spol",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = 0;

   /**
    * Liczba pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
    *
    * @var int
    *
    * @ORM\Column(
    *     name="liczba_poz_od_120001_do_300000_pln_inst_ekonomii_spol",
    *     type="integer",
    *     nullable=false,
    *     options={
    *         "comment":"Liczba pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.",
    *         "default":0
    *     }
    * )
    */
    protected $liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = 0;

    /**
     * Liczba pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @var int
     *
     * @ORM\Column(
     *     name="liczba_poz_od_300001_pln_inst_ekonomii_spol",
     *     type="integer",
     *     nullable=false,
     *     options={
     *         "comment":"Liczba pożyczek od 301.000zł dla instytucji ekonomii spolecznej.",
     *         "default":0
     *     }
     * )
     */
    protected $liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = 0;

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
    protected $liczbaPozyczekInwestycyjnychDo10000Pln = 0;

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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * @return DanePozyczki
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
     * Ustala wartość liczby pożyczek od 301.000zł dla średnich przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaSrednichPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek do 10.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 10.001zł do 30.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 30.001zł do 50.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 50.001zł do 120.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 120.001zł do 300.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw()
    {
        return $this->liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw;
    }

    /**
     * Ustala wartość liczby pożyczek od 301.000zł dla innych przedsiębiorstw.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaInnychPrzedsiebiorstw = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek do 10.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekDo10000PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek od 10.001zł do 30.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd10001Do30000PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek od 30.001zł do 50.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd30001Do50000PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek od 50.001zł do 120.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd50001Do120000PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek od 120.001zł do 300.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd120001Do300000PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

        return $this;
    }

    /**
     * Zwraca wartość liczby pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @return int
     */
    public function getLiczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej()
    {
        return $this->liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej;
    }

    /**
     * Ustala wartość liczby pożyczek od 301.000zł dla instytucji ekonomii spolecznej.
     *
     * @param int $liczbaPozyczek
     *
     * @return DanePozyczki
     */
    public function setLiczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej(int $liczbaPozyczek = 0)
    {
        $this->liczbaPozyczekOd300001PlnDlaInstytucjiEkonomiiSpolecznej = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychDo10000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychOd10001Do30000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychOd30001Do50000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychOd50001Do120000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychOd120001Do300000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekObrotowychOd300001Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychDo10000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychOd10001Do30000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychOd30001Do50000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychOd50001Do120000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychOd120001Do300000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnychOd300001Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychDo10000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychOd10001Do30000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychOd30001Do50000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychOd50001Do120000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychOd120001Do300000Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekInwestycyjnoObrotowychOd300001Pln = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaProdukcyjne = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaHandlowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaUslugowe = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaBudownicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaRolnicze = $liczbaPozyczek;

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
        $this->liczbaPozyczekDo10000PlnNaDzialaniaInne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd10001Do30000PlnNaDzialaniaInne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd30001Do50000PlnNaDzialaniaInne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd50001Do120000PlnNaDzialaniaInne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd120001Do300000PlnNaDzialaniaInne = $liczbaPozyczek;

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
        $this->liczbaPozyczekOd300001PlnNaDzialaniaInne = $liczbaPozyczek;

        return $this;
    }
}
