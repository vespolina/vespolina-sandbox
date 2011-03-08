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
  
    function addPricingDimension(PricingDimensionInterface $pricingDimensionConfiguration);
    
    function addPricingElement(PricingElementInterface $pricingElement, $options = array());
    
    function addPricingExecutionStep(PricingExecutionStepInterface $executionStep, $options = array());

    function getPricingDimensions();
    
    function getPricingExecutionSteps($executionPhase);

    function getPricingElements();

 }
