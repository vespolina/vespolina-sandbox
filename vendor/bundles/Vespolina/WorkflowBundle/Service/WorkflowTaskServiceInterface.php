<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\WorkflowBundle\Service;

use Vespolina\WorkflowBundle\Model\WorkflowActivityInterface;
use Vespolina\WorkflowBundle\Model\WorkflowAgentInterface;
use Vespolina\WorkflowBundle\Model\WorkflowTaskInterface;


interface WorkflowTaskServiceInterface
{

    /**
     * Create a workflow task
     *
     * @abstract
     * @return \Vespolina\WorkflowBundle\Model\WorkflowTaskInterface
     */
    function createTask(WorkflowActivityInterface $workflowActivity = null);

    /**
     * Get workflow tasks for the given workflow agent
     *
     */
    function getTasksForWorkflowAgent(WorkflowAgentInterface $workflowAgent = null);
    /**
     * Save the given workflow task
     *
     * @param $workflowTask \Vespolina\WorkflowBundle\Model\WorkflowTaskInterface
     */
    function saveTask(WorkflowTaskInterface $workflowTask);

}
