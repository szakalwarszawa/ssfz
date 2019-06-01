<?php

namespace Test\Parp\SsfzBundle\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\BeneficjentFormaPrawna;

/**
 * Test encji BeneficjentFormaPrawna
 *
 * @covers \Parp\SsfzBundle\Entity\BeneficjentFormaPrawna
 */
class BeneficjentFormaPrawnaTest extends TestCase
{
    private $beneficjentFormaPrawna;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->beneficjentFormaPrawna = new BeneficjentFormaPrawna();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $beneficjentFormaPrawna = new BeneficjentFormaPrawna();
        $this->assertNotNull($beneficjentFormaPrawna);
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->beneficjentFormaPrawna->getId());
    }

    /**
     * Test pola Nazwa
     */
    public function testNazwa()
    {
        $nazwa = 'Spółka z o.o.';
        $this->beneficjentFormaPrawna->setNazwa($nazwa);
        $this->assertEquals($nazwa, $this->beneficjentFormaPrawna->getNazwa());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->beneficjent = null;
    }
}
