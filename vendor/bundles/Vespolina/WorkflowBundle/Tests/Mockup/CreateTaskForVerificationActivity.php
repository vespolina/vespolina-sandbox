<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\WorkflowBundle\Tests\Mockup;

use Vespolina\WorkflowBundle\Model\WorkflowActivity;
use Vespolina\WorkflowBundle\Model\WorkflowAgent;


class CreateTaskForVerificationActivity extends WorkflowActivity {


    public function execute()
    {

        $workflowTaskService = $this->container->get('vespolina.workflow_task');

        $task = $workflowTaskService->createTask($this);

        $workflowAgentJamesBond = new WorkflowAgent(true);
        $workflowAgentJamesBond->setName('James Bond 007');

        $task->assignTo($workflowAgentJamesBond);

        $workflowTaskService->saveTask($task);

    }

}
