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
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vespolina\WorkflowBundle\Model\Workflow;
use Vespolina\WorkflowBundle\Model\WorkflowConfiguration;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;

use Vespolina\WorkflowBundle\Service\WorkflowServiceInterface;

class WorkflowService extends ContainerAware implements WorkflowServiceInterface
{
    protected $dbalConnection;
    protected $workflowBuilders;
    protected $workflowConfigurations;
    protected $workflowManager;

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
        $builderClass = $workflowConfiguration->getBuilderClass();

        $workflowRuntimeDefinition = null;
        
        if (!array_key_exists($builderClass, $this->workflowBuilders)) {
            $this->workflowBuilders[$builderClass] = $this->loadWorkflowBuilder($workflowConfiguration);
        }

        $workflowBuilder = $this->workflowBuilders[$builderClass];

        //Build the workflow instance
        if ($workflowBuilder) {

            //Build Ecz workflow runtime definition
            $workflowRuntimeDefinition = $workflowBuilder->build($workflowConfiguration);

            //...needs to be encapsulated in a class implementing WorkflowExecutionInterface
            $workflowExecution = new $className($workflowConfiguration->getName());
            $workflowExecution->setWorkflowRuntimeDefinition($workflowRuntimeDefinition);

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

        $workflowExecutionId = $workflowExecution->getWorkflowExecutionId();
        $workflowConfiguration = $this->getWorkflowConfiguration($workflowExecution->getConfigurationName());
        $workflowManager = $this->getWorkflowManager();

        //Get latest workflow id which will be used for creating the DoctrineExtensions/Workflow/DoctrineExecution instance
        $workflowId = $this->getLatestWorkflowIdforConfiguration($workflowConfiguration);

        if(!$workflowId)
        {

            //TODO exception
            return false;
        }

        if($workflowId > 0)
        {

            if(!$execution = $workflowManager->createExecutionByWorkflowId($workflowId))
            {
                //TODO Exception
            }


        }else{

            $workflowRuntimeDefinition = $workflowExecution->getWorkflowRuntimeDefinition();
            $execution = $workflowManager->createExecution($workflowRuntimeDefinition);
        }

        if($execution)
        {

            $execution->start();
        }
    }

    /**
     * @inheritdoc
     */
    public function save(WorkflowExecutionInterface $workflowExecution){

    }

    /**
     * @inheritdoc
     */
    public function saveConfiguration(WorkflowConfigurationInterface $workflowConfigurationName){


        $workflowManager = $this->getWorkflowManager();


    }

    /**
     * @inheritdoc
     */
    protected function loadWorkflowBuilder(WorkflowConfigurationInterface $workflowConfiguration)
    {
        
        //Load the builder class, for now we only support the build of an ecz workflow
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
     * Get the workflow db manager
     *
     */
    protected function getWorkflowManager(){

        if(!$this->workflowManager){

            $this->workflowManager = new WorkflowManager($this->dbalConnection, new WorkflowOptions($prefix = 'wf_'));

        }
        return $this->workflowManager;
    }
}
