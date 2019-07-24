<?php

namespace Test\Parp\SsfzBundle\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Slownik\FormaPrawnaBeneficjenta;

/**
 * Test encji FormaPrawnaBeneficjenta
 */
class FormaPrawnaBeneficjentaTest extends TestCase
{
    private $beneficjentFormaPrawna;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->beneficjentFormaPrawna = new FormaPrawnaBeneficjenta();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $beneficjentFormaPrawna = new FormaPrawnaBeneficjenta();
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
