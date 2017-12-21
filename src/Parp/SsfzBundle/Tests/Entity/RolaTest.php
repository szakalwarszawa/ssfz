<?php
namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Rola;

/**
 * Test encji Rola
 * 
 * @covers \Parp\SsfzBundle\Entity\Rola
 */
class RolaTest extends TestCase
{

    private $rola;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->rola = new Rola();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $rola = new Rola();
        $this->assertNotNull($rola);
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->rola->getId());
    }

    /**
     * Test pola Nazwa
     */
    public function testNazwa()
    {
        $nazwa = 'ROLE_BENEFICJENT';
        $this->rola->setNazwa($nazwa);
        $this->assertEquals($nazwa, $this->rola->getNazwa());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->rola = null;
    }
}
