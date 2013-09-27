<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

use Vespolina\Entity\Pricing\Element\TotalDoughValueElement;
use Vespolina\Entity\Pricing\PricingSet;
use Vespolina\Entity\Product\ProductInterface;
use Vespolina\Entity\Product\Product;
use Vespolina\Pricing\Manager\PricingManager;

class CreateProducts extends AbstractSetupStep
{
    protected $pricingManager;
    protected $productManager;

    public function execute(&$context)
    {
        $this->productManager = $this->getContainer()->get('vespolina.product_manager');
        $this->pricingManager = $this->getContainer()->get('vespolina.pricing_manager');
        $this->pricingManager->addConfiguration('default_product', 'Vespolina\Entity\Pricing\PricingSet', array());

        $defaultTaxRate = $context['taxSchema']['defaultTaxRate'];
        $productCount = 10;

        /* @var $productTaxonomy Vespolina\Entity\Taxonomy\TaxonomyNodeInterface */
        $productTaxonomy = $context['productTaxonomy'];
        $productTaxonomyNodes = $productTaxonomy->getChildren();

        for ($i = 1; $i < $productCount; $i++) {

            // Pick a random taxonomy node (= product category) to which we'll be attaching this product
            $index = rand(0, $productTaxonomyNodes->count() - 1);
            $aRandomTaxonomyNode = $productTaxonomyNodes->get($index);

            // Determine the product name from the taxonomy name (eg. category "beer" -> product name is "beer 1"
            $singularNodeName = substr($aRandomTaxonomyNode->getName(), 0, strlen($aRandomTaxonomyNode->getName()) - 1);
            $productName = ucfirst($singularNodeName) . ' ' . $i;
            $aProduct = $this->productManager->createProduct();
            $aProduct->setName($productName);
            $aProduct->setSlug($this->productManager->slugify($aProduct->getName()));
            $aProduct->setType(Product::PHYSICAL);

            // Setup various product descriptions
            $this->buildProductDescriptions($aProduct);

            // Setup some product options
            $this->buildProductOptions($aProduct);

            // Setup some product prices
            $this->buildProductPrices($aProduct, $defaultTaxRate);

            // Setup some product media
            $this->buildProductAssets($aProduct);

            $aProduct->addTaxonomy($aRandomTaxonomyNode);

            $this->productManager->updateProduct($aProduct, true);
        }

        $this->getLogger()->addInfo('Created ' . $productCount . ' sample products.' );
    }

    public function getName()
    {
        return 'create_products';
    }

    protected function buildProductAssets(ProductInterface $product)
    {
        //Set up a nice primary media item
        /**$imageBasePath = 'bundles' . DIRECTORY_SEPARATOR .
        'applicationvespolinastore' . DIRECTORY_SEPARATOR .
        'images' . DIRECTORY_SEPARATOR .
        $this->type . DIRECTORY_SEPARATOR . $singularTermName . '-' . $i ;
        ;*/

        /**
        $asset = $this->productManager->getAssetManager()->createAsset(
        $aProduct,
        $imageBasePath . '.jpg',
        'main_detail'
        );
        $asset = $this->productManager->getAssetManager()->createAsset(
        $aProduct,
        $imageBasePath . '_thumb.jpg',
        'thumbnail'
        );

        for ($c = 1; $c<= rand(0,5); $c++)
        {
        $asset = $this->productManager->getAssetManager()->createAsset(
        $aProduct,
        $imageBasePath . '.jpg',
        'secondary_detail'
        );
        }
         */
    }

    protected function buildProductDescriptions(ProductInterface $product)
    {
        $product->setDescription('Brief description of ' . $product->getName(), 'brief');
        $product->setDescription('Extended description of ' . $product->getName(), 'extended');
        $product->setDescription('Big and detailed description of ' . $product->getName(), 'detail');
    }

    protected function buildProductOptions(ProductInterface $product)
    {
        $config = array();
        $config[] = array( 'type' => 'small',
                            'name' => 'small bottle',
                            'surcharge'  => 0);
        $config[] = array( 'type' => 'large',
                            'name' => 'large bottle',
                            'surcharge'  => 5);

        foreach ($config as $optionConfig) {
            $option = $this->productManager->createOption($optionConfig['type'], $optionConfig['name']);
        }
    }

    protected function buildProductPrices(ProductInterface $product, $defaultTaxRate)
    {
        /** Set up for each product following pricing elements
         *  - netValue : unit price without tax
         *  - unitPriceMSRP: manufacturer suggested retail price without tax
         *  - unitPriceTax : tax over the net unit price (based on the default tax rate)
         *  - unitPriceTotal: final price a customer pays ( net unit price + tax )
         *  - unitMSRPTotal: manufacturer suggested retail price with tax
         **/

        $pricingValues = array();
        $pricingValues['netValue'] = rand(2,80);

        // Set Manufacturer Suggested Retail Price to +(random) % of the net unit price
        $pricingValues['MSRPDiscountRate'] = rand(10,35);
        $pricingValues['unitPriceMSRP'] = $pricingValues['netValue'] * ( 1 + $pricingValues['MSRPDiscountRate'] / 100);

        if ($defaultTaxRate) {
            $pricingValues['unitPriceTax'] = $pricingValues['netValue'] / 100 * $defaultTaxRate;
            $pricingValues['unitPriceMSRPTotal'] = $pricingValues['unitPriceMSRP'] * (1 + $defaultTaxRate / 100);
            $pricingValues['unitPriceTotal'] = $pricingValues['netValue'] + $pricingValues['unitPriceTax'];
        } else {
            $pricingValues['unitPriceTotal'] = $pricingValues['netValue'];
            $pricingValues['unitPriceMSRPTotal'] = $pricingValues['unitPriceMSRP'];
        }

        $pricingSet = $this->pricingManager->createPricing($pricingValues, 'default_product');
        $product->setPricing($pricingSet);
    }
}
