<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\WorkflowBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\WorkflowBundle\Model\Workflow;
use Vespolina\WorkflowBundle\Model\WorkflowAgent;
use Vespolina\WorkflowBundle\Model\WorkflowTask;

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

    public function testCreateAgentAndTask()
    {

        $workflowAgentJamesBond = new WorkflowAgent(true);
        $workflowAgentJamesBond->setName('James Bond 007');

        $workflowTask = new WorkflowTask();
        $workflowTask->setName('kill Goldfinger');
        $workflowTask->assignTo($workflowAgentJamesBond);

        $this->assertEquals('James Bond 007',
                            $workflowTask->getAssignedTo()->getName());

        $this->assertTrue($workflowTask->isAssigned());
        $this->assertTrue($workflowTask->getAssignedTo()->isHuman());

    }

    /**
     * @covers Vespolina\WorkflowBundle\Service\WorkflowService::create
     */
    public function testWorkflowCreate()
    {
        
        $workflowService = $this->getKernel()->getContainer()->get('vespolina.workflow');

        //The workflow service needs a DBAL connection to the database (Doctrine Extensions > Doctrine Workflow )
        $workflowService->setDbalConnection($this->getKernel()->getContainer()->get('database_connection'));

        $workflowConfiguration = $workflowService->getWorkflowConfiguration('test_1');
        $workflowConfiguration->setBaseClass('Vespolina\WorkflowBundle\Model\WorkflowExecution');
        $workflowConfiguration->setBuilderClass('Vespolina\WorkflowBundle\Tests\Mockup\PHPTest1WorkflowBuilder');

        //Save the workflow configuration to the database
        $workflowService->saveConfiguration($workflowConfiguration);

      
        //Create a workflow execution instance for the template workflow
        $workflowExecution = $workflowService->createWorkflowExecution($workflowConfiguration);



        //Verify that the workflow container holds the name of the workflow definition
        $this->assertEquals($workflowExecution->getWorkflowContainer()->get('workflow.name'), 'test_1');



        $workflowService->execute($workflowExecution);

    }

}