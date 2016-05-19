<?php

namespace Traders\Controller;

use System\Entity\Traders;
use System\Helpers\Arr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

class MerchantsSignalsController extends Controller
{

    /**
     * @Get("/merchants/signals")
     * @View()
     */
    public function findAllMerchantsSignalsAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'active' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset' ]);

        /**
         * @var $trader Traders
         */
        $trader = $this->get('security.token_storage')->getToken()->getUser();
        $filters['merchant'] = $trader->getMerchant()->getId();

        return $this->get('merchants_signals.crud')
            ->findAll($filters, $settings);
    }
}
