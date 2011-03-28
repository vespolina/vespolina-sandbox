<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowContainerInterface;


class Workflow implements WorkflowInterface
{

    protected $container;
    protected $name;
    protected $status;

    /**
     * Constructor
     *
     * @name string Name of the workflow
     * @container \Vespolina\WorkflowBundle\Model\WorkflowContainerInterface Workflow container
     */
    public function __construct($name, WorkflowContainerInterface $container = null)
    {
        if ($container) {

            $this->container = $container;

        } else {

            $this->container = new WorkflowContainer();
        }

        $this->name = $name;
        //Set container values which we know at this point
        $this->container->set('workflow.name', $this->name);
    }

    /**
     * @inheritdoc
     */
    public function getConfigurationName(){
    
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getContainer(){

        return $this->container;
    }

    /**
     * @inheritdoc
     */
    public function start(){

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getStatus(){

        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setConfigurationName($name){
    
        $this->name = $name;
        
    }

}
