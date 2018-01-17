<?php
namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Service\DatatableUmowyService;

/**
 * Testuje klasę DatatableUmowyService
 * 
 * @covers \Parp\SsfzBundle\Service\DatatableUmowyService
 */
class DatatableUmowyServiceTest extends TestCase
{

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->service = new DatatableUmowyService();
    }

    /**
     * Testuje metodę getDatatableUmowyFields
     */
    public function testGetDatatableUmowyFields()
    {
        $renderers = array(
            'Numer umowy' => 'u.numer',
            '' => 'u.id',
            '_identifier_' => 'u.id');
        $value = $this->service->getDatatableUmowyFields();
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers);
    }

    /**
     * Testuje metodę getDatatableUmowyRenderers
     */
    public function testGetDatatableUmowyRenderers()
    {
        $renderers = array(
            1 => array(
                'view' => 'SsfzBundle:Beneficjent:_umowaActions.html.twig',
            )
        );
        $value = $this->service->getDatatableUmowyRenderers();
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers);
    }
}
