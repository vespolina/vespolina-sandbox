<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

use Vespolina\WorkflowBundle\Event\WorkflowActivityEvent;
use Vespolina\WorkflowBundle\Model\WorkflowActivityInterface;
use Vespolina\WorkflowBundle\Model\WorkflowContainer;


class WorkflowActivity implements WorkflowActivityInterface{

    protected $container;
    protected $dispatcher;
    protected $name;
    protected $workflow;

    public function __construct($name, $workflow, $dispatcher)
    {

        $this->container = new WorkflowContainer();
        $this->dispatcher = $dispatcher;
        $this->name = $name;
        $this->workflow = $workflow;
    }

    /**
     * @inheritdoc
     */
    public function complete()
    {

        $event = new WorkflowActivityEvent($this);
        $this->dispatcher($this, $this->name . '.completed', $event);
    }
    
    /**
     * @inheritdoc
     */
    public function execute()
    {

        $event = new WorkflowActivityEvent($this);
        $this->dispatcher($this, $this->name . '.execute', $event);
    }

    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        return $this->container;
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
    public function getWorkflow()
    {

        return $this->workflow;
    }

    /**
     * @inheritdoc
     */
    public function init()
    {

        $event = new WorkflowActivityEvent($this);
        $this->dispatcher($this, $this->name . '.init', $event);
    }
}
