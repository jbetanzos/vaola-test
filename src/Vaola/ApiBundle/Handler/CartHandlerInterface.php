<?php

namespace Vaola\ApiBundle\Handler;

use Vaola\ApiBundle\Entity\Cart;

interface CartHandlerInterface
{
    public function cartAdd(Cart $cart, array $parameters);
}