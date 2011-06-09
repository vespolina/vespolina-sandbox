<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

interface WorkflowExecutionInterface
{
    /**
     * Get the workflow configuration name
     *
     * @abstract
     * @return string
     */
    function getConfigurationName();

    /**
     * Return the workflow container
     * @return Vespolina\WorkflowBundle\Model\WorkflowContainerInterface
     */
    function getWorkflowContainer();

    function getWorkflowRuntimeDefinition();
    
    function getWorkflowRuntimeExecution();

    /**
     * Get the current status of the overall workflow execution
     *
     * @abstract
     * @return void
     */
    function getStatus();

    /**
     * Get the workflow execution id
     */
    function getWorkflowExecutionId();


    /**
     * Set the workflow configuration name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setConfigurationName($name);


    /**
     * Set the workflow runtime definition
     *
     * @abstract
     * @param  $workflowRuntimeDefinition
     * @return void
     */
    function setWorkflowRuntimeDefinition($workflowRuntimeDefinition);

    /**
     * Set the workflow runtime execution of the definition
     *
     * @abstract
     * @param  $workflowRuntimeDefinition
     * @return void
     */
    function setWorkflowRuntimeExecution($workflowRuntimeExecution);

    /**
     * Set the workflow execution id
     *
     * @abstract
     * @param  $worfklowExecutionId
     * @return void
     */
    function setWorkflowExecutionId($worfklowExecutionId);
}
