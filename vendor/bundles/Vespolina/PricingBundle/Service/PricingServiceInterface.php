<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Service;

use Vespolina\PricingBundle\Model\PriceableInterface;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;
use Vespolina\PricingBundle\Model\PricingConfigurationInterface;
use Vespolina\PricingBundle\Model\PricingSetInterface;


interface PricingServiceInterface
{


    /**
     * Create a pricing context container and set pricing element values to the ones in
     * the pricing context container values
     *
     * @abstract
     * @param PricingSetInterface $pricingSet
     * @return void
     */
    function createPricingContextContainerFromPricingSet(PricingSetInterface $pricingSet);


     /**
     * Build / calculate the necessary pricing values based on the pricing set,
     *  a given runtime pricing context container and possible some options.
     *
     * @param PricingSetInterface $pricingSet
     * @param PricingContextContainerInterface $container
     * @param array $options Possible
     *    Possible options:
     *      - execution_event ( all | context_independent | context_dependent )
      * @return void
     */
    function buildPricingSet(PricingSetInterface $pricingSet,
                             PricingContextContainerInterface $container,
                             $options = array());


    /**
     * Create a pricing set for this pricing configuration
     *
     * @param pricingConfiguration
     * @return void
     */
    function createPricingSet(PricingConfigurationInterface $pricingConfiguration);

    /**
     * Create a new pricing context container
     *
     * @return \Vespolina\PricingBundle\Model\PricingContextContainerInterface
     */
    function createPricingContextContainer(PricingConfigurationInterface $pricingConfiguration);

    /**
     * Get a pricing configuration
     *
     * @param  $name    Pricing configuration name
     * @return \Vespolina\PricingBundle\Model\PricingConfiguration
     */
    function getPricingConfiguration($name);

}
