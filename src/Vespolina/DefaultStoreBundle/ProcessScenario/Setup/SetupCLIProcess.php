<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup;

use Vespolina\CommerceBundle\Process\AbstractProcess;
use Vespolina\CommerceBundle\Process\ProcessDefinition;
use Vespolina\CommerceBundle\Process\ProcessDefinitionInterface;

/**
 * This process models a setup of a V sandbox store using the command line
 *
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class SetupCLIProcess extends AbstractProcess
{

    protected $currentStepIndex;

    public function build() {

        $definition = new ProcessDefinition();
        $definition->addProcessStep('create_customer_taxonomy',
                                    'Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step\CreateCustomerTaxonomy');
        $definition->addProcessStep('create_customers',
                                    'Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step\CreateCustomers');
        $definition->addProcessStep('create_employees',
                                    'Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step\CreateEmployees');
        $definition->addProcessStep('create_taxation',
                                    'Vespolina\StoreBundle\ProcessScenario\Setup\Step\CreateTaxation');
        $definition->addProcessStep('create_product_taxonomy',
                                    'Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step\CreateProductTaxonomy');
        $definition->addProcessStep('create_products',
                                    'Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step\CreateProducts');
        $definition->addProcessStep('create_store',
                                    'Vespolina\StoreBundle\ProcessScenario\Setup\Step\CreateStore');

        return $definition;
    }

    public function execute()
    {
        foreach ($this->definition->getSteps() as $stepDefinition) {

            $processStep = new $stepDefinition['class']($this);
            $processStep->init();
            $processStep->execute($this->context);
        }
    }

    public function getName()
    {
        return 'setup_cli_process';
    }

}
