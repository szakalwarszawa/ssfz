<?php

namespace Test\Parp\SsfzBundle\Entity;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Entity\UzytkownikLdap;
use Parp\SsfzBundle\Entity\Rola;
use Parp\SsfzBundle\Entity\Beneficjent;
use Carbon\Carbon;

/**
 * Test encji Uzytkownik.
 *
 * @todo Klasa UzytkownikLdap jest identyczna z klasą Uzytkownik.
 *  Dublowanie testów wydaje się bezsensownym zwiększeniem kosztów utrzymania aplikacji.
 *
 * @covers Uzytkownik
 */
class UzytkownikLdapTest extends TestCase
{
    private $uzytkownik;

    /**
     * Ustawienie środowiska testowego
     */
    public function setUp()
    {
        $this->uzytkownik = new UzytkownikLdap();
    }

    /**
     * Test konstruktora
     */
    public function testConstruct()
    {
        $uzytkownik = new UzytkownikLdap();
        $this->assertNotNull($uzytkownik);
    }

    /**
     * Test pola Id
     */
    public function testId()
    {
        $this->assertNull($this->uzytkownik->getId());
    }

    /**
     * Test pola login
     */
    public function testLogin()
    {
        $login = 'admin';
        $this->uzytkownik->setLogin($login);
        $this->assertEquals($login, $this->uzytkownik->getLogin());
    }

    /**
     * Test pola haslo
     */
    public function testHaslo()
    {
        $haslo = 'pawiany_wchdoza_na_sciany';
        $this->uzytkownik->setHaslo($haslo);
        $this->assertEquals($haslo, $this->uzytkownik->getHaslo());
    }

    /**
     * Test pola email
     */
    public function testEmail()
    {
        $email = 'admin@example.com';
        $this->uzytkownik->setEmail($email);
        $this->assertEquals($email, $this->uzytkownik->getEmail());
    }

    /**
     * Test pola rola
     */
    public function testRola()
    {
        $rola = new Rola();
        $rola->setNazwa('ROLE_BENEFICJENT');

        $this->uzytkownik->setRola($rola);
        $this->assertEquals($rola, $this->uzytkownik->getRola());
    }

    /**
     * Test pola ban
     */
    public function testBan()
    {
        $ban = false;
        $this->uzytkownik->setBan($ban);
        $this->assertEquals($ban, $this->uzytkownik->getBan());
    }

    /**
     * Test pola kodZapomnianeHaslo
     */
    public function testKodZapomnianeHaslo()
    {
        $kodZapomnianeHaslo = base64_encode(random_bytes(64));
        $kodZapomnianeHaslo = str_replace('/', '', $kodZapomnianeHaslo);

        $this->uzytkownik->setKodZapomnianeHaslo($kodZapomnianeHaslo);
        $this->assertEquals($kodZapomnianeHaslo, $this->uzytkownik->getKodZapomnianeHaslo());
    }

    /**
     * Test pola utworzony
     */
    public function testUtworzony()
    {
        $utworzony = new Carbon('Europe/Warsaw');
        $this->uzytkownik->setUtworzony($utworzony);
        $this->assertEquals($utworzony, $this->uzytkownik->getUtworzony());
    }

    /**
     * Test pola zmodyfikowany
     */
    public function testZmodyfikowany()
    {
        $zmodyfikowany = new Carbon('Europe/Warsaw');
        $this->uzytkownik->setZmodyfikowany($zmodyfikowany);
        $this->assertEquals($zmodyfikowany, $this->uzytkownik->getZmodyfikowany());
    }

    /**
     * Test pola status
     */
    public function testStatus()
    {
        $status = 0;
        $this->uzytkownik->setStatus($status);
        $this->assertEquals($status, $this->uzytkownik->getStatus());
    }

    /**
     * Test pola utworzony
     */
    public function testBeneficjent()
    {
        $beneficjent = new Beneficjent();

        $this->uzytkownik->setBeneficjent($beneficjent);
        $this->assertEquals(1, count($this->uzytkownik->getBeneficjent()));
    }

    /**
     * Test pola kodZapomnianeHaslo
     */
    public function testKodAktywacjaKonta()
    {
        $kodAktywacjaKonta = base64_encode(random_bytes(64));
        $kodAktywacjaKonta = str_replace('/', '', $kodAktywacjaKonta);

        $this->uzytkownik->setKodAktywacjaKonta($kodAktywacjaKonta);
        $this->assertEquals($kodAktywacjaKonta, $this->uzytkownik->getKodAktywacjaKonta());
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->uzytkownik = null;
    }
}
