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
interface WorkflowBuilderInterface
{
    /**
     * Build the runtime workflow
     *
     */
    function build(WorkflowConfigurationInterface $workflowConfiguration, $workflowFactory);
}
