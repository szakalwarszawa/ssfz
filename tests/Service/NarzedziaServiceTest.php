<?php

namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\BeneficjentFormaPrawna;
use Parp\SsfzBundle\Entity\Wojewodztwo;
use Parp\SsfzBundle\Entity\GospodarkaDzial;
use Parp\SsfzBundle\Repository\BeneficjentFormaPrawnaRepository;
use Parp\SsfzBundle\Repository\WojewodztwoRepository;
use Parp\SsfzBundle\Repository\GospodarkaDzialRepository;
use Parp\SsfzBundle\Service\NarzedziaService;

/**
 * Testuje klasę NarzedziaService
 *
 * @covers \Parp\SsfzBundle\Service\NarzedziaService
 */
class NarzedziaServiceTest extends TestCase
{
    /**
     *
     * @var BeneficjentFormaPrawnaRepository
     */
    private $dictFormaRepo;
    /**
     *
     * @var WojewodztwoRepository
     */
    private $dictWojRepo;
    /**
     *
     * @var GospodarkaDzialRepository
     */
    private $dictDzialRepo;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->dictFormaRepo = $this
            ->getMockBuilder(BeneficjentFormaPrawnaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dict = new BeneficjentFormaPrawna();
        $this->dictFormaRepo
            ->method('findBy')
            ->will($this->returnValue($dict));

        $this->dictWojRepo = $this
            ->getMockBuilder(WojewodztwoRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dict = new Wojewodztwo();
        $this->dictWojRepo
            ->method('findBy')
            ->will($this->returnValue($dict));

        $this->dictDzialRepo= $this
            ->getMockBuilder(GospodarkaDzialRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dict = new GospodarkaDzial();
        $this->dictDzialRepo
            ->method('findBy')
            ->will($this->returnValue($dict));

        $this->okresyKonfiguracjaRepo= $this
            ->getMockBuilder(OkresyKonfiguracjaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new NarzedziaService($this->dictFormaRepo, $this->dictWojRepo, $this->dictDzialRepo);
    }

    /**
     * Testuje metodę getSlownikBeneficjentFormaPrawna
     */
    public function testGetSlownikBeneficjentFormaPrawna()
    {
        $value = $this->service->getSlownikBeneficjentFormaPrawna();
        $this->assertNotNull($value);
        $this->assertInstanceOf(BeneficjentFormaPrawna::class, $value);
    }

    /**
     * Testuje metodę getSlownikWojewodztwo
     */
    public function testGetSlownikWojewodztwo()
    {
        $value = $this->service->getSlownikWojewodztwo();
        $this->assertNotNull($value);
        $this->assertInstanceOf(Wojewodztwo::class, $value);
    }

    /**
     * Testuje metodę getSlownikGospodarkaDzial
     */
    public function testGetSlownikGospodarkaDzial()
    {
        $value = $this->service->getSlownikGospodarkaDzial();
        $this->assertNotNull($value);
        $this->assertInstanceOf(GospodarkaDzial::class, $value);
    }

    /**
     * Testuje metodę getBeneficjentFormaPrawnaRepo
     */
    public function testGetBeneficjentFormaPrawnaRepo()
    {
        $repo = $this->service->getBeneficjentFormaPrawnaRepo();
        $this->assertNotNull($repo);
        $this->assertInstanceOf(BeneficjentFormaPrawnaRepository::class, $repo);
    }

    /**
     * Testuje metodę getGospodarkaDzialRepo
     */
    public function testGetGospodarkaDzialRepo()
    {
        $repo = $this->service->getGospodarkaDzialRepo();
        $this->assertNotNull($repo);
        $this->assertInstanceOf(GospodarkaDzialRepository::class, $repo);
    }

    /**
     * Testuje metodę getWojewodztwoRepo
     */
    public function testGetWojewodztwoRepo()
    {
        $repo = $this->service->getWojewodztwoRepo();
        $this->assertNotNull($repo);
        $this->assertInstanceOf(WojewodztwoRepository::class, $repo);
    }
}
