<?php

declare(strict_types=1);

namespace Test\Parp\SsfzBundle\Helper;

use PHPUnit\Framework\TestCase;
use Parp\SsfzBundle\Helper\PasswordHelper;

/**
 * Testy klasy pomocniczej dla operacji na hasłach.
 */
class PasswordHelperTest extends TestCase
{
    /**
     * @var string
     */
    private $encodedPassword;

    public function setUp(): void
    {
        $plainPassword = 'very_strong_password';
        $this->encodedPassword = PasswordHelper::encodePassword($plainPassword);
    }

    public function testCanEncodePaddword()
    {
        $password = $this->encodedPassword;

        $this->assertInternalType('string', $password);
        $this->assertSame(60, strlen($password));
    }

    public function testCanExtractSaltFromPassword()
    {
        $salt = PasswordHelper::extractSalt($this->encodedPassword);

        $this->assertInternalType('string', $salt);
        $this->assertSame(22, strlen($salt));
    }
}
