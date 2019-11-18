<?php

namespace Test\Parp\SsfzBundle\Entity;

use Serializable;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\User\{
    UserInterface,
    AdvancedUserInterface,
    EquatableInterface
};
use Parp\SsfzBundle\Entity\{
    Uzytkownik,
    Rola,
    Beneficjent
};
use Carbon\Carbon;

/**
 * Test encji Uzytkownik
 *
 * @todo Testowanie poszczególnych pól to przesada.
 *
 * @covers Uzytkownik
 */
class UzytkownikTest extends TestCase
{
    /**
     * @var Uzytkownik
     */
    private $uzytkownik;

    /**
     * Ustawienie środowiska testowego.
     */
    public function setUp()
    {
        $this->uzytkownik = new Uzytkownik();
    }

    /**
     * Test konstruktora
     */
    public function testCabBeConstructed()
    {
        $uzytkownik = $this->uzytkownik;

        $this->assertNotNull($uzytkownik);
        $this->assertInstanceOf(UserInterface::class, $uzytkownik);
        $this->assertInstanceOf(AdvancedUserInterface::class, $uzytkownik);
        $this->assertInstanceOf(Uzytkownik::class, $uzytkownik);
        $this->assertInstanceOf(EquatableInterface::class, $uzytkownik);
        $this->assertInstanceOf(Serializable::class, $uzytkownik);
    }

    /**
     * Testuje akcesory i mutatory.
     *
     * Konieczność pokrycia większości właściwości klasy akcesorami i mutatorami
     * jest następstwem użycia ORM. Odwoływanie się w kodzie do obiektu przez getX() i setX()
     * powinno być ograniczone do minimum (nawet jeśli jest możliwe).
     *
     * @return void
     */
    public function testCanSetAndGetFields()
    {
        $uzytkownik = $this->uzytkownik;

        $role = $this->createMock(Rola::class);
        $role
            ->method('getNazwa')
            ->willReturn('ROLE_BENEFICJENT')
        ;

        $beneficjent = $this->createMock(Beneficjent::class);
        $beneficjent
            ->method('getProgram')
            ->willReturn(1)
        ;

        $now = new Carbon('Europe/Warsaw');

        $uzytkownik
            ->setLogin('test_login')
            ->setHaslo('test_password')
            ->setEmail('test_email@fake.local.xx')
            ->setRola($role)
            ->setBan(false)
            ->setUtworzony($now)
            ->setZmodyfikowany($now)
            ->setStatus(1)
            ->addBeneficjenci($beneficjent)
        ;

        $this->assertNull($this->uzytkownik->getId());
        $this->assertEquals('test_login', $uzytkownik->getLogin());
        $this->assertEquals('test_password', $uzytkownik->getHaslo());
        $this->assertEquals('test_email@fake.local.xx', $uzytkownik->getEmail());
        $this->assertInstanceOf(Rola::class, $uzytkownik->getRola());
        $this->assertEquals('ROLE_BENEFICJENT', $uzytkownik->getRola()->getNazwa());
        $this->assertFalse($uzytkownik->getBan());
        $this->assertEquals($now, $uzytkownik->getUtworzony());
        $this->assertEquals($now, $uzytkownik->getZmodyfikowany());
        $this->assertEquals(1, $uzytkownik->getStatus());
        $this->assertEquals(1, count($this->uzytkownik->getBeneficjenci()));
    }

    /**
     * Test pola kodZapomnianeHaslo
     */
    public function testKodZapomnianeHaslo()
    {
        $uzytkownik = $this->uzytkownik;

        $oldForgottenPassword = $uzytkownik->getKodZapomnianeHaslo();
        $this->uzytkownik->forgottenPassword();
        $newForgottenPassword = $uzytkownik->getKodZapomnianeHaslo();

        $this->assertInternalType('string', $newForgottenPassword);
        $this->assertEquals(32, strlen($newForgottenPassword));
        $this->assertEquals(0, strlen($oldForgottenPassword));
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
     * Test can generate one-time code for password recovery.
     */
    public function testCanGeneratePasswordRecoveryCode()
    {
        $this->uzytkownik->forgottenPassword();

        $this->assertEquals(32, strlen($this->uzytkownik->getKodZapomnianeHaslo()));
    }

    /**
     * Test pola sól
     */
    public function testSalt()
    {
        $uzytkownik = $this->uzytkownik;
        $oldSalt = $uzytkownik->getSalt();
        $uzytkownik->changePassword('test_password');
        $newSalt = $uzytkownik->getSalt();

        $this->assertInternalType('string', $oldSalt);
        $this->assertEquals(0, strlen($oldSalt));

        $this->assertInternalType('string', $newSalt);
        $this->assertEquals(22, strlen($newSalt));
    }

    /**
     * Czyszczenie środowiska testowego
     */
    public function tearDown()
    {
        $this->uzytkownik = null;
    }
}
