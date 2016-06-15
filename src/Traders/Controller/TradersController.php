<?php

namespace Traders\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use System\Entity\Traders;
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
     * @Get("/traders")
     * @View()
     */
    public function findAllTradersAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [  ]);

        /**
         * @var $trader Traders
         */
        $trader = $this->get('security.token_storage')->getToken()->getUser();
        $filters['id'] = $trader->getId();

        return $this->get('traders.crud')
            ->findAll($filters);
    }


    /**
     * @Post("/register")
     * @View()
     */
    public function registerTraderAction(Request $request)
    {
        $data = Arr::extract($request->request->all(), [ 'email', 'password', 'code' ]);

        return $this->get('traders.register')
            ->setData($data)
            ->register();
    }

    /**
     * @Get("/traders/stats")
     * @View()
     */
    public function getTraderStatsAction(Request $request)
    {
        try {
            /**
             * @var $trader Traders
             */
            $trader = $this->get('security.token_storage')->getToken()->getUser();

            return $this->get('traders.statistics')->getTradesStatistics($trader);
        }
        catch(\Exception $e)
        {
            throw new BadRequestHttpException('SERVER_ERROR');
        }
    }

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
