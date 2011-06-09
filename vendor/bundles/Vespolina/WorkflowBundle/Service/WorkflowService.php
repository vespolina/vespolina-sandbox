<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Service;

use DoctrineExtensions\Workflow\SchemaBuilder;
use DoctrineExtensions\Workflow\WorkflowManager;
use DoctrineExtensions\Workflow\WorkflowOptions;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\WorkflowBundle\Model\EcWorkflow\CustomWorkflowFactory;
use Vespolina\WorkflowBundle\Model\Workflow;
use Vespolina\WorkflowBundle\Model\WorkflowConfiguration;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;



class WorkflowService extends ContainerAware implements WorkflowServiceInterface
{
    protected $dbalConnection;
    protected $workflowBuilders;
    protected $workflowConfigurations;
    protected $workflowManager;
    protected $workflowFactory;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workflowBuilders = array();
        $this->workflowConfigurations = array();
        $this->workflowManager = null;
    }

    /**
     * @inheritdoc
     */
    function createWorkflowExecution(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $className = $workflowConfiguration->getBaseClass();
        $workflowManager = $this->getWorkflowManager();

        $workflowRuntimeDefinition = null;

        $workflowBuilder = $this->getWorkflowBuilder($workflowConfiguration);

        //Build the workflow instance
        if ($workflowBuilder) {

            //Build the workflow runtime definition
            $workflowRuntimeDefinition = $workflowBuilder->build($workflowConfiguration, $this->workflowFactory);

            //The runtime definition instance is encapsulated in a class implementing the WorkflowExecutionInterface interface
            $workflowExecution = new $className($workflowConfiguration->getName());
            $workflowExecution->setWorkflowRuntimeDefinition($workflowRuntimeDefinition);

            //Get latest workflow id which will be used for creating the DoctrineExtensions/Workflow/DoctrineExecution instance
            $workflowId = $this->getLatestWorkflowIdforConfiguration($workflowConfiguration);

            if($runtimeExecution = $workflowManager->createExecutionByWorkflowId($workflowId))
            {
                $workflowExecution->setWorkflowRuntimeExecution($runtimeExecution);

                $runtimeExecution->setVariable('WorkflowContainer', $workflowExecution->getWorkflowContainer());
                
            }


        } else {
            
            return false;
        }

        return $workflowExecution;
    }

    
    /**
     * @inheritdoc
     */
    public function getWorkflowConfiguration($name)
    {
        if (!array_key_exists($name, $this->workflowConfigurations)) {
            
            $this->workflowConfigurations[$name] = new WorkflowConfiguration($name);
        }

        return $this->workflowConfigurations[$name];
    }

    public function setDbalConnection($dbalConnection)
    {
        $this->dbalConnection = $dbalConnection;
    }

    /**
     * @inheritdoc
     */
    public function execute(WorkflowExecutionInterface $workflowExecution)
    {

        $runtimeExecution = $workflowExecution->getWorkflowRuntimeExecution();

        if($runtimeExecution)
        {

            if($runtimeExecution->isSuspended())
            {

                //$workflowContainerData = $workflowExecution->getContainer()->getContainerData();
                //$runtimeExecution->resume($workflowContainerData);


            }else{

                $runtimeExecution->start();
            }

            




        }
    }



    /**
     * @inheritdoc
     */
    public function save(WorkflowExecutionInterface $workflowExecution)
    {

    }

    /**
     * @inheritdoc
     */
    public function saveConfiguration(WorkflowConfigurationInterface $workflowConfiguration){


        $workflowManager = $this->getWorkflowManager();
        $workflowBuilder = $this->getWorkflowBuilder($workflowConfiguration);
 
        //First we need to build the runtime definition and subsequently we save it to the database
        $workflowRuntimeDefinition = $workflowBuilder->build($workflowConfiguration, $this->workflowFactory);

        $workflowManager->save($workflowRuntimeDefinition);

    }

    protected function getWorkflowBuilder(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $builderClass = $workflowConfiguration->getBuilderClass();

        if (!array_key_exists($builderClass, $this->workflowBuilders))
        {
            $this->workflowBuilders[$builderClass] = $this->loadWorkflowBuilder($workflowConfiguration);


        }

        return $this->workflowBuilders[$builderClass];

    }

    /**
     * @inheritdoc
     */
    protected function loadWorkflowBuilder(WorkflowConfigurationInterface $workflowConfiguration)
    {
        
        //Load the builder class
        $builderClassName = $workflowConfiguration->getBuilderClass();
        $builderOptions = $workflowConfiguration->getBuilderOptions();

        return new $builderClassName($builderOptions);
    }

    /**
     * Get the latest workflow id version which will be used to create a new workflow execution
     */
    protected function getLatestWorkflowIdforConfiguration(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $sql = 'SELECT workflow_id from wf_workflow WHERE workflow_name = ? AND workflow_outdated=0';
        return $this->dbalConnection->fetchColumn($sql, array($workflowConfiguration->getName()), 0);
    }

    /**
     * Get the workflow factory
     *
     */
    protected function getWorkflowFactory()
    {
        if (!$this->workflowFactory)
        {

            $this->workflowFactory = new CustomWorkflowFactory();
            $this->workflowFactory->setEventDispatcher($this->container->get('event_dispatcher'));
        }
    }
    /**
     * Get the workflow manager
     *
     */
    protected function getWorkflowManager()
    {

        if (!$this->workflowManager)
        {

            $this->workflowManager = new WorkflowManager($this->dbalConnection,
                                            new WorkflowOptions($prefix = 'wf_',
                                                                'ezWorkflow',
                                                                $this->getWorkflowFactory()));

        }

        return $this->workflowManager;
    }
}
