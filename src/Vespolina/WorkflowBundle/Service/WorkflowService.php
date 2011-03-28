<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\WorkflowBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\WorkflowBundle\Model\Workflow;
use Vespolina\WorkflowBundle\Model\WorkflowConfiguration;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;

use Vespolina\WorkflowBundle\Service\WorkflowServiceInterface;


class WorkflowService extends ContainerAware implements WorkflowServiceInterface
{

    /**
     * @inheritdoc
     */
    function create(WorkflowConfigurationInterface $workflowConfiguration)
    {
        $className = 'Vespolina\WorkflowBundle\Model\Workflow';

        return new $className($workflowConfiguration->getName());
    }
  
    /**
     * @inheritdoc
     */
    public function getWorkflowConfiguration($name)
    {
        $workflowConfiguration = new WorkflowConfiguration($name);
  
        return $workflowConfiguration;
    }
}
