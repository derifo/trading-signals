<?php

namespace Partners\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use System\Entity\Merchants;
use System\Entity\Partners;
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
use System\Service\Integration\AdaptersContainer;

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
         * @var $partner Partners
         */
        $partner = $this->get('security.token_storage')->getToken()->getUser();

        return $this->get('traders.crud')
            ->getTradersBreakdown($partner->getMerchants()->get(0), $filters);
    }
}
