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
use Vespolina\WorkflowBundle\Model\WorkflowInstanceInterface;

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
    function create(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $className = $workflowConfiguration->getBaseClass();
        $builderClass = $workflowConfiguration->getBuilderClass();
        $workflowInstance = null;
        
        if (!array_key_exists($builderClass, $this->workflowBuilders)) {
            $this->workflowBuilders[$builderClass] = $this->loadWorkflowBuilder($workflowConfiguration);
        }

        $workflowBuilder = $this->workflowBuilders[$builderClass];

        //Build the workflow instance
        if ($workflowBuilder) {

            //Ecz runtime instance
            $workflowRuntimeInstance = $workflowBuilder->build($workflowConfiguration);

            //...needs to be encapsulated in a class implementing WorkflowInstanceInterface
            $workflowInstance = new $className($workflowConfiguration->getName());
            $workflowInstance->setRuntimeInstance($workflowRuntimeInstance);

        } else {
            
            return false;
        }

        return $workflowInstance;
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
    public function save(WorkflowInstanceInterface $workflowInstance){

    }


    /**
     * @inheritdoc
     */
    public function start(WorkflowInstanceInterface $workflowInstance)
    {
      
        return $workflowInstance->start();

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
     * Get the workflow db manager
     *
     */
    protected function getWorkflowManager(){

        if(!$this->workflowManager){

            $this->workflowManager = new WorkflowManager($this->dbalConnection, new WorkflowOptions($prefix = 'wf_'));

        }
    }
}
