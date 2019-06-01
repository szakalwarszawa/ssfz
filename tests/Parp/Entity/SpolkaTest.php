<?php

namespace Test\Parp\SsfzBundle\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Spolka;

/**
 *  Tesy encji Spolka
 *
 * @covers \Parp\SsfzBundle\Entity\Spolka
 */
class SpolkaTest extends TestCase
{
    private $spolka;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->spolka = new Spolka();
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->spolka->getId());
    }

    /**
     * Test pola ZakonczonaDodatkowe
     */
    public function testZakonczonaDodatkowe()
    {
        $value = 1;
        $this->spolka->setZakonczona($value);
        $this->assertEquals($value, $this->spolka->getZakonczonaDodatkowe());
    }

    /**
     * Test pola UmowaId
     */
    public function testUmowaId()
    {
        $value = 1;
        $this->spolka->setUmowaId($value);
        $this->assertEquals($value, $this->spolka->getUmowaId());
    }

    /**
     * Test pola Umowa
     */
    public function testUmowa()
    {
        $value = new Umowa();
        $this->spolka->setUmowa($value);
        $this->assertEquals($value, $this->spolka->getUmowa());
    }

    /**
     * Test pola Lp
     */
    public function testLp()
    {
        $value = 1;
        $this->spolka->setLp($value);
        $this->assertEquals($value, $this->spolka->getLp());
    }

    /**
     * Test pola Nazwa
     */
    public function testNazwa()
    {
        $value = 'Lorem';
        $this->spolka->setNazwa($value);
        $this->assertEquals($value, $this->spolka->getNazwa());
    }

    /**
     * Test pola Forma
     */
    public function testForma()
    {
        $value = 'Ipsum';
        $this->spolka->setForma($value);
        $this->assertEquals($value, $this->spolka->getForma());
    }

    /**
     * Test pola SiedzibaMiasto
     */
    public function testSiedzibaMiasto()
    {
        $value = 'Lorem';
        $this->spolka->setSiedzibaMiasto($value);
        $this->assertEquals($value, $this->spolka->getSiedzibaMiasto());
    }

    /**
     * Test pola SiedzibaWojewodztwo
     */
    public function testSiedzibaWojewodztwo()
    {
        $value = 'PODLASKIE';
        $this->spolka->setSiedzibaWojewodztwo($value);
        $this->assertEquals($value, $this->spolka->getSiedzibaWojewodztwo());
    }

    /**
     * Test pola Branza
     */
    public function testBranza()
    {
        $value = 'IT';
        $this->spolka->setBranza($value);
        $this->assertEquals($value, $this->spolka->getBranza());
    }

    /**
     * Test pola Opis
     */
    public function testOpis()
    {
        $value = 'Lorem ipsum';
        $this->spolka->setOpis($value);
        $this->assertEquals($value, $this->spolka->getOpis());
    }

    /**
     * Test pola DataPowolania
     */
    public function testDataPowolania()
    {
        $value = '2017-01-01';
        $this->spolka->setDataPowolania($value);
        $this->assertEquals($value, $this->spolka->getDataPowolania());
    }

    /**
     * Test pola Krs
     */
    public function testKrs()
    {
        $value = '1111111111';
        $this->spolka->setKrs($value);
        $this->assertEquals($value, $this->spolka->getKrs());
    }

    /**
     * Test pola Nip
     */
    public function testNip()
    {
        $value = '11111111111';
        $this->spolka->setNip($value);
        $this->assertEquals($value, $this->spolka->getNip());
    }

    /**
     * Test pola KwInwestycji
     */
    public function testKwInwestycji()
    {
        $value = 1000;
        $this->spolka->setKwInwestycji($value);
        $this->assertEquals($value, $this->spolka->getKwInwestycji());
    }

    /**
     * Test pola KwWsparcia
     */
    public function testKwWsparcia()
    {
        $value = 1000;
        $this->spolka->setKwWsparcia($value);
        $this->assertEquals($value, $this->spolka->getKwWsparcia());
    }

    /**
     * Test pola KwPryw
     */
    public function testKwPryw()
    {
        $value = 1000;
        $this->spolka->setKwPryw($value);
        $this->assertEquals($value, $this->spolka->getKwPryw());
    }

    /**
     * Test pola Zakonczona
     */
    public function testZakonczona()
    {
        $value = '1';
        $this->spolka->setZakonczona($value);
        $this->assertEquals($value, $this->spolka->getZakonczona());
    }

    /**
     * Test pola DataWyjscia(
     */
    public function testDataWyjscia()
    {
        $value = '2017-01-01';
        $this->spolka->setDataWyjscia($value);
        $this->assertEquals($value, $this->spolka->getDataWyjscia());
    }

    /**
     * Test pola KwDezinwestycji
     */
    public function testKwDezinwestycji()
    {
        $value = 1000;
        $this->spolka->setKwDezinwestycji($value);
        $this->assertEquals($value, $this->spolka->getKwDezinwestycji());
    }

    /**
     * Test pola ZwrotInwestycji
     */
    public function testZwrotInwestycji()
    {
        $value = 20;
        $this->spolka->setZwrotInwestycji($value);
        $this->assertEquals($value, $this->spolka->getZwrotInwestycji());
    }

    /**
     * Test pola Npv
     */
    public function testNpv()
    {
        $value = 300;
        $this->spolka->setNpv($value);
        $this->assertEquals($value, $this->spolka->getNpv());
    }

    /**
     * Test pola Udzialowcy
     */
    public function testUdzialowcy()
    {
        $value = 'Lorem ipsum';
        $this->spolka->setUdzialowcy($value);
        $this->assertEquals($value, $this->spolka->getUdzialowcy());
    }

    /**
     * Test pola Prezes
     */
    public function testPrezes()
    {
        $value = 'Lorem ipsum';
        $this->spolka->setPrezes($value);
        $this->assertEquals($value, $this->spolka->getPrezes());
    }

    /**
     * Test pola ZarzadPozostali
     */
    public function testZarzadPozostali()
    {
        $value = 'Lorem ipsum';
        $this->spolka->setZarzadPozostali($value);
        $this->assertEquals($value, $this->spolka->getZarzadPozostali());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->spolka = null;
    }
}
