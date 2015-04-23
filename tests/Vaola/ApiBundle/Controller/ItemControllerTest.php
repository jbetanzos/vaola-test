<?php

namespace Vaola\ApiBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

class ItemControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = static::createClient(array());
    }

    public function testGetItemsListAction()
    {
        $route =  $this->getUrl('get_items_list');

        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testPutItemsSaveAction()
    {
        $route =  $this->getUrl('put_items_save');

        $this->client->request(
            'PUT',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"name": "Nike Shirt","description": "Black Large","price": "34.00"}'
        );

        $response = $this->client->getResponse();
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testErrorPutItemsSaveAction()
    {
        $route =  $this->getUrl('put_items_save');

        $this->client->request(
            'PUT',
            $route,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"description": "Black Large","price": "34.00"}'
        );

        $response = $this->client->getResponse();
        $this->assertEquals($response->getStatusCode(), 500);
    }
}