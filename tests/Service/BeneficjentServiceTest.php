<?php

namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Beneficjent;
use Parp\SsfzBundle\Entity\OsobaZatrudniona;
use Parp\SsfzBundle\Entity\Umowa;
use Parp\SsfzBundle\Entity\Uzytkownik;
use Parp\SsfzBundle\Repository\BeneficjentRepository;
use Parp\SsfzBundle\Repository\UmowaRepository;
use Parp\SsfzBundle\Repository\OsobaZatrudnionaRepository;
use Parp\SsfzBundle\Service\BeneficjentService;

/**
 * Testuje klasę BeneficjentService
 *
 * @covers \Parp\SsfzBundle\Service\BeneficjentService
 */
class BeneficjentServiceTest extends TestCase
{
    /**
     * @var BeneficjentRepository
     */
    private $beneficjentRepository;

    /**
     * @var UmowaRepository
     */
    private $umowaRepository;

    /**
     * @var OsobaZatrudnionaRepository
     */
    private $osobaZatrudnionaRepository;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->beneficjentRepository = $this
            ->getMockBuilder(BeneficjentRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $beneficjent = new Beneficjent();
        $this->beneficjentRepository
            ->method('addNewBeneficjent')
            ->will($this->returnValue($beneficjent));


        $this->umowaRepository = $this
            ->getMockBuilder(UmowaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->osobaZatrudnionaRepository = $this
            ->getMockBuilder(OsobaZatrudnionaRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new BeneficjentService($this->beneficjentRepository, $this->umowaRepository, $this->osobaZatrudnionaRepository);
    }

    /**
     * Testuje metodę getBeneficjentUmowy
     */
    public function testGetBeneficjentUmowy()
    {
        $beneficjent = new Beneficjent();
        $beneficjent->addUmowa(new Umowa());
        $umowy = $this->service->getBeneficjentUmowy($beneficjent);
        $this->assertNotNull($umowy);
        foreach ($umowy as $umowa) {
            $this->assertInstanceOf(Umowa::class, $umowa);
        }
    }

    /**
     * Testuje metodę getBeneficjentOsoby
     */
    public function testGetBeneficjentOsoby()
    {
        $beneficjent = new Beneficjent();
        $beneficjent->addOsobaZatrudniona(new OsobaZatrudniona());
        $osoby = $this->service->getBeneficjentOsoby($beneficjent);
        $this->assertNotNull($osoby);
        foreach ($osoby as $osoba) {
            $this->assertInstanceOf(OsobaZatrudniona::class, $osoba);
        }
    }

    /**
     * Testuje metodę addUmowaOsobaIfEmpty
     */
    public function testAddUmowaOsobaIfEmpty()
    {
        $beneficjent = new Beneficjent();
        $this->service->addUmowaOsobaIfEmpty($beneficjent);
        $this->assertNotNull($beneficjent->getOsobyZatrudnione());
        $this->assertNotNull($beneficjent->getUmowy());
        $this->assertCount(1, $beneficjent->getOsobyZatrudnione());
        $this->assertCount(1, $beneficjent->getUmowy());
        foreach ($beneficjent->getOsobyZatrudnione() as $osoba) {
            $this->assertInstanceOf(OsobaZatrudniona::class, $osoba);
        }
        foreach ($beneficjent->getUmowy() as $umowa) {
            $this->assertInstanceOf(Umowa::class, $umowa);
        }
    }

    /**
     * Testuje metodę addBeneficjent
     */
    public function testAddBeneficjent()
    {
        $uzytkownik = new Uzytkownik();
        $beneficjent = $this->service->addBeneficjent($uzytkownik);
        $this->assertNotNull($beneficjent);
        $this->assertNotNull($beneficjent->getUzytkownicy());
    }

    /**
     * Testuje metodę updateBeneficjent
     */
    public function testUpdateBeneficjent()
    {
        $beneficjent = new Beneficjent();
        $this->service->updateBeneficjent($beneficjent, new \Doctrine\Common\Collections\ArrayCollection(), new \Doctrine\Common\Collections\ArrayCollection());
        $this->assertNotNull($beneficjent);
    }

    /**
     * Testuje metodę getBeneficjentRepository
     */
    public function testGetBeneficjentRepository()
    {
        $beneficjentRepository = $this->service->getBeneficjentRepository();
        $this->assertNotNull($beneficjentRepository);
        $this->assertInstanceOf(BeneficjentRepository::class, $beneficjentRepository);
    }

    /**
     * Testuje metodę getUmowaRepository
     */
    public function testGetUmowaRepository()
    {
        $umowaRepository = $this->service->getUmowaRepository();
        $this->assertNotNull($umowaRepository);
        $this->assertInstanceOf(UmowaRepository::class, $umowaRepository);
    }

    /**
     * Testuje metodę getOsobaZatrudnionaRepository
     */
    public function testGetOsobaZatrudnionaRepository()
    {
        $osobaZatrudnionaRepository = $this->service->getOsobaZatrudnionaRepository();
        $this->assertNotNull($osobaZatrudnionaRepository);
        $this->assertInstanceOf(OsobaZatrudnionaRepository::class, $osobaZatrudnionaRepository);
    }
}
