<?php
namespace Parp\SsfzBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\BeneficjentFormaPrawna;
use Parp\SsfzBundle\Entity\Wojewodztwo;
use Parp\SsfzBundle\Entity\GospodarkaDzial;
use Parp\SsfzBundle\Entity\OkresyKonfiguracja;
use Parp\SsfzBundle\Repository\BeneficjentFormaPrawnaRepository;
use Parp\SsfzBundle\Repository\WojewodztwoRepository;
use Parp\SsfzBundle\Repository\GospodarkaDzialRepository;
use Parp\SsfzBundle\Repository\OkresyKonfiguracjaRepository;
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
     *
     * @var OkresyKonfiguracjaRepository
     */
    private $okresyKonfiguracjaRepo;
    
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
        
        $dict = new OkresyKonfiguracja();
        $this->okresyKonfiguracjaRepo
            ->method('findBy')
            ->will($this->returnValue($dict));          
        
        $this->service = new NarzedziaService($this->dictFormaRepo, $this->dictWojRepo, $this->dictDzialRepo, $this->okresyKonfiguracjaRepo);       
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
     * Testuje metodę getDatatableOsobyFields
     */    
    public function testGetDatatableOsobyFields()
    {
        $compare  = array(                       
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
        $renderers =   array(
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
    /**
     * Testuje metodę getDatatableUmowyFields
     */    
    public function testGetDatatableUmowyFields()
    {
         $renderers =  array(
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
        $renderers =   array(
                    1 => array(
                        'view' => 'SsfzBundle:Beneficjent:_umowaActions.html.twig',
                    )
                );
        $value = $this->service->getDatatableUmowyRenderers();
        $this->assertNotNull($value);
        $this->assertEquals($value, $renderers); 
        
    }
    /**
     * Testuje metodę getDatatableSpolkiFields
     */
    public function testGetDatatableSpolkiFields()
    {
        $fields =  array(
                    'Lp.' => 's.lp',
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
            $fields['1 - 6 '.$cfg->getRok()] = 's'.$idx.'.idStatus';
            $idx++;
            $fields['7 - 12 '.$cfg->getRok()] = 's'.$idx.'.idStatus';
            $idx++;
        }
        $fields['_identifier_'] = 'u.id';        
        
        $value = $this->service->getDatatableParpFields($config);
        $this->assertNotNull($value);
        $this->assertEquals($value, $fields);    
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
