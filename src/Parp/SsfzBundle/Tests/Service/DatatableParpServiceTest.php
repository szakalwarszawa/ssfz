<?php
namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;
use Parp\SsfzBundle\Repository\OkresyKonfiguracjaRepository;
use Parp\SsfzBundle\Service\DatatableParpService;

/**
 * Testuje klasę DatatableParpService
 * 
 * @covers \Parp\SsfzBundle\Service\DatatableParpService
 */
class DatatableParpServiceTest extends TestCase
{

    /**
     *
     * @var OkresyKonfiguracjaRepository
     */
    private $okresyKonfiguracjaRepo;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->okresyKonfiguracjaRepo = $this
            ->getMockBuilder(OkresyKonfiguracjaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dict = new OkresyKonfiguracja();
        $this->okresyKonfiguracjaRepo
            ->method('findBy')
            ->will($this->returnValue($dict));

        $this->service = new DatatableParpService($this->okresyKonfiguracjaRepo);
    }

    /**
     * Testuje metodę getParpKonfiguracja
     */
    public function testGetParpKonfiguracja()
    {
        $value = $this->service->getParpKonfiguracja();
        $this->assertNotNull($value);
        $this->assertInstanceOf(OkresyKonfiguracja::class, $value);
    }

    /**
     * Testuje metodę getDatatableParpRenderers
     */
    public function testGetDatatableParpRenderers()
    {
        $config = $this->service->getParpKonfiguracja();
        $renderers[1]['view'] = 'SsfzBundle:Parp:_beneficjentNazwa.html.twig';
        $renderers[2]['view'] = 'SsfzBundle:Parp:_umowaNumer.html.twig';
        $idx = 3;
        foreach ($config as $cfg) {
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:_okresStatus.html.twig';
            $idx++;
            $renderers[$idx]['view'] = 'SsfzBundle:Parp:_okresStatus.html.twig';
            $idx++;
        }

        $value = $this->service->getDatatableParpRenderers($config);
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers);
    }

    /**
     * Testuje metodę getDatatableParpFields
     */
    public function testGetDatatableParpFields()
    {
        $config = $this->service->getParpKonfiguracja();
        $fields['BeneId'] = 'b.id';
        $fields['Nazwa'] = 'b.nazwa';
        $fields['Numer umowy'] = 'u.numer';
        $idx = 1;
        foreach ($config as $cfg) {
            $fields['1 - 6 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
            $idx++;
            $fields['7 - 12 ' . $cfg->getRok()] = 's' . $idx . '.idStatus';
            $idx++;
        }
        $fields['_identifier_'] = 'u.id';

        $value = $this->service->getDatatableParpFields($config);
        $this->assertNotNull($value);
        $this->assertEquals($value, $fields);
    }
}
