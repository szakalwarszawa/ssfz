<?php
namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;

/**
 *  Tesy encji OkresyKonfiguracja
 * 
 * @covers \Parp\SsfzBundle\Entity\OkresyKonfiguracja
 */
class OkresyKonfiguracjaTest extends TestCase
{
    private $konfiguracja;
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp() 
    {
        $this->konfiguracja = new OkresyKonfiguracja();        
    }
    
    /**
     * Test pola Id
     */
    public function testId() 
    {
        $this->assertNull($this->konfiguracja->getId());
    }
    /**
     * Test pola rok
     */
    public function testRok() 
    {
        $value = 1;
        $this->konfiguracja->setRok($value);
        $this->assertEquals($value, $this->konfiguracja->getRok());
    }     
    /**
     * Test pola o1u
     */
    public function testO1u() 
    {
        $value = 1;
        $this->konfiguracja->setO1u($value);
        $this->assertEquals($value, $this->konfiguracja->getO1u());
    }  
    /**
     * Test pola o2u
     */
    public function testO2u() 
    {
        $value = 1;
        $this->konfiguracja->setO2u($value);
        $this->assertEquals($value, $this->konfiguracja->getO2u());
    }       
    
    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown() 
    {
        $this->konfiguracja = null;
    }
}
