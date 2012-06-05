<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            //new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),

            new Application\UserBundle\UserBundle(),
            new Application\DefaultBundle\DefaultBundle(),
            new Application\Vespolina\CartBundle\ApplicationVespolinaCartBundle(),
            new Application\Vespolina\OrderBundle\ApplicationVespolinaOrderBundle(),
            new Application\Vespolina\ProductBundle\ApplicationVespolinaProductBundle(),
            new Application\Vespolina\StoreBundle\ApplicationVespolinaStoreBundle(),

            new Vespolina\CartBundle\VespolinaCartBundle(),
            new Vespolina\PartnerBundle\VespolinaPartnerBundle(),
            new Vespolina\FulfillmentBundle\VespolinaFulfillmentBundle(),
            new Vespolina\MonetaryBundle\VespolinaMonetaryBundle(),
            new Vespolina\OrderBundle\VespolinaOrderBundle(),
            new Vespolina\ProductBundle\VespolinaProductBundle(),
            //new Vespolina\ProductSubscriptionBundle\VespolinaProductSubscriptionBundle(),
            new Vespolina\PricingBundle\VespolinaPricingBundle(),
            new Vespolina\StoreBundle\VespolinaStoreBundle(),
            new Vespolina\TaxationBundle\VespolinaTaxationBundle(),
            new Vespolina\TaxonomyBundle\VespolinaTaxonomyBundle(),
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
