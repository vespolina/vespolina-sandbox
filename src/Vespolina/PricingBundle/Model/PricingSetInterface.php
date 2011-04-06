<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Vespolina\PricingBundle\Model\PricingElementInterface;

interface PricingSetInterface
{
    /**
     * Add pricing element to this pricing set
     *
     * @abstract
     * @param PricingElementInterface $pricingElement
     * @return void
     */
    function addPricingElement(PricingElementInterface $pricingElement);

    /**
     * Retrieve the pricing configuration name
     *
     * @abstract
     * @return void
     */
    function getPricingConfigurationName();

    /**
     * Get a specific pricing element with a given name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function getPricingElement($name);

    /**
     * Set the pricing dimension parameters for this pricing set
     *
     * @abstract
     * @param  $name
     * @param  $parameters
     * @return void
     */
    function setPricingDimensionParameters($name, $parameters);
}
