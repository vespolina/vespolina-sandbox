<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * The workflow activity represents an activity in the workflow process
 */
interface WorkflowActivityInterface extends ContainerAwareInterface{

    /**
     * Activate this workflow activity.  This triggers init(), execute(), complete() and so on
     *
     * @abstract
     * @return void
     */
    public function activate();

    /**
     * Complete this workflow activity.  This is typically invoked after the activity was executed succesful
     *
     */
    public function complete();

    /**
     * Execute this workflow activity
     *
     * @abstract
     * @return void
     */
    public function execute();

    /**
     * Returns whether or not the execution for this activity has been ended
     */
    function getIsExecutionFinished();

    /**
     * Get name of the current activity (eg. vespolina.event.paypal_payment)
     *
     * @abstract
     * @return void
     */
    public function getName();

    /**
     * Get the workflow container
     *
     * @abstract
     * @return void
     */
    public function getWorkflowContainer();


    /**
     * Get the workflow execution instance which this activity is part off
     *
     * @abstract
     * @return void
     */
    public function getWorkflowExecution();

    /**
     * Initialize this activity for activation & execution
     *
     * @abstract
     * @return void
     */
    public function init();


    /**
     * Set whether or not the execution for this activity has been ended
     */
    function setIsExecutionFinished($isExecutionFinished);


}
