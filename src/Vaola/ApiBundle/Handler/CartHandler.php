<?php

namespace Vaola\ApiBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Vaola\ApiBundle\Entity\Cart;
use Vaola\ApiBundle\Form\CartType;

class CartHandler implements CartHandlerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param EntityManager $entityManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $entityManager, FormFactoryInterface $formFactory)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function cartAdd(Cart $cart, array $parameters)
    {
        return $this->processForm(new Cart(), $parameters);
    }

    /**
     * @param Cart $cart
     * @param array $parameters
     * @param string $method
     *
     * @return \Vaola\ApiBundle\Entity\Cart
     *
     * @throws \Exception
     */
    private function processForm(Cart $cart, array $parameters, $method = "POST")
    {
        $form = $this->formFactory->create(new CartType(), $cart, array('method' => $method));
        $form->submit($parameters);
        if($form->isValid()) {
            $cart = $form->getData();
            $this->entityManager->persist($cart);
            $this->entityManager->flush();

            return $cart;
        }

        throw new \Exception("Invalid submitted data");
    }
}