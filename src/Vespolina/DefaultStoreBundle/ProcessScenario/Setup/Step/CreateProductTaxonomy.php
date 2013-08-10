<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Vespolina\StoreBundle\Process\AbstractProcessStep;

class CreateProductTaxonomy extends AbstractSetupStep
{
    protected $taxonomyManager;

    public function init($firstTime = false) {

        $this->taxonomyManager = $this->getContainer()->get('vespolina.taxonomy_manager');
    }

    public function execute(&$context) {

        $productTaxonomyNode = $this->taxonomyManager->createTaxonomyNode('products');
        $this->taxonomyManager->updateTaxonomyNode($productTaxonomyNode, true);

        $termFixtures = array();

        switch($context['type']) {

            case 'band':

                $termFixtures = array();
                $termFixtures[] = array('path' => 'clothing', 'name' => 'Clothing');
                $termFixtures[] = array('path' => 'downloadable-tracks', 'name' => 'Downloadable tracks');
                break;

            case 'beverages':

                $termFixtures = array();
                $termFixtures[] = array('path' => 'beers', 'name' => 'Beers');
                $termFixtures[] = array('path' => 'wines',  'name' => 'Wines');
                break;

            case 'fashion':

                $termFixtures[] = array('path' => 'dresses', 'name' => 'Dresses');
                $termFixtures[] = array('path' => 'pants', 'name' => 'Pants');
                $termFixtures[] = array('path' => 'shoes', 'name' => 'Shoes');

                break;
            default:
                return;

        }
        foreach($termFixtures as $termFixture) {

            $node = $this->taxonomyManager->createTaxonomyNode($termFixture['name'], $productTaxonomyNode);
            $this->taxonomyManager->updateTaxonomyNode($node, true);

            //($termFixture['path'], $termFixture['name']);
            //$aTaxonomy->addTerm($aTerm);
        }

        $this->taxonomyManager->updateTaxonomyNode($productTaxonomyNode, true);
        $context['productTaxonomy'] = $productTaxonomyNode;

        $this->getLogger()->addInfo('Product taxonomy has been setup with ' . count($termFixtures) . ' terms.' );

    }

    public function getName() {

        return 'create_product_taxonomy';
    }
}
