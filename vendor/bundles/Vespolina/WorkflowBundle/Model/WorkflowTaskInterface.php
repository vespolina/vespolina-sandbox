<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Vespolina\WorkflowBundle\Model\WorkflowActivityInterface;
use Vespolina\WorkflowBundle\Model\WorkflowAgentInterface;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;


/**
 * The workflow task represents a task to be performed by a workflow agent.
 * Typically when a workflow activity needs user interaction, a workflow task is created.
 * This task is assigned to a workflow agent (or assigned to a group of workflow agents)
 */
interface WorkflowTaskInterface{


    /**
     * Add a workflow agent to this task
     */
    public function addAgent(WorkflowAgentInterface $agent, $role);

    /**
     * Assign this task to a particular workflow agent.
     *
     */
    public function assignTo(WorkflowAgentInterface $agent);


    /**
     * Get the agent for the given role
     */
    public function getAgentForRole($role);
    
    /**
       * Get all agents involved for this task
       *
       * @abstract
       * @return array of WorkflowAgentInterface instances
       */
    public function getAgents();

    /**
     * Returns the agent to whom this task is assigned to
     */
    public function getAssignedTo();
    
    /**
     * Returns the agent which completed the task
     */
    public function getCompletedBy();

    /**
     * Get the name of the task
     *
     */
    public function getName();

    /**
     * Retrieve the workflow activity instance which triggered the creation of this task
     */
    public function getWorkflowActivity();

    /**
     * Retrieve the workflow execution instance which of which this task is part of
     */
    public function getWorkflowExecution();

    /**
     * Is this task assigned to anybody?
     */
    public function isAssigned();

    /**
     * Has this task been completed?
     */
    public function isCompleted();

    /**
     * Set name of this workflow task
     */
    public function setName($name);

     /**
     * Set the workflow activity instance which triggered the creation of this task
     */
    public function setWorkflowActivity(WorkflowActivityInterface $workflowActivity);

    /**
     * Set the workflow execution instance which of which this task is part of
     */
    public function setWorkflowExecution(WorkflowExecutionInterface $workflowExecution);
}
