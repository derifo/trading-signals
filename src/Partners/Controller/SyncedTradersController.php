<?php

namespace Partners\Controller;

use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;
use System\Entity\Partners;
use System\Entity\Traders;
use System\Helpers\Arr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;

class SyncedTradersController extends Controller
{

    /**
     * @Get("/synced-traders")
     * @View()
     */
    public function findAllSyncedTradersAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'id' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset' ], [ 500, 0 ]);

        /**
         * @var $partner Partners
         */
        $partner = $this->get('security.token_storage')->getToken()->getUser();

        $filters['merchant'] = $partner->getMerchants()[0];
        return $this->get('synced_traders.crud')
            ->findAll($filters, $settings);
    }

    /**
     * @Post("/synced_traders/generate-codes")
     * @View()
     */
    public function generateCodesAction(Request $request)
    {
        $codes = $request->request->get('synced_traders');
        $deal = $request->request->get('deal');

        if ( ! is_array($codes)) throw new PreconditionFailedHttpException('Invalid or missing traders');

        return $this->get('traders_promotions.generate')
            ->generateCodes($codes, $deal);
    }
}
