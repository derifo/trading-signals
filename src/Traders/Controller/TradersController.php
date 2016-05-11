<?php

namespace Traders\Controller;

use System\Helpers\Arr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use FOS\RestBundle\Controller\Annotations\Get;

class TradersController extends Controller
{
    /**
     * @Post("/login")
     * @View()
     */
    public function postTradersLoginAction(Request $request)
    {
        $post = $request->request->all();
        $post = Arr::extract($post, [ 'email', 'password' ]);

        // TODO.Add Event Listener for 500 error
        try {
            return $this->get('security.traders.login')
                ->setCredentials($post)
                ->login();
        }
        catch(HttpException $e)
        {
            return new JsonResponse([ 'error' => 'LOGIN_ERROR' ], 200);
        }
        catch(\Exception $e)
        {
            return new JsonResponse([ 'error' => 'GENERAL_ERROR' ], 500);
        }
    }

    /**
     * @Post("/logout")
     * @View()
     */
    public function postTradersLogoutAction(Request $request)
    {
        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();

        return [
            'success' => true
        ];
    }

    /**
     * @Get("/is_logged")
     * @View()
     */
    public function getIsLoggedAction(Request $request)
    {
        $token = $this->get('security.token_storage')->getToken();

        return [
            'logged' => $token
        ];
    }
}
