<?php

namespace Test\Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * Description of BeneficjentControllerTest
 *
 * @covers \Parp\SsfzBundle\Controller\PortfelController
 */
class PortfelControllerTest extends WebTestCase
{
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
     * @param  string $command
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
     * Testuje akcję domyślną
     */
    public function testIndex()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/portfel/1');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
        ));
        $crawler = $this->client->request('GET', '/portfel/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * testuje akcję spolkiGrid
     */
    public function testSpolkiGrid()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/gridSpolki/1');
        $this->assertSame(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'bzk777',
            'PHP_AUTH_PW'   => 'Zeto#2017!',
        ));
        $crawler = $this->client->request('GET', '/gridSpolki/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
