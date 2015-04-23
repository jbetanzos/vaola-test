<?php

namespace Vaola\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\Annotations as Restful;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;

class ItemController extends FOSRestController
{
    /**
     * @Get("/list")
     * @return mixed
     */
    public function getItemsListAction()
    {
        $itemList = $this->container
                    ->get('api.item.handler')
                    ->itemList();

        return $itemList;
    }

    /**
     * @Put("/save")
     * @param Request $request
     * @return View
     */
    public function putItemsSaveAction(Request $request)
    {
        $item = $this->container
            ->get('api.item.handler')
            ->itemSave(new \Vaola\ApiBundle\Entity\Item(), $request->request->all());

        return $item;
    }
}