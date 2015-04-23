<?php

namespace Vaola\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Restful;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Request;

class CartController extends FOSRestController
{

    /**
     * @Post("/add")
     * @param Request $request
     * @return mixed
     */
    public function postCartAddAction(Request $request)
    {
        $cart = $this->container
            ->get('api.cart.handler')
            ->cartAdd(new \Vaola\ApiBundle\Entity\Cart(), $request->request->all());

        return $cart;
    }
}
