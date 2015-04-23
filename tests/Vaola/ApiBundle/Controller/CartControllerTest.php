<?php

namespace Vaola\ApiBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = static::createClient(array());
    }

    public function testPostCartAddAction()
    {
        $route =  $this->getUrl('post_cart_add');

        $this->client->request(
            'POST',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"customer_id": "USH-8932","item_id": "1"}'
        );

        $response = $this->client->getResponse();
        $this->assertEquals($response->getStatusCode(), 200);
    }
}