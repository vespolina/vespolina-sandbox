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

use Vespolina\WorkflowBundle\Model\WorkflowActivityInterface;
use Vespolina\WorkflowBundle\Model\WorkflowAgentInterface;
use Vespolina\WorkflowBundle\Model\WorkflowTask;
use Vespolina\WorkflowBundle\Model\WorkflowTaskInterface;
use Vespolina\WorkflowBundle\Service\WorkflowTaskServiceInterface;

class WorkflowTaskService extends ContainerAware implements WorkflowTaskServiceInterface
{
    protected $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {

        $tasks = array();
    }

    /**
     * @inheritdoc
     */
    public function createTask(WorkflowActivityInterface $workflowActivity = null)
    {

        $workflowTask = new WorkflowTask();

        if( $workflowActivity )
        {
            $workflowTask->setName($workflowActivity->getName());
        }
        
        return $workflowTask;
    }

    public function getTasksForWorkflowAgent(WorkflowAgentInterface $workflowAgent = null)
    {

        return $this->tasks;
    }


    /**
     * @inheritdoc
     */
    public function saveTask(WorkflowTaskInterface $workflowTask)
    {

        $this->tasks[] = $workflowTask;
    }
}
