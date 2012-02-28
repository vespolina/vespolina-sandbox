<?php

namespace Vespolina\StoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SetupCommand extends ContainerAwareCommand
{

    protected $input;
    protected $country;
    protected $output;
    protected $type;

    protected function configure()
    {
        $this
            ->setName('vespolina:setup')
            ->setDescription('Setup a Vespolina demo store')
            ->addOption('country', null, InputOption::VALUE_OPTIONAL, 'Country')
            ->addOption('type', null, InputOption::VALUE_OPTIONAL, 'Store type')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->country = $input->getOption('country', 'be');
        $this->type = $input->getOption('type', 'band');

        $store = $this->setupStore($input, $output);
        $customerTaxonomy = $this->setupCustomerTaxonomy($input, $output);
        $productTaxonomy = $this->setupProductTaxonomy($input, $output);
        $this->setupProducts($input, $output);


        $output->writeln('Finished setting up demo store "' . $store->getName() . '" for country "' . $this->country . '" with type "' . $this->type . '"');
    }

    protected function setupCustomerTaxonomy($input, $output){

        $taxonomyManager = $this->getContainer()->get('vespolina.taxonomy_manager');
        $aTaxonomy = $taxonomyManager->createTaxonomy('customers', 'tags');
        $termFixtures = array();

        $termFixtures[] = array('path' => 'bronze', 'name' => 'Bronze');
        $termFixtures[] = array('path' => 'silver', 'name' => 'Silver');
        $termFixtures[] = array('path' => 'gold', 'name' => 'Gold');

        foreach($termFixtures as $termFixture) {

            $aTerm = $taxonomyManager->createTerm($termFixture['path'], $termFixture['name']);
            $aTaxonomy->addTerm($aTerm);
        }

        $taxonomyManager->updateTaxonomy($aTaxonomy, true);

        $output->writeln('Customer taxonomy has been setup with ' . count($termFixtures) . ' terms.' );
        return $aTaxonomy;
    }

    protected function setupProducts($input, $output)
    {
        $productCount = 10;

        $productManager = $this->getContainer()->get('vespolina.product_manager');

        for($i = 1; $i < $productCount; $i++) {

            $aProduct = $productManager->createProduct();
            $aProduct->setName('product ' . $i);
            $productManager->updateProduct($aProduct, true);
        }

        $output->writeln('Created ' . $productCount . ' products.' );
    }


    protected function setupProductTaxonomy($input, $output)
    {

        $taxonomyManager = $this->getContainer()->get('vespolina.taxonomy_manager');
        $aTaxonomy = $taxonomyManager->createTaxonomy('products', 'tags');

        $termFixtures = array();

        switch($this->type) {

            case 'band':

                $termFixtures = array();
                $termFixtures[] = array('path' => 'downloadable-tracks', 'name' => 'Downloadable tracks');
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

            $aTerm = $taxonomyManager->createTerm($termFixture['path'], $termFixture['name']);
            $aTaxonomy->addTerm($aTerm);
        }

        $taxonomyManager->updateTaxonomy($aTaxonomy, true);

        $output->writeln('Product taxonomy has been setup with ' . count($termFixtures) . ' terms.' );

        return $aTaxonomy;
    }

    protected function setupStore($input, $output)
    {
        $storeManager = $this->getContainer()->get('vespolina.store_manager');

        $store = $storeManager->createStore('default_store', 'Vespolina ' . ucfirst($this->type) . ' Shop');
        $store->setSalesChannel('default_store_web');
        $storeManager->updateStore($store);

        $output->writeln('Setup a default store configuration' );
        return $store;
    }
}