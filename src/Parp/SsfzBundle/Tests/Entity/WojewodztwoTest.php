<?php
namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Wojewodztwo;

/**
 * Test encji Wojewodztwo
 * 
 * @covers \Parp\SsfzBundle\Entity\Wojewodztwo
 */
class WojewodztwoTest extends TestCase
{

    private $wojewodztwo;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->wojewodztwo = new Wojewodztwo();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $wojewodztwo = new Wojewodztwo();
        $this->assertNotNull($wojewodztwo);
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->wojewodztwo->getId());
    }

    /**
     * Test pola Nazwa
     */
    public function testNazwa()
    {
        $nazwa = 'PODLASKIE';
        $this->wojewodztwo->setNazwa($nazwa);
        $this->assertEquals($nazwa, $this->wojewodztwo->getNazwa());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->wojewodztwo = null;
    }
}
