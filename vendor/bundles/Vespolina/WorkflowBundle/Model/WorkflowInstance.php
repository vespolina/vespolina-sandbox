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
use Vespolina\WorkflowBundle\Model\WorkflowInstanceInterface;


class WorkflowInstance implements WorkflowInstanceInterface
{
    protected $container;
    protected $runtimeInstance;
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
    public function getConfigurationName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Retrieve the runtime instance
     *
     * @return
     */
    public function getRuntimeInstance()
    {
        return $this->runtimeInstance;
    }

    public function setRuntimeInstance($runtimeInstance)
    {
        $this->runtimeInstance = $runtimeInstance;
    }

    /**
     * @inheritdoc
     */
    public function start()
    {
        if (!$this->runtimeInstance) {
            return false;
        }

        //$ezcInstance->start();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @inheritdoc
     */
    public function setConfigurationName($name)
    {
        $this->name = $name;
    }
}
