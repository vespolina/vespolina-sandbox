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
use Vespolina\PricingBundle\Model\PriceableEntityInterface;
use Vespolina\PricingBundle\Model\PricingConfiguration;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;
use Vespolina\PricingBundle\Model\PricingContextContainer;

use Vespolina\PricingBundle\Service\PricingServiceInterface;


class PricingService extends ContainerAware implements PricingServiceInterface
{

    function createPriceContextContainer()
    {

        return new PricingContextContainer();
    }
  
    public function determinePrices(PriceableEntityInterface $entity, PricingContextContainerInterface $priceContextContainer)
    {
    }
  
    public function getPricingConfiguration($name)
    {
  
        $pricingConfiguration = new PricingConfiguration($this);
  
        return $pricingConfiguration;
    }
}
