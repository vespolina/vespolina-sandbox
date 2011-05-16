<?php
use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Assetic'                   => __DIR__.'/../vendor/assetic/src',
    'Doctrine\\Common'          => __DIR__.'/../vendor/doctrine/common/lib',
    'Doctrine\\MongoDB'         => __DIR__.'/../vendor/doctrine/mongodb/lib',
    'Doctrine\\ODM\\MongoDB'    => __DIR__.'/../vendor/doctrine/mongodb-odm/lib',
    'Doctrine\\DBAL'            => __DIR__.'/../vendor/doctrine/dbal/lib',
    'Doctrine'                  => __DIR__.'/../vendor/doctrine/orm/lib',
    'Doctrine\\Common\\DataFixtures'    => __DIR__.'/../vendor/doctrine/data-fixtures/lib',
    'FOS'                       => __DIR__.'/../vendor/bundles/FOS',
    'Application'               => __DIR__.'/../src',
    'Vespolina'                 => __DIR__.'/../vendor/bundles/Vespolina',
    'Monolog'                   => __DIR__.'/../vendor/monolog/src',
    'Symfony'                   => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'vendor'                    => __DIR__.'/../src',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
    'Swift_'           => __DIR__.'/../vendor/swiftmailer/lib/classes',
));
$loader->register();
$loader->registerPrefixFallback(array(
    __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs',
));

require_once 'ezc/Base/base.php';
spl_autoload_register( array( 'ezcBase', 'autoload' ) );
