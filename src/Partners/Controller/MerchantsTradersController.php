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

class MerchantsTradersController extends Controller
{

    /**
     * @Get("/merchants-traders")
     * @View()
     */
    public function findAllMerchantsTradersAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'id', 'promoted' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset', 'order' ], [ 500, 0, [ 'id', 'ASC' ] ]);

        /**
         * @var $partner Partners
         */
        $partner = $this->get('security.token_storage')->getToken()->getUser();

        $filters['merchant'] = $partner->getMerchants()[0];
        return $this->get('merchants_traders.crud')
            ->findAll($filters, $settings);
    }

    /**
     * @Post("/merchants_traders/generate-codes")
     * @View()
     */
    public function generateCodesAction(Request $request)
    {
        $codes = $request->request->get('merchants_traders');
        $deal = $request->request->get('deal');
        $merchant = $request->request->get('merchant');

        if ( ! is_array($codes) && $codes != 0) throw new PreconditionFailedHttpException('Invalid or missing traders');

        return $this->get('traders_promotions.generate')
            ->generateCodes($codes, $deal, $merchant);
    }
}
