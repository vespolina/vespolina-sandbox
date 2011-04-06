<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

interface WorkflowStatusInterface
{
    /**
     * Get the name of the status
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Set the name of the status
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);
}