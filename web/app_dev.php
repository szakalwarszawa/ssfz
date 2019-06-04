<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lista zaufanych adresów IP, dla których dostępny jest tryb deweloperski aplikacji.
 *
 * @var string[]
 */
$ipDozwolone = [
       '10.10.120.',  // VLAN BI.
       '10.10.225.',  // VPN Admin FortiClient
       '10.10.50.',   // VPN Admin IPSec
       '127.0.0.1'    // localhost
];

/**
 * Sprawdza, czy adres, z którgo przyszło żądanie jest na liście zaufanych adresów IP.
 *
 * @param string $ip
 * @param string $remoteAddr
 *
 * @return bool
 */
function czyIpJestDozwolony($ip = null, $remoteAddr = null)
{
    $ip = (string) $ip;
    $remoteAddr = (string) $remoteAddr;
    $wycinek = substr($remoteAddr, 0, strlen($ip));
    $wynik = ($wycinek === $ip) ? true : false;

    return $wynik;
}

$remoteAddr = @$_SERVER['REMOTE_ADDR'];
if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $remoteAddr = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
}

$dostepZabroniony = true;
foreach ($ipDozwolone as $ip) {
    if (true === czyIpJestDozwolony($ip, $remoteAddr)) {
        $dostepZabroniony = false;
        break;
    }
}
if (true === $dostepZabroniony) {
    header('HTTP/1.0 403 Forbidden');
    exit('Brak uprawnień do korzystania z zasobu dla adresu: '.(string) $remoteAddr);
}
// Koniec sprawdzania IP.

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read https://symfony.com/doc/current/setup.html#checking-symfony-application-configuration-and-setup
// for more information
umask(0002);

require __DIR__.'/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
