<?php

namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Description of SprawozdanieTest
 *
 * @author adamw
 */
class SprawozdanieTest extends TestCase
{
    private $sprawozdanie;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->sprawozdanie = new \Parp\SsfzBundle\Entity\Sprawozdanie();
    }

    /**
     * Testowanie pola id
     */
    public function testId()
    {
        $var = 5;
        $this->sprawozdanie->setId($var);
        $this->assertEquals($var, $this->sprawozdanie->getId());
    }

    /**
     * Testowanie pola creatorId
     */
    public function testCreatorId()
    {
        $var = 5;
        $this->sprawozdanie->setCreatorId($var);
        $this->assertEquals($var, $this->sprawozdanie->getCreatorId());
    }

    /**
     * Testowanie pola DataRejestracji
     */
    public function testDataRejestracji()
    {
        $var = 5;
        $this->sprawozdanie->setDataRejestracji($var);
        $this->assertEquals($var, $this->sprawozdanie->getDataRejestracji());
    }

    /**
     * Testowanie pola umowaId
     */
    public function testUmowaId()
    {
        $var = 5;
        $this->sprawozdanie->setUmowaId($var);
        $this->assertEquals($var, $this->sprawozdanie->getUmowaId());
    }

    /**
     * Testowanie pola previousVersionId
     */
    public function testPreviousVersionId()
    {
        $var = 5;
        $this->sprawozdanie->setPreviousVersionId($var);
        $this->assertEquals($var, $this->sprawozdanie->getPreviousVersionId());
    }

    /**
     * Testowanie pola umowa
     */
    public function testUmowa()
    {
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $umowa->setBeneficjentId(12);
        $this->sprawozdanie->setUmowa($umowa);
        $this->assertEquals($umowa->getBeneficjentId(), $this->sprawozdanie->getUmowa()->getBeneficjentId());
    }

    /**
     * Testowanie pola numerUmowy
     */
    public function testNumerUmowy()
    {
        $var = '1/1/2017';
        $this->sprawozdanie->setNumerUmowy($var);
        $this->assertEquals($var, $this->sprawozdanie->getNumerUmowy());
    }

    /**
     * Testowanie pola okres
     */
    public function testOkres()
    {
        $var = 'styczeń - czerwiec';
        $this->sprawozdanie->setOkres($var);
        $this->assertEquals($var, $this->sprawozdanie->getOkres());
    }

    /**
     * Testowanie pola okresId
     */
    public function testOkresId()
    {
        $var = 1;
        $this->sprawozdanie->setOkresId($var);
        $this->assertEquals($var, $this->sprawozdanie->getOkresId());
    }

    /**
     * Testowanie pola rok
     */
    public function testRok()
    {
        $var = '2015';
        $this->sprawozdanie->setRok($var);
        $this->assertEquals($var, $this->sprawozdanie->getRok());
    }

    /**
     * Testowanie pola status
     */
    public function testStatus()
    {
        $var = 2;
        $this->sprawozdanie->setStatus($var);
        $this->assertEquals($var, $this->sprawozdanie->getStatus());
    }

    /**
     * Testowanie pola wersja
     */
    public function testWersja()
    {
        $var = 1;
        $this->sprawozdanie->setWersja($var);
        $this->assertEquals($var, $this->sprawozdanie->getWersja());
    }

    /**
     * Testowanie pola czyNajnowsza
     */
    public function testCzyNajnowsza()
    {
        $var = true;
        $this->sprawozdanie->setCzyNajnowsza($var);
        $this->assertEquals($var, $this->sprawozdanie->getCzyNajnowsza());
    }

    /**
     * Testowanie pola dataPrzeslaniaDoParp
     */
    public function testDataPrzeslaniaDoParp()
    {
        $var = new \DateTime('now');
        $this->sprawozdanie->setDataPrzeslaniaDoParp($var);
        $this->assertEquals($var, $this->sprawozdanie->getDataPrzeslaniaDoParp());
    }

    /**
     * Testowanie pola oceniajacyId
     */
    public function testOceniajacyId()
    {
        $var = 12;
        $this->sprawozdanie->setOceniajacyId($var);
        $this->assertEquals($var, $this->sprawozdanie->getOceniajacyId());
    }

    /**
     * Testowanie pola dataZatwierdzenia
     */
    public function testDataZatwierdzenia()
    {
        $var = new \DateTime('now');
        $this->sprawozdanie->setDataZatwierdzenia($var);
        $this->assertEquals($var, $this->sprawozdanie->getDataZatwierdzenia());
    }

    /**
     * Testowanie pola uwagi
     */
    public function testUwagi()
    {
        $var = 12;
        $this->sprawozdanie->setUwagi($var);
        $this->assertEquals($var, $this->sprawozdanie->getUwagi());
    }

    /**
     * Testowanie pola idStatus
     */
    public function testIdStatus()
    {
        $var = 12;
        $this->sprawozdanie->setIdStatus($var);
        $this->assertEquals($var, $this->sprawozdanie->getIdStatus());
    }

    /**
     * Testowanie pola sprawozdaniaSpolek
     */
    public function testSprawozdaniaSpolek()
    {
        $sprawozdanieSpolki = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
        $sprawozdanieSpolki->setNazwaSpolki('Spolka testowa 1');
        $sprawozdanieSpolki->setKrs('11111111');
        $sprawozdanieSpolki->setLiczbaPorzadkowa(1);
        $this->sprawozdanie->addSprawozdaniaSpolek($sprawozdanieSpolki);
        $sprawozdanieSpolki2 = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
        $sprawozdanieSpolki2->setNazwaSpolki('Spolka testowa 2');
        $sprawozdanieSpolki2->setKrs('22222222');
        $sprawozdanieSpolki2->setLiczbaPorzadkowa(2);
        $this->sprawozdanie->addSprawozdaniaSpolek($sprawozdanieSpolki2);
        $this->assertEquals(2, count($this->sprawozdanie->getSprawozdaniaSpolek()));
        $this->sprawozdanie->removeSprawozdaniaSpolek($sprawozdanieSpolki);
        $this->assertEquals(1, count($this->sprawozdanie->getSprawozdaniaSpolek()));
    }

    /**
     * Testowanie pola sprawozdaniaSpolek
     */
    public function testSprawozdaniaSpolek2()
    {
        $sprawozdanieSpolki = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
        $sprawozdanieSpolki->setNazwaSpolki('Spolka testowa 1');
        $sprawozdanieSpolki->setKrs('11111111');
        $sprawozdanieSpolki->setLiczbaPorzadkowa(1);
        $sprawozdanieSpolki2 = new \Parp\SsfzBundle\Entity\SprawozdanieSpolki();
        $sprawozdanieSpolki2->setNazwaSpolki('Spolka testowa 2');
        $sprawozdanieSpolki2->setKrs('22222222');
        $sprawozdanieSpolki2->setLiczbaPorzadkowa(2);
        $spolki = array($sprawozdanieSpolki,$sprawozdanieSpolki2);
        $this->sprawozdanie->setSprawozdaniaSpolek($spolki);
        $this->assertEquals(2, count($this->sprawozdanie->getSprawozdaniaSpolek()));
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->sprawozdanie = null;
    }
}
