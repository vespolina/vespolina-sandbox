<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowContainerInterface;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;


class WorkflowExecution implements WorkflowExecutionInterface
{
    protected $container;
    protected $name;
    protected $status;
    protected $workflowExecutionId;
    protected $workflowRuntimeDefinition;
    protected $workflowRuntimeExecution;

    
    /**
     * Constructor
     *
     * @name string Name of the workflow
     * @container \Vespolina\WorkflowBundle\Model\WorkflowContainerInterface Workflow container
     */
    public function __construct($name, WorkflowContainerInterface $container = null)
    {
        if ($container != null)
        {
            $this->container = $container;

        } else
        {

            $this->container = new WorkflowContainer();
            
            //Set container values which we know at this point
        }

        $this->name = $name;
        $this->container->set('workflow.name', $this->name);

    }

    /**
     * @inheritdoc
     */
    public function getConfigurationName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getWorkflowContainer()
    {
        return $this->container;
    }

    /**
     * @inheritdoc
     */
    public function getWorkflowRuntimeDefinition()
    {
        return $this->workflowRuntimeDefinition;
    }

    /**
     * @inheritdoc
     */
    public function getWorkflowRuntimeExecution()
    {
        return $this->workflowRuntimeExecution;
    }

    /**
     * @inheritdoc
     */
    public function setWorkflowRuntimeDefinition($workflowRuntimeDefinition)
    {
        $this->workflowRuntimeDefinition = $workflowRuntimeDefinition;
    }

    /**
     * @inheritdoc
     */
    public function setWorkflowRuntimeExecution($workflowRuntimeExecution)
    {
        $this->workflowRuntimeExecution = $workflowRuntimeExecution;
    }

    /**
     * @inheritdoc
     */
    public function getWorkflowExecutionId()
    {
        return $this->workflowExecutionId;
    }


    /**
        * @inheritdoc
        */
       public function getIsExecutionFinished()
    {
        return $this->isExecutionFinished;

    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * @inheritdoc
     */
    public function setConfigurationName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function setWorkflowExecutionId($workflowExecutionId)
    {
        $this->workflowExecutionId = $workflowExecutionId;
    }


}
