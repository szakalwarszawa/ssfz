<?php

/**
 * Klasa wyjątku generowanego z klasy LdapDataServiceException
 *
 */
class LdapDataServiceException extends Exception
{
    /**
     * Konstruktor
     *
     * @param string    $message  wiadomość powiązana z wyjątkiem
     * @param integer   $code     kod wyjątku
     * @param Exception $previous
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
