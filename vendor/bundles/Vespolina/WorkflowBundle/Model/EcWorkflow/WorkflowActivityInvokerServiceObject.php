<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 * This is a Zeta Components specific implementation of Vespolina's workflow activity
 */

namespace Vespolina\WorkflowBundle\Model\EcWorkflow;

use Vespolina\WorkflowBundle\Model\WorkflowActivity;
use Vespolina\WorkflowBundle\Model\WorkflowExecutionInterface;


class WorkflowActivityInvokerServiceObject implements \ezcWorkflowServiceObject {

    protected $activityName;
    protected $eventDispatcher;
    protected $workflowActivityClass;
    protected $workflowExecution;

    public function __construct($workflowActivityClass, $activityName, WorkflowExecutionInterface $workflowExecution = null, $eventDispatcher )
    {
        $this->activityname = $activityName;
        $this->eventDispatcher = $eventDispatcher;
        $this->workflowActivityClass = $workflowActivityClass;
        $this->workflowExecution = $workflowExecution;

    }

    public function execute( \ezcWorkflowExecution $execution )
    {

       //Create the workflow activity instance & execute it
        $workflowActivity = new $this->workflowActivityClass($this->activityName, $this->workflowExecution, $this->eventDispatcher);
        
        $workflowActivity->executeActivity();

    }

    public function __toString()
    {
        return "WorkflowActivityInvokerServiceObject{$this->workflowActivityClass}";
    }


}
