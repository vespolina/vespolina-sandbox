<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Service;

use Vespolina\PricingBundle\Model\PriceableEntityInterface;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;

interface PricingServiceInterface
{
   function createPriceContextContainer();
   function determinePrices(PriceableEntityInterface $entity, PricingContextContainerInterface $priceContextContainer);
	
}
