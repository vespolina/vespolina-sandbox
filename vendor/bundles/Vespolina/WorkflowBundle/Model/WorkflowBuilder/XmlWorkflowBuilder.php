<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model\WorkflowBuilder;

use Vespolina\WorkflowBundle\Model\WorkflowBuilderInterface;
use Vespolina\WorkflowBundle\Model\WorkflowConfigurationInterface;
use Vespolina\WorkflowBundle\Model\WorkflowInstanceInterface;


class XmlWorkflowBuilder implements WorkflowBuilderInterface
{
    protected $builderOptions;

    public function __construct($builderOptions = array())
    {
        $this->builderOptions = $builderOptions;
    }

    /**
     * @inheritdoc
     */
    public function build(WorkflowConfigurationInterface $workflowConfiguration, $workflowFactory)
    {
        $xmlSource = $this->builderOptions['source'];

        /** TODO: load from .xml
        $definition = new \ezcWorkflowDefinitionStorageXml( $xmlSource );

        if ($definition) {

        $runtimeInstance = $definition->loadByName( $workflow->getConfigurationName() );
        }
         */

        //Test for now: just manually create the workflow instance from some sample ecz code
        $runtimeInstance = $this->createPrototype($workflowConfiguration);




        return $runtimeInstance;
    }

    public function createPrototype($workflowConfiguration)
    {
        //Example taken from Zeta Components library
        $workflow = new \ezcWorkflow($workflowConfiguration->getName());
        
        $input = new \ezcWorkflowNodeInput(
            array('choice' => new \ezcWorkflowConditionIsBool)
        );
        // Add the previously created Input node
        // as an outgoing node to the start node.
        $workflow->startNode->addOutNode($input);
        // Create a new Exclusive Choice node and add it as an
        // outgoing node to the previously created Input node.
        // This node will choose which output to run based on the
        // choice workflow variable.
        $branch = new \ezcWorkflowNodeExclusiveChoice;
        $branch->addInNode($input);
        // Either $true or $false will be run depending on
        // the above choice.
        // Note that neither $true nor $false are valid action nodes.
        // see the next example
        $trueNode = new \ezcWorkflowNodeAction('PrintTrue');
        $falseNode = new \ezcWorkflowNodeAction('PrintFalse');
        // Branch
        // Condition: Variable "choice" has boolean value "true".
        // Action:    PrintTrue service object.
        $branch->addConditionalOutNode(
            new \ezcWorkflowConditionVariable('choice', new \ezcWorkflowConditionIsTrue),
            $trueNode);
        // Branch
        // Condition: Variable "choice" has boolean value "false".
        // Action:    PrintFalse service object.
        $branch->addConditionalOutNode(
            new \ezcWorkflowConditionVariable('choice', new \ezcWorkflowConditionIsFalse),
            $falseNode
        );
        // Create SimpleMerge node and add the two possible threads of
        // execution as incoming nodes of the end node.
        $merge = new \ezcWorkflowNodeSimpleMerge;
        $merge->addInNode($trueNode);
        $merge->addInNode($falseNode);
        $merge->addOutNode($workflow->endNode);

        return $workflow;
    }
}
