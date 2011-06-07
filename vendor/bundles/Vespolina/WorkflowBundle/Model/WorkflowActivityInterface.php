<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

/**
 * The workflow activity represents an activity in the workflow process
 */
interface WorkflowActivityInterface{


    /**
     * Complete this workflow activity.  This is typically invoked after the activity was executed succesful
     *
     */
    public function completeActivity();

    /**
     * Execute this workflow activity
     *
     * @abstract
     * @return void
     */
    public function executeActivity();

    /**
     * Get the local activity container
     *
     * @abstract
     * @return void
     */
    public function getContainer();

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
     * Get the workflow instance which this activity is part off
     *
     * @abstract
     * @return void
     */
    public function getWorkflow();

    /**
     * Initialize this activity
     *
     * @abstract
     * @return void
     */
    public function initActivity();


    /**
     * Set whether or not the execution for this activity has been ended
     */
    function setIsExecutionFinished($isExecutionFinished);

}
