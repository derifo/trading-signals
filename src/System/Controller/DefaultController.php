<?php

namespace System\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $merchant = $this->getDoctrine()
            ->getRepository('System:Merchants')
            ->find(1);


        $trader = $this->get('signals.buy')
            ->buySignal(1, 7, []);

        print_r($trader); die;
    }
}
