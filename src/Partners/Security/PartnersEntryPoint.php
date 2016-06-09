<?php
/**
 * Created by PhpStorm.
 * User: shani
 * Date: 12/04/2016
 * Time: 17:02
 */
namespace Partners\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class PartnersEntryPoint implements AuthenticationEntryPointInterface
{

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $response = new Response("", Response::HTTP_UNAUTHORIZED);

        return $response;
    }

}
