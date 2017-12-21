<?php

namespace Parp\SsfzBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * Description of sprawozdanieControllerTest
 *
 * 
 * @covers \Parp\SsfzBundle\Controller\sprawozdanieController
 */
class SprawozdanieControllerTest extends WebTestCase
{
    /**
     *
     * @var Client
     */
    private $client = null;
    protected static $application; 
    
    /**
     * Ustawienie środowiska testowego
     */    
    protected function setUp()
    {
        self::runCommand('doctrine:database:drop --force');
        self::runCommand('doctrine:database:create');
        self::runCommand('doctrine:schema:update --force');
        self::runCommand('doctrine:fixtures:load --no-interaction');
    }    
    /**
     * Czyszczenie środowiska testowego
     */
    protected function tearDown() 
    {
        self::runCommand('doctrine:database:drop --force');
    }  
    
    /**
     * Wywołuje komendę z konsoli aplikacji
     * 
     * @param string $command
     * @return void
     */
    protected static function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return self::getApplication()->run(new StringInput($command));
    }    
    /**
     * Pobiera obiekt Application do wywołania komedy konsolowej
     * 
     * @return Application
     */
    protected static function getApplication()
    {
        if (null === self::$application) {
            $client = static::createClient();

            self::$application = new Application($client->getKernel());
            self::$application->setAutoExit(false);
        }

        return self::$application;
    }    
    
    /**
     * Testuje akcję rejestracja
     * 
     */
    public function testRejestracja()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/sprawozdanie/rejestracja/1');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('GET', '/sprawozdanie/rejestracja/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
    /**
     * Testuje akcję edycja
     */
    public function testEdycja()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/sprawozdanie/edycja/1/2');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('GET', '/sprawozdanie/edycja/1/2');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }    
    /**
     * Testuje akcję poprawa
     */
    public function testPoprawa()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/sprawozdanie/poprawa/1/4');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('GET', '/sprawozdanie/poprawa/1/4');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }       
    /**
     * Testuje akcję podglad
     */
    public function testPodglad()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/sprawozdanie/podglad/2');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('GET', '/sprawozdanie/podglad/2');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }  
    /**
     * testuje akcję gridSprawozdanie
     */
    public function testSprawozdanieGrid()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/gridSprawozdanie/1');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('GET', '/gridSprawozdanie/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }   
    
     /**
     * testuje akcję WyslijDoParpAction
     */
    public function testWyslijDoParpAction()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('POST', '/sprawozdanie/wyslijDoParp', array('sprawozdanieId'=> 3), array(), array());
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(
            array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
            )
        );
        $crawler = $this->client->request('POST', '/sprawozdanie/wyslijDoParp', array('sprawozdanieId'=> 3), array(), array());
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    } 
    
    /**
     * testuje metodę SetDefaultValues
     */
    public function testSetDefaultValues()
    {
        $sprawozdanieControler = new \Parp\SsfzBundle\Controller\SprawozdanieController();
        $report = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $report = $sprawozdanieControler->setDefaultValues($report, $umowa, 13);
        $creationDate = new \DateTime('now');
        $this->assertSame($report->getCreatorId(), 13);
        $this->assertSame($report->getWersja(), 1);
        $this->assertSame($report->getCzyNajnowsza(), true);
        $this->assertSame($report->getStatus(), 1);
        $this->assertSame($report->getDataRejestracji()->format('Y-m-d'), $creationDate->format('Y-m-d'));
        
    }
    
    /**
     * testuje metodę SetSpolki
     */
    public function testSetSpolki()
    {
        $report = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $spolka1 = new \Parp\SsfzBundle\Entity\Spolka();
        $spolka2 = new \Parp\SsfzBundle\Entity\Spolka();
        $spolki = array($spolka1,$spolka2);
        $sprawozdanieControler = new \Parp\SsfzBundle\Controller\SprawozdanieController();
        $report = $sprawozdanieControler->setSpolki($spolki, $report);
        $this->assertSame(count($report->getSprawozdaniaSpolek()), count($spolki));
    }
    
    /**
     * testuje metodę setDefaultValuesAfterRepait
     */
    public function testSetDefaultValuesAfterRepait()
    {
        $wersja = 2;
        $oldReport = new \Parp\SsfzBundle\Entity\Sprawozdanie();
        $oldReport->setWersja($wersja);
        $oldReport->setId(1);
        $report = new \Parp\SsfzBundle\Entity\Sprawozdanie();

        $sprawozdanieControler = new \Parp\SsfzBundle\Controller\SprawozdanieController();
        
        $report = $sprawozdanieControler->setDefaultValuesAfterRepait($report, $oldReport);
        $this->assertSame($report->getWersja(), $wersja +1);
        $this->assertSame($report->getPreviousVersionId(), 1);
        $this->assertSame($report->getStatus(), 1);
        $this->assertSame($report->getUwagi(), '');
        $this->assertSame($report->getOceniajacyId(), null);
        $this->assertSame($report->getDataPrzeslaniaDoParp(), null);
        $this->assertSame($report->getDataZatwierdzenia(), null);
    }
    
    /**
     * testuje metodę getNumerUmowy
     */
    public function testGetNumerUmowy()
    {
        /*$umowa = new \Parp\SsfzBundle\Entity\Umowa();
        $umowa->setNumer('1/2015');

        $umowaRepository = $this->createMock(ObjectRepository::class);
        $umowaRepository->expects($this->any())
            ->method('find')
            ->willReturn($umowa);
        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($umowaRepository);  
        
        $sprawozdanieControler = new \Parp\SsfzBundle\Controller\SprawozdanieController();
        $numerUmowy = $sprawozdanieControler->getNumerUmowy(1);
        $this->assertSame($numerUmowy,'1/2015');*/
    }
    
    /**
     * testuje metodę getSpolkiList
     */
    public function testGetSpolkiList()
    {
        /*$spolka = new \Parp\SsfzBundle\Entity\Spolka();
        $lista = array($spolka);

        $umowaRepository = $this->createMock(ObjectRepository::class);
        $umowaRepository->expects($this->any())
            ->method('find')
            ->willReturn($lista);
        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($umowaRepository); 
        
        $sprawozdanieControler = new \Parp\SsfzBundle\Controller\SprawozdanieController();
        
        $spolki = $sprawozdanieControler->getSpolkiList(1);
        $this->assertSame(count($spolki),1);*/
    }
    
}
