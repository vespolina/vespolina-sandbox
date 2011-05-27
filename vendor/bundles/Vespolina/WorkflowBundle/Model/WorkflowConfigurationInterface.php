<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

interface WorkflowConfigurationInterface
{
    /**
     * Get the workflow base class
     */
    function getBaseClass();

    /**
     * Get the workflow builder class
     */
    function getBuilderClass();

    /**
     * Get the workflow builder class
     */
    function getBuilderOptions();

    /**
     * Get the workflow configuration name
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Set the workflow base class
     */
    function setBaseClass($baseClass);

    /**
     * Set the workflow builder class
     */
    function setBuilderClass($builderClass);

    /**
     * Set the workflow builder options
     */
    function setBuilderOptions($builderOptions);

    /**
     * Set the workflow configuration name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);
}
