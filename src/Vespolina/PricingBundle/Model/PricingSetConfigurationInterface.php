<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Vespolina\PricingBundle\Model\PricingSetInterface;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;
use Vespolina\PricingBundle\Model\PricingDimensionInterface;

interface PricingSetConfigurationInterface
{

    /**
     * Add a pricing dimension to this pricing set configuration
     *
     * @abstract
     * @param PricingDimensionInterface $pricingDimensionConfiguration
     * @return void
     */
    function addPricingDimension(PricingDimensionInterface $pricingDimensionConfiguration);

    /**
     * Add a pricing element to this pricing set configuration
     *
     * @abstract
     * @param PricingElementInterface $pricingElement
     * @param array $options
     * @return void
     */
    function addPricingElement(PricingElementInterface $pricingElement, $options = array());

    /**
     * Add a pricing execution step to this pricing set configuration
     *
     * @abstract
     * @param PricingExecutionStepInterface $executionStep
     * @param array $options
     * @return void
     */
    function addPricingExecutionStep(PricingExecutionStepInterface $executionStep, $options = array());

    /**
     * Retrieve all associated pricing dimensions
     *
     * @abstract
     * @return void
     */
    function getPricingDimensions();

    /**
     * Get all pricing execution steps, optionally filter by execution event
     *
     * @abstract
     * @param  $executionEvent  all | context_dependent | context_independent
     * @return void
     */

    function getPricingExecutionSteps($executionEvent = '');

    /**
     * Get pricing elements
     *
     * @abstract
     * @param string $executionStep
     * @return void
     */
    function getPricingElements();


 }
