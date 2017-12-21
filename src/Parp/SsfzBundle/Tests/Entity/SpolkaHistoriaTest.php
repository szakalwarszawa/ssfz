<?php
namespace Parp\SsfzBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\SpolkaHistoria;
use Carbon\Carbon;

/**
 *  Tesy encji SpolkaHistoria
 * 
 * @covers \Parp\SsfzBundle\Entity\SpolkaHistoria
 */
class SpolkaHistoriaTest extends TestCase
{
    private $spolkaHistoria;
    /**
     * Ustawienie środowiska testowego
     */
    public function setUp() 
    {
        $this->spolkaHistoria = new SpolkaHistoria();        
    }
    
    /**
     * Test pola Id
     */
    public function testId() 
    {
        $this->assertNull($this->spolkaHistoria->getId());
    }
    /**
     * Test pola SpolkaId
     */
    public function testSpolkaId()
    {
        $value = 1;
        $this->spolkaHistoria->setSpolkaId($value);
        $this->assertEquals($value, $this->spolkaHistoria->getSpolkaId());       
    }
    /**
     * Test pola UzytkownikId
     */    
    public function testUzytkownikId()
    {
        $value = 1;
        $this->spolkaHistoria->setUzytkownikId($value);
        $this->assertEquals($value, $this->spolkaHistoria->getUzytkownikId());        
    }
    /**
     * Test pola DataZmiany
     */
    public function testDataZmiany()
    {
        $value = new Carbon('Europe/Warsaw');;
        $this->spolkaHistoria->setDataZmiany($value);
        $this->assertEquals($value, $this->spolkaHistoria->getDataZmiany());         
    }
    /**
     * Test pola UmowaId
     */
    public function testUmowaId()
    {
        $value = 1;
        $this->spolkaHistoria->setUmowaId($value);
        $this->assertEquals($value, $this->spolkaHistoria->getUmowaId());
    }
    /**
     * Test pola Lp
     */
    public function testLp()
    {
        $value = 1;
        $this->spolkaHistoria->setLp($value);
        $this->assertEquals($value, $this->spolkaHistoria->getLp());
    }
    /**
     * Test pola Nazwa
     */
    public function testNazwa()
    {
        $value = 'Lorem';
        $this->spolkaHistoria->setNazwa($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNazwa());
    }
    /**
     * Test pola Forma
     */
    public function testForma()
    {
        $value = 'Ipsum';
        $this->spolkaHistoria->setForma($value);
        $this->assertEquals($value, $this->spolkaHistoria->getForma());
    }
    /**
     * Test pola SiedzibaMiasto
     */
    public function testSiedzibaMiasto()
    {
        $value = 'Lorem';
        $this->spolkaHistoria->setSiedzibaMiasto($value);
        $this->assertEquals($value, $this->spolkaHistoria->getSiedzibaMiasto());
    }
    /**
     * Test pola SiedzibaWojewodztwo
     */
    public function testSiedzibaWojewodztwo()
    {
        $value = 'PODLASKIE';
        $this->spolkaHistoria->setSiedzibaWojewodztwo($value);
        $this->assertEquals($value, $this->spolkaHistoria->getSiedzibaWojewodztwo());
    }
    /**
     * Test pola Branza
     */
    public function testBranza()
    {
        $value = 'IT';
        $this->spolkaHistoria->setBranza($value);
        $this->assertEquals($value, $this->spolkaHistoria->getBranza());
    }
    /**
     * Test pola Opis
     */
    public function testOpis()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setOpis($value);
        $this->assertEquals($value, $this->spolkaHistoria->getOpis());
    }
    /**
     * Test pola DataPowolania
     */
    public function testDataPowolania()
    {
        $value = '2017-01-01';
        $this->spolkaHistoria->setDataPowolania($value);
        $this->assertEquals($value, $this->spolkaHistoria->getDataPowolania());
    }
    /**
     * Test pola Krs
     */
    public function testKrs()
    {
        $value = '1111111111';
        $this->spolkaHistoria->setKrs($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKrs());
    }
    /**
     * Test pola Nip
     */
    public function testNip()
    {
        $value = '11111111111';
        $this->spolkaHistoria->setNip($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNip());
    }
    /**
     * Test pola KwInwestycji
     */
    public function testKwInwestycji()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwInwestycji($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwInwestycji());
    }
    /**
     * Test pola KwWsparcia
     */
    public function testKwWsparcia()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwWsparcia($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwWsparcia());
    }
    /**
     * Test pola KwPryw
     */
    public function testKwPryw()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwPryw($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwPryw());
    }
    /**
     * Test pola Zakonczona
     */
    public function testZakonczona()
    {
        $value = '1';
        $this->spolkaHistoria->setZakonczona($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZakonczona());
    }
    /**
     * Test pola DataWyjscia
     */
    public function testDataWyjscia()
    {
        $value = '2017-01-01';
        $this->spolkaHistoria->setDataWyjscia($value);
        $this->assertEquals($value, $this->spolkaHistoria->getDataWyjscia());
    }
    /**
     * Test pola KwDezinwestycji
     */
    public function testKwDezinwestycji()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwDezinwestycji($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwDezinwestycji());
    }
    /**
     * Test pola ZwrotInwestycji
     */
    public function testZwrotInwestycji()
    {
        $value = 20;
        $this->spolkaHistoria->setZwrotInwestycji($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZwrotInwestycji());
    }
    /**
     * Test pola Npv
     */
    public function testNpv()
    {
        $value = 300;
        $this->spolkaHistoria->setNpv($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNpv());
    }
    /**
     * Test pola Udzialowcy
     */
    public function testUdzialowcy()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setUdzialowcy($value);
        $this->assertEquals($value, $this->spolkaHistoria->getUdzialowcy());
    }
    /**
     * Test pola Prezes
     */
    public function testPrezes()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setPrezes($value);
        $this->assertEquals($value, $this->spolkaHistoria->getPrezes());
    }
    /**
     * Test pola ZarzadPozostali
     */
    public function testZarzadPozostali()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setZarzadPozostali($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZarzadPozostali());
    }
    /**
     * Test pola LpP
     */
    public function testLpP()
    {
        $value = 1;
        $this->spolkaHistoria->setLpP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getLpP());
    }
    /**
     * Test pola NazwaP
     */
    public function testNazwaP()
    {
        $value = 'Lorem';
        $this->spolkaHistoria->setNazwaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNazwaP());
    }
    /**
     * Test pola FormaP
     */
    public function testFormaP()
    {
        $value = 'Ipsum';
        $this->spolkaHistoria->setFormaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getFormaP());
    }
    /**
     * Test pola SiedzibaMiastoP
     */
    public function testSiedzibaMiastoP()
    {
        $value = 'Lorem';
        $this->spolkaHistoria->setSiedzibaMiastoP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getSiedzibaMiastoP());
    }
    /**
     * Test pola SiedzibaWojewodztwoP
     */
    public function testSiedzibaWojewodztwoP()
    {
        $value = 'PODLASKIE';
        $this->spolkaHistoria->setSiedzibaWojewodztwoP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getSiedzibaWojewodztwoP());
    }
    /**
     * Test pola BranzaP
     */
    public function testBranzaP()
    {
        $value = 'IT';
        $this->spolkaHistoria->setBranzaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getBranzaP());
    }
    /**
     * Test pola OpisP
     */
    public function testOpisP()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setOpisP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getOpisP());
    }
    /**
     * Test pola DataPowolaniaP
     */
    public function testDataPowolaniaP()
    {
        $value = '2017-01-01';
        $this->spolkaHistoria->setDataPowolaniaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getDataPowolaniaP());
    }
    /**
     * Test pola KrsP
     */
    public function testKrsP()
    {
        $value = '1111111111';
        $this->spolkaHistoria->setKrsP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKrsP());
    }
    /**
     * Test pola NipP
     */
    public function testNipP()
    {
        $value = '11111111111';
        $this->spolkaHistoria->setNipP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNipP());
    }
    /**
     * Test pola KwInwestycjiP
     */
    public function testKwInwestycjiP()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwInwestycjiP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwInwestycjiP());
    }
    /**
     * Test pola KwWsparciaP
     */
    public function testKwWsparciaP()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwWsparciaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwWsparciaP());
    }
    /**
     * Test pola KwPrywP
     */
    public function testKwPrywP()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwPrywP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwPrywP());
    }
    /**
     * Test pola ZakonczonaP
     */
    public function testZakonczonaP()
    {
        $value = '1';
        $this->spolkaHistoria->setZakonczonaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZakonczonaP());
    }
    /**
     * Test pola DataWyjsciaP
     */
    public function testDataWyjsciaP()
    {
        $value = '2017-01-01';
        $this->spolkaHistoria->setDataWyjsciaP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getDataWyjsciaP());
    }
    /**
     * Test pola KwDezinwestycjiP
     */
    public function testKwDezinwestycjiP()
    {
        $value = 1000;
        $this->spolkaHistoria->setKwDezinwestycjiP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getKwDezinwestycjiP());
    }
    /**
     * Test pola ZwrotInwestycjiP
     */
    public function testZwrotInwestycjiP()
    {
        $value = 20;
        $this->spolkaHistoria->setZwrotInwestycjiP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZwrotInwestycjiP());
    }
    /**
     * Test pola NpvP
     */
    public function testNpvP()
    {
        $value = 300;
        $this->spolkaHistoria->setNpvP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getNpvP());
    }
    /**
     * Test pola UdzialowcyP
     */
    public function testUdzialowcyP()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setUdzialowcyP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getUdzialowcyP());
    }
    /**
     * Test pola PrezesP
     */
    public function testPrezesP()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setPrezesP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getPrezesP());
    }
    /**
     * Test pola ZarzadPozostaliP
     */
    public function testZarzadPozostaliP()
    {
        $value = 'Lorem ipsum';
        $this->spolkaHistoria->setZarzadPozostaliP($value);
        $this->assertEquals($value, $this->spolkaHistoria->getZarzadPozostaliP());
    }    
    
    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown() 
    {
        $this->spolkaHistoria = null;
    }
}
