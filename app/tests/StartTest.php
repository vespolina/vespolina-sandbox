<?php

namespace Vespolina;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StartTest extends WebTestCase
{
    public function testStartPage()
    {
        $client = $this->createClient(array('environment' => 'dev'));

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testOrder()
    {
        $this->markTestIncomplete('todo');

        $client = $this->createClient(array('environment' => 'dev'));
        
        $orderManager = $client->getContainer()->get('vespolina.order_manager');
        $orders = $orderManager->findBy(array('state' => 'unprocessed'));

        foreach ($orders as $order) {
            var_dump($order);die();
        }
    }
}