<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PartnerBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\PartnerBundle\Model\Partner;
use Vespolina\PartnerBundle\Model\PartnerConfigurationInterface;
use Vespolina\PartnerBundle\Service\PartnerBundleServiceInterface;


class PartnerService extends ContainerAware implements PartnerServiceInterface
{

    function createInstance(PartnerConfigurationInterface $partnerConfiguration)
    {

        return new Partner($partnerConfiguration->getName());
    }
  
    public function getPricingConfiguration($name)
    {
  
        $pricingConfiguration = new PricingConfiguration($this);
  
        return $pricingConfiguration;
    }
}
