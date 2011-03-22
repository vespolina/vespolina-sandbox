<?php

namespace Vespolina\OrderBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\ProductBundle\Model\Product;
use Vespolina\OrderBundle\Model\OrderDocument;
use Vespolina\DocumentBundle\Model\DocumentConfiguration;
use Vespolina\PricingBundle\Service\Pricing;

class OrderDocumentCreateTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!$this->kernel) {
        
            $this->kernel = $this->createKernel($options);
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    /**
     * @covers Vespolina\OrderBundle\Service\OrderService::create
     */
    public function testOrderDocumentCreate()
    {
    
        $documentService = $this->getKernel()->getContainer()->get('vespolina.document');

        $documentConfiguration = $documentService->getDocumentConfiguration('generic_document');
        $documentConfiguration->setName('sales_order_third_party');
        $documentConfiguration->setBaseClass('Vespolina\OrderBundle\Model\OrderDocument');
        $documentConfiguration->setItemBaseClass('Vespolina\OrderBundle\Model\OrderDocumentItem');

        
        $orderDocument = $documentService->create($documentConfiguration);
        $orderDocumentItem = $documentService->createItem($orderDocument);

    }
}