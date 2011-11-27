<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-fixtures/lib',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine\\ODM\\MongoDB'    => __DIR__.'/../vendor/doctrine-mongodb-odm/lib',
    'Doctrine\\MongoDB'         => __DIR__.'/../vendor/doctrine-mongodb/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',
    'Sonata'                         => __DIR__.'/../vendor/bundles',
    'FOS' => __DIR__.'/../vendor/bundles',
    'Mopa'             => __DIR__.'/../vendor/bundles',
    'Vespolina'                         => __DIR__.'/../vendor/bundles',
                                
    'Behat\Mink' => __DIR__.'/../vendor/behat/mink/src',
    'Goutte'           => __DIR__.'/../vendor/goutte/src',
    'Zend'             => __DIR__.'/../vendor/zend/library',
    'Behat\MinkBundle' => __DIR__.'/../vendor/bundles',
    'Behat\SahiClient' => __DIR__.'/../vendor/behat/sahi/src',
    'Behat\BehatBundle' => __DIR__.'/../vendor/bundles',
    'Behat\Behat'       => __DIR__.'/../vendor/behat/Behat/src',
    'Behat\Gherkin'     => __DIR__.'/../vendor/behat/Gherkin/src',
    'Buzz'             => __DIR__.'/../vendor/buzz/lib',
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(
    __DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
);
AnnotationRegistry::registerFile(
    __DIR__.'/../vendor/doctrine-mongodb-odm/lib/Doctrine/ODM/MongoDB/Mapping/Annotations/DoctrineAnnotations.php'
);

// Swiftmailer needs a special autoloader to allow
// the lazy loading of the init file (which is expensive)
require_once __DIR__.'/../vendor/swiftmailer/lib/classes/Swift.php';
Swift::registerAutoload(__DIR__.'/../vendor/swiftmailer/lib/swift_init.php');

