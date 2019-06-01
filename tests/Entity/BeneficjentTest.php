<?php

namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\OsobaZatrudniona;
use Parp\SsfzBundle\Entity\Umowa;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tesy encji Beneficjent
 *
 * @covers \Parp\SsfzBundle\Entity\Beneficjent
 */
class BeneficjentTest extends TestCase
{
    private $beneficjent;
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->beneficjent = new Beneficjent();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $beneficjent = new Beneficjent();
        $this->assertCount(0, $beneficjent->getUmowy());
        $this->assertCount(0, $beneficjent->getUzytkownicy());
        $this->assertCount(0, $beneficjent->getOsobyZatrudnione());
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->beneficjent->getId());
    }

    /**
     * Testownaia pola adrWojewodztwo
     */
    public function testAdrWojewodztwo()
    {
        $adrWojewodztwo = 'podlaskie';
        $this->beneficjent->setAdrWojewodztwo($adrWojewodztwo);
        $this->assertEquals($adrWojewodztwo, $this->beneficjent->getAdrWojewodztwo());
    }

    /**
     * Testownaia pola adrMiejscowosc
     */
    public function testAdrMiejscowosc()
    {
        $adrMiejscowosc = 'Lorem Ipsum';
        $this->beneficjent->setAdrMiejscowosc($adrMiejscowosc);
        $this->assertEquals($adrMiejscowosc, $this->beneficjent->getAdrMiejscowosc());
    }

    /**
     * Testownaia pola adrUlica
     */
    public function testAdrUlica()
    {
        $adrUlica = 'Lorem Ipsum';
        $this->beneficjent->setAdrUlica($adrUlica);
        $this->assertEquals($adrUlica, $this->beneficjent->getAdrUlica());
    }

    /**
     * Testownaia pola adrBudynek
     */
    public function testAdrBudynek()
    {
        $adrBudynek = '12A';
        $this->beneficjent->setAdrBudynek($adrBudynek);
        $this->assertEquals($adrBudynek, $this->beneficjent->getAdrBudynek());
    }

    /**
     * Testownaia pola adrLokal
     */
    public function testAdrLokal()
    {
        $adrLokal = '1b';
        $this->beneficjent->setAdrLokal($adrLokal);
        $this->assertEquals($adrLokal, $this->beneficjent->getAdrLokal());
    }

    /**
     * Testownaia pola adrKod
     */
    public function testAdrKod()
    {
        $adrKod = '12-345';
        $this->beneficjent->setAdrKod($adrKod);
        $this->assertEquals($adrKod, $this->beneficjent->getAdrKod());
    }

    /**
     * Testownaia pola adrPoczta
     */
    public function testAdrPoczta()
    {
        $adrPoczta = 'Lorem Ipsum';
        $this->beneficjent->setAdrPoczta($adrPoczta);
        $this->assertEquals($adrPoczta, $this->beneficjent->getAdrPoczta());
    }

    /**
     * Testownaia pola telStacjonarny
     */
    public function testTelStacjonarny()
    {
        $telStacjonarny = '000 0000-0000';
        $this->beneficjent->setTelStacjonarny($telStacjonarny);
        $this->assertEquals($telStacjonarny, $this->beneficjent->getTelStacjonarny());
    }

    /**
     * Testownaia pola telKomorkowy
     */
    public function testTelKomorkowy()
    {
        $telKomorkowy = '000 0000-0000';
        $this->beneficjent->setTelKomorkowy($telKomorkowy);
        $this->assertEquals($telKomorkowy, $this->beneficjent->getTelKomorkowy());
    }

    /**
     * Testownaia pola email
     */
    public function testEmail()
    {
        $email = 'lorem@ipsum.dolor';
        $this->beneficjent->setEmail($email);
        $this->assertEquals($email, $this->beneficjent->getEmail());
    }

    /**
     * Testownaia pola fax
     */
    public function testFax()
    {
        $fax = '000 0000-0000';
        $this->beneficjent->setFax($fax);
        $this->assertEquals($fax, $this->beneficjent->getFax());
    }

    /**
     * Testownaia pola wypelniony
     */
    public function testWypelniony()
    {
        $wypelniony = true;
        $this->beneficjent->setWypelniony($wypelniony);
        $this->assertEquals($wypelniony, $this->beneficjent->getWypelniony());
    }

    /**
     * Testownaia pola osobyZatrudnione
     */
    public function testOsobyZatrudnione()
    {
        $osobaZatrudniona1 = new OsobaZatrudniona();
        $osobaZatrudniona2 = new OsobaZatrudniona();
        $this->beneficjent->addOsobaZatrudniona($osobaZatrudniona1);
        $this->beneficjent->addOsobaZatrudniona($osobaZatrudniona2);
        $this->assertCount(2, $this->beneficjent->getOsobyZatrudnione());
        $this->beneficjent->setOsobyZatrudnione(new ArrayCollection());
        $this->assertCount(0, $this->beneficjent->getOsobyZatrudnione());
    }

    /**
     * Testownaia pola umowy
     */
    public function testUmowy()
    {
        $umowa1 = new Umowa();
        $umowa2 = new Umowa();
        $this->beneficjent->addUmowa($umowa1);
        $this->beneficjent->addUmowa($umowa2);
        $this->assertCount(2, $this->beneficjent->getUmowy());
        $this->beneficjent->removeUmowa($umowa2);
        $this->assertCount(1, $this->beneficjent->getUmowy());
        $this->beneficjent->setUmowy(new ArrayCollection());
        $this->assertCount(0, $this->beneficjent->getUmowy());
    }
    /**
     * Testowanie pola uzytkownicy
     */
    public function testUzytkownicy()
    {
        $this->assertCount(0, $this->beneficjent->getUzytkownicy());
    }
    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->beneficjent = null;
    }
}
