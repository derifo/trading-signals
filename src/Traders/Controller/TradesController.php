<?php

namespace Traders\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use System\Entity\Trades;
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

class TradesController extends Controller
{

    /**
     * @Get("/trades")
     * @View()
     */
    public function findAllTradesAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'active', 'tradeStatus' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset' ]);

        /**
         * @var $trader Traders
         */
        $trader = $this->get('security.token_storage')->getToken()->getUser();
        $filters['trader'] = $trader->getId();

        return $this->get('trades.crud')
            ->findAll($filters, $settings);
    }
}
