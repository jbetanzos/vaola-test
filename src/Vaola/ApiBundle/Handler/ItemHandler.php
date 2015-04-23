<?php

namespace Vaola\ApiBundle\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Vaola\ApiBundle\Entity\Item;
use Vaola\ApiBundle\Form\ItemType;

class ItemHandler implements ItemHandlerInterface
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

    /**
     * @return array
     */
    public function itemList()
    {
        return $this->entityManager->getRepository('Vaola\ApiBundle\Entity\Item')->findAll();
    }

    /**
     * @param Item $item
     * @param array $parameters
     * @return Item
     * @throws \Exception
     */
    public function itemSave(Item $item, array $parameters)
    {
        return $this->processForm(new Item(), $parameters);
    }

    /**
     * @param Item $item
     * @param array $parameters
     * @param string $method
     *
     * @return \Vaola\ApiBundle\Entity\Item
     *
     * @throws \Exception
     */
    private function processForm(Item $item, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new ItemType(), $item, array('method' => $method));
        $form->submit($parameters);
        if($form->isValid()) {
            $item = $form->getData();
            $this->entityManager->persist($item);
            $this->entityManager->flush();

            return $item;
        }

        throw new \Exception("Invalid submitted data");
    }
}