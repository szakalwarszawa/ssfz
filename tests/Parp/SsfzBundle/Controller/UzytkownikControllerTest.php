<?php

namespace Test\Parp\SsfzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * @covers \Parp\SsfzBundle\Controller\UzytkownikController
 */
class UzytkownikControllerTest extends WebTestCase
{
    private $client;
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
     *
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
     * Test rejestracji
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testRejestracja()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/uzytkownik/rejestracja');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test aktywacji konta
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testAktywacjaKonta()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/uzytkownik/aktywacja/token=123456');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
