<?php
namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Service\DatatableOsobyService;

/**
 * Testuje klasę DatatableOsobyService
 * 
 * @covers \Parp\SsfzBundle\Service\DatatableOsobyService
 */
class DatatableOsobyServiceTest extends TestCase
{

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->service = new DatatableOsobyService();
    }

    /**
     * Testuje metodę getDatatableOsobyFields
     */
    public function testGetDatatableOsobyFields()
    {
        $compare = array(
            'Imię' => 'o.imie',
            'Imię i nazwisko' => 'o.nazwisko',
            'Rodzaj umowy' => 'o.umowaRodzaj',
            'Data zawarcia umowy' => 'o.umowaData',
            'Data rozpoczęcia pracy' => 'o.rozpoczecieData',
            'Stanowisko' => 'o.stanowisko',
            'Wymiar etatu' => 'o.wymiar',
            '_identifier_' => 'o.id'
        );
        $value = $this->service->getDatatableOsobyFields();
        $this->assertNotNull($value);
        $this->assertEquals($value, $compare);
    }

    /**
     * Testuje metodę getDatatableOsobyRenderers
     */
    public function testGetDatatableOsobyRenderers()
    {
        $renderers = array(
            1 => array(
                'view' => 'SsfzBundle:Beneficjent:_osobaZatrudnionaFullName.html.twig',
            ),
            3 => array(
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            ),
            4 => array(
                'view' => 'SsfzBundle:Beneficjent:_date.html.twig',
            )
        );
        $value = $this->service->getDatatableOsobyRenderers();
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers);
    }
}
