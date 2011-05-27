<?php

namespace Vespolina\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class VespolinaCoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {

    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/vespolinacore';
    }
}