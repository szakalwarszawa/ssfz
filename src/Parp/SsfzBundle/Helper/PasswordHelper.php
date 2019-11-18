<?php

declare(strict_types=1);

namespace Parp\SsfzBundle\Helper;

/**
 * Klasa pomocnicza do operacji na hasłach.
 */
class PasswordHelper
{
    /**
     * Encodes password.
     *
     * @param string $password
     *
     * @return string|null
     */
    public static function encodePassword($password): ?string
    {
        $encodedPassword = null;

        $password = trim((string) $password);
        if (!empty($password)) {
            $encodedPassword = password_hash($password, \PASSWORD_BCRYPT, [
                'cost' => 12,
            ]);
        }

        return $encodedPassword;
    }

    public static function extractSalt($password): string
    {
        $salt = '';
        $password = trim((string) $password);
        if (!empty($password)) {
            $salt = substr($password, 7, 22);
        }

        return $salt;
    }
}
