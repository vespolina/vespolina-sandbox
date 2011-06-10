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

namespace Vespolina\WorkflowBundle\Model\EczWorkflow;

use DoctrineExtensions\Workflow\WorkflowFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CustomWorkflowFactory extends \DoctrineExtensions\Workflow\WorkflowFactory{

    protected static $DIContainer;


    public static function getDIContainer()
    {

        return CustomWorkflowFactory::$DIContainer;
    }

    public static function setDIContainer($container)
    {
        CustomWorkflowFactory::$DIContainer = $container;
    }

    /**
     * @param  string $className  Name of the workflow activity class
     * @param  string $activityName Short name of the activity
     * @return WorkflowActivityInvokerServiceObject 
     */
    public function createWorkflowActivityInvokerNode($className, $activityName, $configuration = null)
    {
        $workflowActivityInvoker = new \ezcWorkflowNodeAction(
            array( 'class' => 'Vespolina\WorkflowBundle\Model\EczWorkflow\WorkflowActivityInvokerServiceObject',
               'arguments' => array( $className,
                                     $activityName)));
        return $workflowActivityInvoker;

    }

}
