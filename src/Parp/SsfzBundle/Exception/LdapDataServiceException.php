<?php

namespace  Parp\SsfzBundle\Exception;

use Exception;

/**
 * Wyjątek obsługi połączenia z LDAP.
 */
class LdapDataServiceException extends Exception
{
    /**
     * Konstruktor.
     *
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
