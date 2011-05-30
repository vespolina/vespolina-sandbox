<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

interface WorkflowInstanceInterface
{
    /**
     * Get the workflow configuration name
     *
     * @abstract
     * @return string
     */
    function getConfigurationName();

    /**
     * Set the workflow configuration name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setConfigurationName($name);

    /**
     * Return the workflow container
     * @return Vespolina\WorkflowBundle\Model\WorkflowContainerInterface
     */
    function getContainer();

    /**
     * Get the current status of the workflow
     *
     * @abstract
     * @return void
     */
    function getStatus();

    /**
     * Start workflow execution
     *
     * @abstract
     * @return bool
     */
    function start();
}
