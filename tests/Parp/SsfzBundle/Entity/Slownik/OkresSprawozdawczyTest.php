<?php

namespace Test\Parp\SsfzBundle\Entity;;

use DateTime;
use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\Slownik\OkresSprawozdawczy;

/**
 * Testy encji OkresSprawozdawczy.
 */
class DanePoreczenTest extends TestCase
{
    /**
     * @var OkresSprawozdawczy
     */
    protected $okresSprawozdawczyRoczny;

    /**
     * @var OkresSprawozdawczy
     */
    protected $okresSprawozdawczyPierwszePolrocze;

        /**
     * @var OkresSprawozdawczy
     */
    protected $okresSprawozdawczyDrugiePolrocze;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->okresSprawozdawczyRoczny = new OkresSprawozdawczy('styczeń-grudzień', 1, 12);
        $this->okresSprawozdawczyPierwszePolrocze = new OkresSprawozdawczy('styczeń-czerwiec', 1, 6);
        $this->okresSprawozdawczyDrugiePolrocze = new OkresSprawozdawczy('lipiec-grudzień', 7, 12);
    }

    public function testCanBeInstantioned()
    {
        $this->assertInstanceOf(OkresSprawozdawczy::class, $this->okresSprawozdawczyRoczny);
        $this->assertInstanceOf(OkresSprawozdawczy::class, $this->okresSprawozdawczyPierwszePolrocze);
        $this->assertInstanceOf(OkresSprawozdawczy::class, $this->okresSprawozdawczyDrugiePolrocze);

        $this->assertInternalType('int', $this->okresSprawozdawczyRoczny->getMiesiacPoczatkowy());
        $this->assertInternalType('int', $this->okresSprawozdawczyRoczny->getMiesiacKoncowy());
        $this->assertInternalType('int', $this->okresSprawozdawczyPierwszePolrocze->getMiesiacPoczatkowy());
        $this->assertInternalType('int', $this->okresSprawozdawczyPierwszePolrocze->getMiesiacKoncowy());
        $this->assertInternalType('int', $this->okresSprawozdawczyDrugiePolrocze->getMiesiacPoczatkowy());
        $this->assertInternalType('int', $this->okresSprawozdawczyDrugiePolrocze->getMiesiacKoncowy());
    }

    public function testCanDetermineIntervals()
    {
        $this->assertTrue($this->okresSprawozdawczyRoczny->jestRoczny());
        $this->assertFalse($this->okresSprawozdawczyRoczny->jestPolroczny());
        $this->assertFalse($this->okresSprawozdawczyRoczny->jestKwartalny());

        $this->assertFalse($this->okresSprawozdawczyPierwszePolrocze->jestRoczny());
        $this->assertTrue($this->okresSprawozdawczyPierwszePolrocze->jestPolroczny());
        $this->assertFalse($this->okresSprawozdawczyPierwszePolrocze->jestKwartalny());

        $this->assertFalse($this->okresSprawozdawczyDrugiePolrocze->jestRoczny());
        $this->assertTrue($this->okresSprawozdawczyDrugiePolrocze->jestPolroczny());
        $this->assertFalse($this->okresSprawozdawczyDrugiePolrocze->jestKwartalny());
    }
}
