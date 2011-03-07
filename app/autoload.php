<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Assetic'                   => __DIR__.'/../vendor/assetic/src',
    'Doctrine\\Common'          => __DIR__.'/../vendor/doctrine/common/lib',
    'Doctrine\\MongoDB'         => __DIR__.'/../vendor/doctrine/mongodb/lib',
    'Doctrine\\ODM\\MongoDB'    => __DIR__.'/../vendor/doctrine/mongodb-odm/lib',
    'FOS'                       => __DIR__.'/../src',
    'Application'               => __DIR__.'/../src',
    'Vespolina'                 => __DIR__.'/../src',
    'Symfony'                   => __DIR__.'/../vendor/symfony/src',
    'vendor'                    => __DIR__.'/../src',
    'Zend\\Log'                 => __DIR__.'/../vendor/zend-log',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_'   => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'              => __DIR__.'/../vendor/twig/lib',
    'Swift_'             => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
