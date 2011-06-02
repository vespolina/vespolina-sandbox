<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;


interface WorkflowActivityInterface{


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
     * Get the local activity container
     *
     * @abstract
     * @return void
     */
    public function getContainer();

    /**
     * Get name of the current activity (eg. vespolina.event.paypal_payment
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
    public function init();
    
}
