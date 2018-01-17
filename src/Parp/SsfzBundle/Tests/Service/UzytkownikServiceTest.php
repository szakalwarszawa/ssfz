<?php
namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Entity\Rola;
use Parp\SsfzBundle\Repository\UzytkownikRepository;
use Parp\SsfzBundle\Repository\RolaRepository;
use Parp\SsfzBundle\Service\UzytkownikService;

/**
 * Testuje klasę UzytkownikService
 * 
 * @covers \Parp\SsfzBundle\Service\UzytkownikService
 */
class UzytkownikServiceTest extends TestCase
{

    /**
     *
     * @var UzytkownikRepository
     */
    private $uzytkownikRepository;

    /**
     *
     * @var RolaRepository
     */
    private $rolaRepository;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->uzytkownikRepository = $this
            ->getMockBuilder(UzytkownikRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $uzytkownik = new Uzytkownik();
        $this->uzytkownikRepository
            ->method('persist')
            ->will($this->returnValue($uzytkownik));


        $this->rolaRepository = $this
            ->getMockBuilder(RolaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new UzytkownikService($this->uzytkownikRepository, $this->rolaRepository);
    }

    /**
     * Testuje metodę getUzytkownikRepository
     */
    public function testGetUzytkownikRepository()
    {
        $uzytkownikRepository = $this->service->getUzytkownikRepository();
        $this->assertNotNull($uzytkownikRepository);
        $this->assertInstanceOf(UzytkownikRepository::class, $uzytkownikRepository);
    }

}
