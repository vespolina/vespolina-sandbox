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
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            //new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),

            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Mopa\BootstrapBundle\MopaBootstrapBundle(),

            new Application\Vespolina\ProductBundle\ApplicationVespolinaProductBundle(),

            new Application\UserBundle\UserBundle(),
            new Application\DefaultBundle\DefaultBundle(),

            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),

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
            new Vespolina\CheckoutBundle\VespolinaCheckoutBundle(),
            new Vespolina\MerchandiseBundle\VespolinaMerchandiseBundle(),
            new Vespolina\EcommerceFlowsBundle\VespolinaEcommerceFlowsBundle(),
            new Vespolina\WorkflowBundle\VespolinaWorkflowBundle(),
            new Vespolina\InventoryBundle\VespolinaInventoryBundle(),
            );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new JMS\DebuggingBundle\JMSDebuggingBundle($this);
            $bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Behat\MinkBundle\MinkBundle();
            $bundles[] = new Behat\BehatBundle\BehatBundle();
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
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            return '\JMS\DebuggingBundle\DependencyInjection\TraceableContainer';
        }

        return parent::getContainerBaseClass();
    }
}
