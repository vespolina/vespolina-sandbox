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

class EcWorkflowActivity extends WorkflowActivity implements ezcWorkflowServiceObject {



    public function execute( ezcWorkflowExecution $execution )
    {

       $this->executeActivity();

    }
}
