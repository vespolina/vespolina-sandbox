<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Vespolina\WorkflowBundle\Model\WorkflowActivity;

class WorkflowActivityEvent extends Event{

    protected $workflowActivity;

    public function __construct($workflowActivity)
    {
        $this->workflowActivity = $workflowActivity;
    }


    public function getWorkflowActivity()
    {
        return $this->workflowActivity;
    }
    
}
