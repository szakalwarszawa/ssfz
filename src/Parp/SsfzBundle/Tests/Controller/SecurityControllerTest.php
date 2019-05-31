<?php

namespace Parp\SsfzBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Console\Application;

/**
 * @covers \Parp\SsfzBundle\Controller\SecurityController
 */
class SecurityControllerTest extends WebTestCase
{
    protected static $application;

    /**
     * @var Client
     */
    private $client;

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
     * Test logowania
     */
    public function testLoginAction()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/login');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'pawiany_wchodza_na_sciany',
        ));
        $crawler = $this->client->request('GET', '/');
        $this->assertContains($this->client->getResponse()->getStatusCode(), [Response::HTTP_OK, Response::HTTP_FOUND]);
    }

    /**
     * Test przypomnienia hasła
     */
    public function testRecoverPassword()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/haslo/przypomnij');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Test resetu hasła
     */
    public function testResetPassword()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/haslo/reset/token=');
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'pawiany_wchodza_na_sciany',
        ));
        $crawler = $this->client->request('GET', '/haslo/reset/token=12345567');
        $this->assertContains($this->client->getResponse()->getStatusCode(), [Response::HTTP_OK, Response::HTTP_FOUND]);
    }

    /**
     * Test zmiany hasła
     */
    public function testChangePassword()
    {
        $this->client = static::createClient();
        $crawler = $this->client->request('GET', '/haslo/przypomnij');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}
