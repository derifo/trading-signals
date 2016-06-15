<?php

use Symfony\Component\HttpFoundation\Request;

if (isset($_SERVER['HTTP_REFERER']))
{
    $url = parse_url($_SERVER['HTTP_REFERER']);
    $url = $url['scheme'].'://'.$url['host'].(isset($url['port']) && $url['port'] != 80 && $url['port'] != 443 ? (':'.$url['port']) : '');
    header('Access-Control-Allow-Origin: '.$url);
    header('Access-Control-Allow-Credentials: true');
}

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';

// Enable APC for autoloading to improve performance.
// You should change the ApcClassLoader first argument to a unique prefix
// in order to prevent cache key conflicts with other applications
// also using APC.
/*
$apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__FILE__), $loader);
$loader->unregister();
$apcLoader->register(true);
*/

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
