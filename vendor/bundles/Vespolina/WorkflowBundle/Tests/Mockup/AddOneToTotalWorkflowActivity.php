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

class AddOneToTotalWorkflowActivity extends WorkflowActivity {

    public function execute()
    {

        if( !$total = $this->workflowContainer->get('total') )
        {
            $total = 0;
        }

        $total = $total + 1;

        $this->workflowContainer->set('total', $total);

        echo 'total for ' . $this->name . ' is ' . $total;
    }
}
