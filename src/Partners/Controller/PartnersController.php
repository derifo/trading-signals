<?php

namespace Partners\Controller;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
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

class PartnersController extends Controller
{

    /**
     * @Get("/partners")
     * @View()
     */
    public function findAllPartnersAction(Request $request)
    {
        $filters = Arr::extract($request->query->all(), [  ]);

        /**
         * @var $partner Partners
         */
        $partner = $this->get('security.token_storage')->getToken()->getUser();
        $filters['id'] = $partner->getId();

        return $this->get('partners.crud')
            ->findAll($filters);
    }

    /**
     * @Get("/partners/stats")
     * @View()
     */
    public function getPartnerStatsAction(Request $request)
    {
        try {
            /**
             * @var $partner Partners
             */
            $partner = $this->get('security.token_storage')->getToken()->getUser();

            return $this->get('partners.statistics')->getTradesStatistics($partner);
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
    public function postPartnersLoginAction(Request $request)
    {
        $post = $request->request->all();
        $post = Arr::extract($post, [ 'email', 'password' ]);

        // TODO.Add Event Listener for 500 error
        try {
            return $this->get('security.partners.login')
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
    public function postPartnersLogoutAction(Request $request)
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
    public function getIsPartnerLoggedAction(Request $request)
    {
        $token = $this->get('security.token_storage')->getToken();

        return [
            'logged' => $token
        ];
    }
}
