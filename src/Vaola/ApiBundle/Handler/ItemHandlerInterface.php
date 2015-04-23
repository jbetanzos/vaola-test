<?php

namespace Vaola\ApiBundle\Handler;

use Vaola\ApiBundle\Entity\Item;

interface ItemHandlerInterface
{
    public function itemList();
    public function itemSave(Item $item, array $parameters);
}