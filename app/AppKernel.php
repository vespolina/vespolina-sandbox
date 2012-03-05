<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
 
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            //new Knp\Bundle\MenuBundle\KnpMenuBundle(),

            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Mopa\BootstrapBundle\MopaBootstrapBundle(),

            //new Application\Vespolina\ProductBundle\ApplicationVespolinaProductBundle(),
            //new Application\Vespolina\StoreBundle\ApplicationVespolinaStoreBundle(),
            
            new Application\UserBundle\UserBundle(),
            new Application\DefaultBundle\DefaultBundle(),
            new Vespolina\CartBundle\VespolinaCartBundle(),
            new Vespolina\CustomerBundle\VespolinaCustomerBundle(),
            new Vespolina\ProductBundle\VespolinaProductBundle(),
            new Vespolina\PricingBundle\VespolinaPricingBundle(),
            new Vespolina\TaxationBundle\VespolinaTaxationBundle(),
            new Vespolina\TaxonomyBundle\VespolinaTaxonomyBundle(),
            new Vespolina\OrderBundle\VespolinaOrderBundle(),
            new Vespolina\FulfillmentBundle\VespolinaFulfillmentBundle(),
            new Vespolina\StoreBundle\VespolinaStoreBundle(),
            new Vespolina\MonetaryBundle\VespolinaMonetaryBundle(),
            );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    protected function getContainerBaseClass()
    {
        return parent::getContainerBaseClass();
    }
}
