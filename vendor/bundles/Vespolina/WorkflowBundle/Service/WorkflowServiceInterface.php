<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\WorkflowBundle\Service;

use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;

interface WorkflowServiceInterface
{

    /**
     * Create a workflow exeuction instance for a given workflow configuration
     *
     * @abstract
     * @param \Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface $workflowConfiguration
     * @return \Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface
     */
    public function createWorkflowExecution(WorkflowConfigurationInterface $workflowConfiguration);

    public function execute(WorkflowExecutionInterface $workflowExecution);


    /**
     * Get the workflow configuration for the given name
     *
     * @abstract
     * @param  $name
     * @return \Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface
     */
    public function getWorkflowConfiguration($name);

    /**
     * Save the state of the given workflow instance
     *
     * @abstract
     * @param \Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface $workflowExecution
     * @return true on success
     */
    public function save(WorkflowExecutionInterface $workflowExecution);


    /**
     * Save the current workflow configuration
     *
     * @abstract
     * @param \Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface $workflowConfiguration
     * @return void
     */
    public function saveConfiguration(WorkflowConfigurationInterface $workflowConfiguration);

}
