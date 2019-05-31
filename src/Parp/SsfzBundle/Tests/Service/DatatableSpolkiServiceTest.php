<?php

namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Service\DatatableSpolkiService;

/**
 * Testuje klasę DatatableSpolkiService
 *
 * @covers \Parp\SsfzBundle\Service\DatatableSpolkiService
 */
class DatatableSpolkiServiceTest extends TestCase
{
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->service = new DatatableSpolkiService();
    }

    /**
     * Testuje metodę getDatatableSpolkiFields
     */
    public function testGetDatatableSpolkiFields()
    {
        $fields =  array(
                    'Lp.' => 's.liczbaPorzadkowa',
                    'Nazwa spółki' => 's.nazwa',
                    'Forma prawna' => 's.forma',
                    'Siedziba (Miasto)' => 's.siedzibaMiasto',
                    'Siedziba (Województwo)' => 's.siedzibaWojewodztwo',
                    'Branża' => 's.branza',
                    'Krótki opis przedmiotu działalności' => 's.opis',
                    'Data powołanis spółki' => 's.dataPowolania',
                    'Nr KRS' => 's.krs',
                    'NIP' => 's.nip',
                    'Kwota inwestycji beneficjenta' => 's.kwInwestycji',
                    'W tym ze środków wsparcia' => 's.kwWsparcia',
                    'W tym ze środków prywatnych' => 's.kwPryw',
                    'Czy inwestycja zakończona' => 's.zakonczona',
                    'Data wyjścia z inwestycji' => 's.dataWyjscia',
                    'Kwota uzyskana z dezinwestycji' => 's.kwDezinwestycji',
                    'Zwrot inwestycji' => 's.zwrotInwestycji',
                    'NPV' => 's.npv',
                    'Udziałowcy' => 's.udzialowcy',
                    'Prezes Zarządu' => 's.prezes',
                    'Pozostali Członkowie Zarządu' => 's.zarzadPozostali',
                    'ZakonczonaRaw' => 's.zakonczona',
                    ' ' => 's.id',
                    '  ' => 's.id',
                    '_identifier_' => 's.id');
        $value = $this->service->getDatatableSpolkiFields();
        $this->assertNotNull($value);
        $this->assertEquals($value, $fields);
    }

    /**
     * Testuje metodę getDatatableSpolkiRenderers
     */
    public function testGetDatatableSpolkiRenderers()
    {
        $renderers[14]['view'] = 'SsfzBundle:Beneficjent:_date.html.twig';
        $renderers[7]['view'] = 'SsfzBundle:Beneficjent:_date.html.twig';
        $renderers[13]['view'] = 'SsfzBundle:Portfel:_zakonczona.html.twig';
        $renderers[22]['view'] = 'SsfzBundle:Portfel:_spolkaActions.html.twig';
        $renderers[23]['view'] = 'SsfzBundle:Parp:_portfelActions.html.twig';
        $value = $this->service->getDatatableSpolkiRenderers();
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers);
    }
}
