<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vespolina\PricingBundle\Model\PriceableInterface;
use Vespolina\PricingBundle\Model\PricingConfiguration;
use Vespolina\PricingBundle\Model\PricingConfigurationInterface;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;
use Vespolina\PricingBundle\Model\PricingContextContainer;
use Vespolina\PricingBundle\Model\PricingSetInterface;

use Vespolina\PricingBundle\Service\PricingServiceInterface;


class PricingService extends ContainerAware implements PricingServiceInterface
{

    protected $pricingConfigurations = null;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->pricingConfigurations = array();
    }

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
    public function buildPricingSet(PricingSetInterface $pricingSet,
                                    PricingContextContainerInterface $container,
                                    $options = array())
    {

        $pricingConfigurationName = $pricingSet->getPricingConfigurationName();

        $pricingConfiguration = $this->getPricingConfiguration($pricingConfigurationName);

        if ($pricingConfiguration) {

            $pricingConfiguration->buildPricingSet($pricingSet, $container, $options);
        }
    }

    /**
     * Create a pricing set for this pricing configuration
     *
     * @param pricingConfiguration
     * @return void
     */
    public function createPricingSet(PricingConfigurationInterface $pricingConfiguration)
    {

        if ($pricingConfiguration){

            return $pricingConfiguration->createPricingSet();
        }
    }


    /**
     * Create a new pricing set container from an existing pricing set,
     * copying necessary pricing element values to the pricing set container
     *
     * @param PricingSetInterface $pricingSet
     * @return PricingContextContainer
     */
    public function createPricingContextContainerFromPricingSet(PricingSetInterface $pricingSet)
    {

        $pricingConfigurationName = $pricingSet->getPricingConfigurationName();

         $pricingConfiguration = $this->getPricingConfiguration($pricingConfigurationName);

         if ($pricingConfiguration) {

             return $pricingConfiguration->createPricingContextContainerFromPricingSet($pricingSet);
         }
    }

    /**
     * Create a new pricing context container
     *
     * @return \Vespolina\PricingBundle\Model\PricingConfigurationInterface
     */
    public function createPricingContextContainer(PricingConfigurationInterface $pricingConfiguration)
    {

        return new PricingContextContainer();
    }
  
    /**
     * Get a pricing configuration
     *
     * @param  $name    Pricing configuration name
     * @return \Vespolina\PricingBundle\Model\PricingConfiguration
     */
    public function getPricingConfiguration($name)
    {
        if (!array_key_exists($name, $this->pricingConfigurations)) {

            $this->pricingConfigurations[$name] = new PricingConfiguration($this);

        }

        return $this->pricingConfigurations[$name];

    }
}
