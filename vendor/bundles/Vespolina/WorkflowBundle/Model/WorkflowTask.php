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
use Vespolina\WorkflowBundle\Model\WorkflowTaskInterface;


class WorkflowTask implements WorkflowTaskInterface{

    protected $agents;
    protected $name;
    protected $workflowActivity;
    protected $workflowExecution;


    public function __construct()
    {

        $this->agents = array();
    }

    public function assignTo(WorkflowAgentInterface $agent)
    {

        $this->setAgentForRole($agent, 'assigned_to');
    }
    
    public function addAgent(WorkflowAgentInterface $agent, $role)
    {

        $this->agents[$role] = $agent;
    }

    public function getAgents()
    {

        return $this->agents;
    }
    
    public function getAgentForRole($role)
    {
        if( array_key_exists($role, $this->agents) )
        {

            return $this->agents[$role];
        }
    }
    
    public function getAssignedTo()
    {

        return $this->getAgentForRole('assigned_to');
    }

    public function getCompletedBy()
    {

        return $this->getAgentForRole('completed_by');
    }

    public function getName()
    {

        return $this->name;
    }
    
    public function getWorkflowActivity()
    {

        return $this->workflowActivity;
    }
    
    public function getWorkflowExecution()
    {

        return $this->workflowExecution;
    }

    public function isAssigned()
    {

        return array_key_exists('assigned_to', $this->agents);
    }

    public function isCompleted()
    {

        return array_key_exists('completed_by', $this->agents);
    }

    public function setAgentForRole(WorkflowAgentInterface $agent, $role)
    {

        $this->agents[$role] = $agent;
    }

    public function setName($name)
    {
       $this->name = $name;
    }
    
    public function setWorkflowActivity(WorkflowActivityInterface $workflowActivity)
    {
        $this->workflowActivity = $workflowActivity;

    }
    public function setWorkflowExecution(WorkflowExecutionInterface $workflowExecution)
    {
        $this->workflowExecution = $workflowExecution;

    }

}
