<?php

namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Sprawozdanie;
use Parp\SsfzBundle\Entity\Spolka;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *  Tesy encji Umowa
 *
 * @covers \Parp\SsfzBundle\Entity\Umowa
 */
class UmowaTest extends TestCase
{
    private $umowa;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {

        $this->umowa = new Umowa();
    }
    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $umowa = new Umowa();
        $this->assertCount(0, $umowa->getSpolki());
        $this->assertCount(0, $umowa->getSprawozdania());
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->umowa->getId());
    }

    /**
     * Testowanie pola beneficjentId
     */
    public function testBeneficjentId()
    {
        $value = 1;
        $this->umowa->setBeneficjentId($value);
        $this->assertEquals($value, $this->umowa->getBeneficjentId());
    }

    /**
     * Testowanie pola beneficjent
     */
    public function testBeneficjent()
    {
        $value = new Beneficjent();
        $this->umowa->setBeneficjent($value);
        $this->assertEquals($value, $this->umowa->getBeneficjent());
    }

    /**
     * Testownaia pola numer
     */
    public function testNumer()
    {
        $value = 'Lorem/23333/Ipsum';
        $this->umowa->setNumer($value);
        $this->assertEquals($value, $this->umowa->getNumer());
    }

    /**
     * Testownaia pola spolki
     */
    public function testSpolki()
    {
        $value1 = new Spolka();
        $value2 = new Spolka();
        $this->umowa->addSpolka($value1);
        $this->umowa->addSpolka($value2);
        $this->assertCount(2, $this->umowa->getSpolki());
        $this->umowa->setSpolki(new ArrayCollection());
        $this->assertCount(0, $this->umowa->getSpolki());
    }

    /**
     * Testownaia pola sprawozdania
     */
    public function testSprawozdania()
    {
        $value1 = new Sprawozdanie();
        $value2 = new Sprawozdanie();
        $this->umowa->addSprawozdanie($value1);
        $this->umowa->addSprawozdanie($value2);
        $this->assertCount(2, $this->umowa->getSprawozdania());
        $this->umowa->setSprawozdania(new ArrayCollection());
        $this->assertCount(0, $this->umowa->getSprawozdania());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->umowa = null;
    }
}
