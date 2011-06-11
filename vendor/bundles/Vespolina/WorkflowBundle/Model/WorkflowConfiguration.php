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

class WorkflowConfiguration implements WorkflowConfigurationInterface
{
    protected $baseClass  = 'Vespolina\WorkflowBundle\Model\WorkflowExecution';
    protected $builderClass;
    protected $builderOptions;
    protected $name;
    protected $version;

    /**
     * Constructor
     */
    public function __construct($name)
    {

        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getBaseClass()
    {

        return $this->baseClass;
    }

    /**
     * @inheritdoc
     */
    public function getBuilderClass()
    {

        return $this->builderClass;
    }

    /**
     * @inheritdoc
     */
    public function getBuilderOptions()
    {

        return $this->builderOptions;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the workflow version
     */
    public function getVersion()
    {

        return $this->version;
    }
    /**
     * @inheritdoc
     */
    public function setBaseClass($baseClass)
    {
        $this->baseClass = $baseClass;
    }

    /**
     * @inheritdoc
     */
    public function setBuilderClass($builderClass)
    {
        $this->builderClass = $builderClass;
    }

    /**
     * @inheritdoc
     */
    public function setBuilderOptions($builderOptions)
    {
        $this->builderOptions = $builderOptions;
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
    public function setVersion($version)
    {
        $this->version = $version;
    }
}
