<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\WorkflowBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\WorkflowBundle\Model\Workflow;
use Vespolina\WorkflowBundle\Model\WorkflowConfiguration;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowInterface;

use Vespolina\WorkflowBundle\Service\WorkflowServiceInterface;


class WorkflowService extends ContainerAware implements WorkflowServiceInterface
{

    protected $workflowBuilders;
    protected $workflowConfigurations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workflowBuilders = array();
        $this->workflowConfigurations = array();
    }

    /**
     * @inheritdoc
     */
    function create(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $className = $workflowConfiguration->getBaseClass();

        return new $className($workflowConfiguration->getName());
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


    /**
     * @inheritdoc
     */
    public function start(WorkflowInterface $workflow)
    {

        $workflowConfiguration = $this->getWorkflowConfiguration($workflow->getConfigurationName());
        $builderClass = $workflowConfiguration->getBuilderClass();

        if (!array_key_exists($builderClass, $this->workflowBuilders)) {

           $this->workflowBuilders[$builderClass] = $this->loadWorkflowBuilder($workflow);

        }
        $workflowBuilder = $this->workflowBuilders[$builderClass];

        //Build the workflow execution model
        if ($workflowBuilder && $workflowBuilder->build($workflow)) {

            //Beam me up scotty
            return $workflow->start();

        } else {

            return false;
        }


    }

    /**
     * @inheritdoc
     */
    protected function loadWorkflowBuilder(WorkflowInterface $workflow)
    {

        $workflowConfiguration = $this->getWorkflowConfiguration($workflow->getConfigurationName());

        //Load the builder class, for now we only support the build of a ecz workflow
        $builderClassName = $workflowConfiguration->getBuilderClass();
        $builderOptions = $workflowConfiguration->getBuilderOptions();

        return new $builderClassName($builderOptions);

    }
}
