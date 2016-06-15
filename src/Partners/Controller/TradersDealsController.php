<?php

namespace Partners\Controller;

use System\Helpers\Arr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class TradersDealsController extends Controller
{

    /**
     * @Get("/traders_deals/{trader_id}")
     * @View()
     */
    public function findAllTradersAction(Request $request, $trader_id)
    {
        $filters = Arr::extract($request->query->all(), [  ]);

        return $this->get('traders_deals.crud')
            ->getTraderDealsBreakdown($trader_id);
    }

    /**
     * @Post("/traders_deals/extend")
     * @View()
     */
    public function extendTradersDealAction(Request $request)
    {
        $data = Arr::extract($request->request->all(), [ 'traders', 'deal' ]);

        return $this->get('traders_deals.set')
            ->addDealToTraders(Arr::get($data, 'traders'), Arr::get($data, 'deal'));
    }
}
