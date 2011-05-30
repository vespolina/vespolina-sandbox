<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\ClassLoader\DebugUniversalClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new FOS\UserBundle\FOSUserBundle(),
            new Application\UserBundle\UserBundle(),
            new Application\DefaultBundle\DefaultBundle(),
            
            new Vespolina\CoreBundle\VespolinaCoreBundle(),
            new Vespolina\DocumentBundle\VespolinaDocumentBundle(),
            new Vespolina\MonetaryBundle\VespolinaMonetaryBundle(),
            new Vespolina\OrderBundle\VespolinaOrderBundle(),
            new Vespolina\PartnerBundle\VespolinaPartnerBundle(),
            new Vespolina\PricingBundle\VespolinaPricingBundle(),
            new Vespolina\WorkflowBundle\VespolinaWorkflowBundle(),

            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\DoctrineMongoDBBundle\DoctrineMongoDBBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function init()
    {
        if ($this->debug) {
            ini_set('display_errors', 1);
            error_reporting(-1);

            DebugUniversalClassLoader::enable();
            ErrorHandler::register();
            ExceptionHandler::register();
        } else {
            ini_set('display_errors', 0);
        }
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // use YAML for configuration
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
