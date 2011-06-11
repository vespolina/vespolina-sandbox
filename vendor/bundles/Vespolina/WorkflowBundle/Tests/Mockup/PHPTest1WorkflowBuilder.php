<?php

/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Tests\Mockup;

use Vespolina\WorkflowBundle\Model\WorkflowBuilderInterface;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowInstanceInterface;


class PHPTest1WorkflowBuilder implements WorkflowBuilderInterface
{
    protected $builderOptions;

    public function __construct($builderOptions = array())
    {
        $this->builderOptions = $builderOptions;
    }

    /**
     * @inheritdoc
     */
    public function build(WorkflowConfigurationInterface $workflowConfiguration, $workflowFactory)
    {

        //This test is very simple:

        //Start => Activity1 => Activity2 => End

        //Activity 1 sets workflow container value "total" to 1
        //Activity 2 sets workflow container value "total" to 2


        $workflow = new \ezcWorkflow($workflowConfiguration->getName());

        $activity1 = $workflowFactory->createWorkflowActivityInvokerNode(
                            'Vespolina\WorkflowBundle\Tests\Mockup\AddOneToTotalWorkflowActivity',
                            'add_one_to_total_1');
        
        $activity2 = $workflowFactory->createWorkflowActivityInvokerNode(
                            'Vespolina\WorkflowBundle\Tests\Mockup\AddOneToTotalWorkflowActivity',
                            'add_one_to_total_2');

        $activity3 = $workflowFactory->createWorkflowActivityInvokerNode(
                            'Vespolina\WorkflowBundle\Tests\Mockup\CreateTaskForVerificationActivity',
                            'verify_results');

        $workflow->startNode->addOutNode($activity1);

        $activity1->addOutNode($activity2);
        $activity2->addOutNode($activity3);
        $activity3->addOutNode($workflow->endNode);
       

        return $workflow;
    }
}
