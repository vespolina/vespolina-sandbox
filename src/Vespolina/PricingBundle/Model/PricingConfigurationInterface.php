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

interface PricingConfigurationInterface
{
  
    function createPricingSet();

    function createPricingContextContainerFromPricingSet(PricingSetInterface $pricingSet);

    function buildPricingSet(PricingSetInterface $pricingSet, 
                           PricingContextContainerInterface $container, 
                           $options = array());
	
  
 }
