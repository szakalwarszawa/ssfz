<?php

namespace Parp\SsfzBundle\Tests\Entity;

use \Parp\SsfzBundle\Entity;
use PHPUnit\Framework\TestCase;

/**
 * Description of PrzeplywFinansowyTest
 *
 * @author adamw
 */
class PrzeplywFinansowyTest extends TestCase
{
    private $przeplywFinansowy;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->przeplywFinansowy = new Entity\PrzeplywFinansowy();
    }

    /**
     * Testownaia pola Id
     */
    public function testId()
    {
        $id = 1;
        $this->przeplywFinansowy->setId($id);
        $this->assertEquals($id, $this->przeplywFinansowy->getId());
    }

    /**
     * Testownaia pola SaldoPoczatkowe
     */
    public function testSaldoPoczatkowe()
    {
        $saldo = 2;
        $this->przeplywFinansowy->setSaldoPoczatkowe($saldo);
        $this->assertEquals($saldo, $this->przeplywFinansowy->getSaldoPoczatkowe());
    }

    /**
     * Testownaia pola creatorId
     */
    public function testCreatorId()
    {
        $creatorId = 3;
        $this->przeplywFinansowy->setCreatorId($creatorId);
        $this->assertEquals($creatorId, $this->przeplywFinansowy->getCreatorId());
    }

    /**
     * Testownaia pola DataRejestracji
     */
    public function testDataRejestracji()
    {
        $var = new \DateTime('now');
        $this->przeplywFinansowy->setDataRejestracji($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getDataRejestracji());
    }

    /**
     * Testownaia pola SprawozdanieId
     */
    public function testSprawozdanieId()
    {
        $var = 4;
        $this->przeplywFinansowy->setSprawozdanieId($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getSprawozdanieId());
    }

    /**
     * Testownaia pola wplywy
     */
    public function testWplywy()
    {
        $var = 5;
        $this->przeplywFinansowy->setWplywy($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getWplywy());
    }

    /**
     * Testownaia pola WyjsciaZInwestycji
     */
    public function testWyjsciaZInwestycji()
    {
        $var = 6;
        $this->przeplywFinansowy->setWyjsciaZInwestycji($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getWyjsciaZInwestycji());
    }

    /**
     * Testownaia pola UdzialWZyskach
     */
    public function testUdzialWZyskach()
    {
        $var = 7;
        $this->przeplywFinansowy->setUdzialWZyskach($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getUdzialWZyskach());
    }

    /**
     * Testownaia pola InneWplywy
     */
    public function testInneWplywy()
    {
        $var = 8;
        $this->przeplywFinansowy->setInneWplywy($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getInneWplywy());
    }

    /**
     * Testownaia pola Wyplywy
     */
    public function testWyplywy()
    {
        $var = 9;
        $this->przeplywFinansowy->setWyplywy($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getWyplywy());
    }

    /**
     * Testownaia pola WejsciaKapitalowe
     */
    public function testWejsciaKapitalowe()
    {
        $var = 10;
        $this->przeplywFinansowy->setWejsciaKapitalowe($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getWejsciaKapitalowe());
    }

    /**
     * Testownaia pola PreinkubacjaPomyslow
     */
    public function testPreinkubacjaPomyslow()
    {
        $var = 11;
        $this->przeplywFinansowy->setPreinkubacjaPomyslow($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getPreinkubacjaPomyslow());
    }

    /**
     * Testownaia pola WydatkiOperacyjne
     */
    public function testWydatkiOperacyjne()
    {
        $var = 12;
        $this->przeplywFinansowy->setWydatkiOperacyjne($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getWydatkiOperacyjne());
    }

    /**
     * Testownaia pola Podatki
     */
    public function testPodatki()
    {
        $var = 13;
        $this->przeplywFinansowy->setPodatki($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getPodatki());
    }

    /**
     * Testownaia pola InneWyplywy
     */
    public function testInneWyplywy()
    {
        $var = 14;
        $this->przeplywFinansowy->setInneWyplywy($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getInneWyplywy());
    }

    /**
     * Testownaia pola SaldoKoncowe
     */
    public function testSaldoKoncowe()
    {
        $var = 15;
        $this->przeplywFinansowy->setSaldoKoncowe($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getSaldoKoncowe());
    }

    /**
     * Testownaia pola LiczbaPomyslowWInkubatorze
     */
    public function testLiczbaPomyslowWInkubatorze()
    {
        $var = 16;
        $this->przeplywFinansowy->setLiczbaPomyslowWInkubatorze($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaPomyslowWInkubatorze());
    }

    /**
     * Testownaia pola LiczbaPomyslowOcenionych
     */
    public function testLiczbaPomyslowOcenionych()
    {
        $var = 17;
        $this->przeplywFinansowy->setLiczbaPomyslowOcenionych($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaPomyslowOcenionych());
    }

    /**
     * Testownaia pola LiczbaPomyslowOcenionychPozytywnie
     */
    public function testLiczbaPomyslowOcenionychPozytywnie()
    {
        $var = 18;
        $this->przeplywFinansowy->setLiczbaPomyslowOcenionychPozytywnie($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaPomyslowOcenionychPozytywnie());
    }

    /**
     * Testownaia pola LiczbaPomyslowOcenionychNegatywnie
     */
    public function testLiczbaPomyslowOcenionychNegatywnie()
    {
        $var = 19;
        $this->przeplywFinansowy->setLiczbaPomyslowOcenionychNegatywnie($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaPomyslowOcenionychNegatywnie());
    }

    /**
     * Testownaia pola LiczbaZakonczonychPreinkubacji
     */
    public function testLiczbaZakonczonychPreinkubacji()
    {
        $var = 20;
        $this->przeplywFinansowy->setLiczbaZakonczonychPreinkubacji($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaZakonczonychPreinkubacji());
    }

    /**
     * Testownaia pola LiczbaDokonanychInwestycji
     */
    public function testLiczbaDokonanychInwestycji()
    {
        $var = 21;
        $this->przeplywFinansowy->setLiczbaDokonanychInwestycji($var);
        $this->assertEquals($var, $this->przeplywFinansowy->getLiczbaDokonanychInwestycji());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->przeplywFinansowy = null;
    }
}
