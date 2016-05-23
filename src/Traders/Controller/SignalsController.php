<?php

namespace Traders\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use System\Entity\Signals;
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

class SignalsController extends Controller
{

    /**
     * @Get("/signals")
     * @View()
     */
    public function findAllSignalsAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [ 'active' ]);
        $settings = Arr::extract($request->query->all(), [ 'limit', 'offset' ]);

        return $this->get('signals.crud')
            ->findAll($filters, $settings);
    }

    /**
     * @Post("/buy")
     * @View()
     */
    public function buySignalAction(Request $request)
    {
        $options = Arr::extract($request->request->all(), [ 'amount' ]);

        /**
         * @var $trader Traders
         */
        $trader = $this->get('security.token_storage')->getToken()->getUser();

        return $this->get('signals.buy')
            ->buySignal($trader->getId(), $request->request->get('signal_id'), $options);
    }
}
