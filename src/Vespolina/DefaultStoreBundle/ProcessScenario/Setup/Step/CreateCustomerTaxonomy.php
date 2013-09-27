<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

class CreateCustomerTaxonomy extends AbstractSetupStep
{
    protected $taxonomyManager;

    public function init($firstTime = false)
    {
        $this->taxonomyManager = $this->getContainer()->get('vespolina.taxonomy_manager');
    }

    public function execute(&$context)
    {
        $customerTaxonomyNode = $this->taxonomyManager->createTaxonomyNode('customers');
        $termFixtures = array();

        $termFixtures[] = array('path' => 'bronze', 'name' => 'Bronze');
        $termFixtures[] = array('path' => 'silver', 'name' => 'Silver');
        $termFixtures[] = array('path' => 'gold', 'name' => 'Gold');

        foreach($termFixtures as $termFixture) {

            $node = $this->taxonomyManager->createTaxonomyNode($termFixture['name']);
            $node->setParent($customerTaxonomyNode);

        }
        $this->taxonomyManager->updateTaxonomyNode($customerTaxonomyNode, true);
        $this->getLogger()->addInfo('Customer taxonomy has been setup with ' . count($termFixtures) . ' terms.' );

        $context['customerTaxonomy'] = $customerTaxonomyNode;
    }

    public function getName()
    {
        return 'create_customer_taxonomy';
    }
}
