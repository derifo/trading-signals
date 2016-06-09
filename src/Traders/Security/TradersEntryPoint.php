<?php
/**
 * Created by PhpStorm.
 * User: shani
 * Date: 12/04/2016
 * Time: 17:02
 */
namespace Traders\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class TradersEntryPoint implements AuthenticationEntryPointInterface
{

    public function start(Request $request, AuthenticationException $authException = null)
    {
        die('123');

        $response = new Response("", Response::HTTP_UNAUTHORIZED);

        return $response;
    }

}
