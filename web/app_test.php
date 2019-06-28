<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

$addr = @$_SERVER['REMOTE_ADDR'];
if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $addr = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
}

if ($addr !== '127.0.0.1') {
    header('HTTP/1.0 403 Forbidden');
    exit('Brak uprawnień do korzystania z zasobu dla adresu: '.(string) $addr);
}

umask(0002);

require __DIR__.'/../app/autoload.php';
Debug::enable();

$kernel = new AppKernel('test', false);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
