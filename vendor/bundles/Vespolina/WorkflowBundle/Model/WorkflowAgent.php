<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Vespolina\WorkflowBundle\Model\WorkflowAgentInterface;

class WorkflowAgent implements WorkflowAgentInterface{

    protected $isHuman;
    protected $name;


    public function __construct($isHuman = true)
    {

        $this->isHuman = $isHuman;
    }

    /**
     * @inheritdoc
     */
    public function isHuman()
    {
        return $this->isHuman;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {

        return $this->name;
    }
    
    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

    }

    /**
     * @inheritdoc
     */
    public function setIsHuman($isHuman)
    {
        $this->isHuman = $isHuman;

    }

}
