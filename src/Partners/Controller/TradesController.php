<?php

namespace Partners\Controller;

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
    public function findTradesByTrader(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'trader' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset' ]);

        return $this->get('trades.crud')
            ->findAll($filters, $settings);
    }
}
