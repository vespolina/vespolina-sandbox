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
 * The workflow agent represents a human or system entity
 * part of a workflow process actively involved in the process
 */

interface WorkflowAgentInterface{

    /**
     * Get name of the entity
     *
     * @abstract
     * @return void
     */
    public function getName();

    /**
     * Is the agent a human being?
     *
     * @abstract
     * @return bool
     */
    public function isHuman();


    /**
     * ISet whether or not the worklow agent is a human being
     *
     * @abstract
     * @return bool
     */
    public function setIsHuman($isHuman);
}
