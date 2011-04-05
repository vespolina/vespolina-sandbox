<?php

namespace Vespolina\WorkflowBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\WorkflowBundle\Model\Workflow;


class WorkflowTest extends WebTestCase
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
     * @covers Vespolina\WorkflowBundle\Service\WorkflowService::create
     */
    public function testWorkflowCreate()
    {


        //$workflow->test();
        $workflowService = $this->getKernel()->getContainer()->get('vespolina.workflow');

        $workflowConfiguration = $workflowService->getWorkflowConfiguration('order_to_cash_b2c');
        $workflowConfiguration->setBaseClass('Vespolina\WorkflowBundle\Model\Workflow');
        $workflowConfiguration->setBuilderClass('Vespolina\WorkflowBundle\Model\WorkflowBuilder\XmlWorkflowBuilder');

        //Point builder to folder Resources/config/tests
        $workflowConfiguration->setBuilderOptions(array('source' => 'Resources'. DIRECTORY_SEPARATOR.
                                                                    'config'. DIRECTORY_SEPARATOR.
                                                                    'tests' . DIRECTORY_SEPARATOR));

        //Create the workflow
        $workflow = $workflowService->create($workflowConfiguration);

        $this->assertEquals($workflow->getContainer()->get('workflow.name'), 'order_to_cash_b2c');

        $isStartSuccess = $workflowService->start($workflow);

        $this->assertTrue($isStartSuccess);


        /**$documentConfiguration->setName('sales_order_third_party');
        $documentConfiguration->setBaseClass('Vespolina\OrderBundle\Model\OrderDocument');
        $documentConfiguration->setItemBaseClass('Vespolina\OrderBundle\Model\OrderDocumentItem');


        $orderDocument = $documentService->create($documentConfiguration);
        $orderDocumentItem1 = $documentService->createItem($orderDocument, $documentConfiguration);

        $productA = new Product();
        $productB = new Product();

        $orderDocumentItem1->setProduct($productA);
        $orderDocumentItem1->setOrderedQuantity(10);

        $this->assertEquals(count($orderDocument->getItems()), 1);
        $this->assertEquals(($orderDocumentItem1->getOrderedQuantity()), 10);

        $orderDocumentItem2 = $documentService->createItem($orderDocument, $documentConfiguration);
        $orderDocumentItem2->setProduct($productB);
        $orderDocumentItem2->setOrderedQuantity(5);

        $this->assertEquals(count($orderDocument->getItems()), 2);
        $this->assertEquals(($orderDocumentItem2->getOrderedQuantity()), 5);
        */
    }
}