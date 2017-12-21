<?php
namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\OsobaZatrudniona;

/**
 *  Tesy encji OsobaZatrudniona
 * 
 * @covers \Parp\SsfzBundle\Entity\OsobaZatrudniona
 */
class OsobaZartrudnionaTest extends TestCase
{
    private $osobaZatrudniona;
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp() 
    {
        $this->osobaZatrudniona = new OsobaZatrudniona();        
    }

    /**
     * Test pola Id
     */
    public function testId() 
    {
        $this->assertNull($this->osobaZatrudniona->getId());
    }    
   
    /**
     * Testowanie pola beneficjentId 
     */
    public function testBeneficjentId() 
    {
        $value = 1;
        $this->osobaZatrudniona->setBeneficjentId($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getBeneficjentId());
    }     

    /**
     * Testowanie pola beneficjent 
     */
    public function testBeneficjent() 
    {
        $value = new Beneficjent();
        $this->osobaZatrudniona->setBeneficjent($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getBeneficjent());
    }  

    /**
     * Testowanie pola imie
     */
    public function testImie() 
    {
        $value = 'Imię';
        $this->osobaZatrudniona->setImie($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getImie());
    }  

    /**
     * Testowanie pola nazwisko
     */
    public function testNazwisko() 
    {
        $value = 'Nazwisko';
        $this->osobaZatrudniona->setNazwisko($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getNazwisko());
    }  

    /**
     * Testowanie pola umowaRodzaj
     */
    public function testUmowaRodzaj() 
    {
        $value = 'na czas nieokreślony';
        $this->osobaZatrudniona->setUmowaRodzaj($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getUmowaRodzaj());
    }  

    /**
     * Testowanie pola umowaData
     */
    public function testUmowaData() 
    {
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $this->osobaZatrudniona->setUmowaData($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getUmowaData());
    }      
    
    /**
     * Testowanie pola rozpoczecieData
     */
    public function testRozpoczecieData() 
    {
        $s = '1/1/2017 11:36:12 AM';
        $value = new \DateTime($s);
        $this->osobaZatrudniona->setRozpoczecieData($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getRozpoczecieData());
    }  

    /**
     * Testowanie pola stanowisko
     */
    public function testStanowisko() 
    {
        $value = 'stanowisko';
        $this->osobaZatrudniona->setStanowisko($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getStanowisko());
    }  
 
    /**
     * Testowanie pola wymiar
     */
    public function testWymiar() 
    {
        $value = '1/1';
        $this->osobaZatrudniona->setWymiar($value);
        $this->assertEquals($value, $this->osobaZatrudniona->getWymiar());
    } 
    
    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown() 
    {
        $this->osobaZatrudniona = null;
    }
}
