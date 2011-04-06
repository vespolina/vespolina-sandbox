<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\ProductBundle\Model;

use Vespolina\PricingBundle\Model\PricingElementContainer;
use Vespolina\PricingBundle\Model\PricingSetInterface;

class Product implements ProductInterface
{
    protected $pricingSet = array();

    public function getId()
    {
    }

    public function getPricingSets()
    {
        return $this->pricingSets;
    }

    public function setPricingSets($pricingSets)
    {
        return $this->pricingSets = $pricingSets;
    }

    public function addPricingSet(PricingSetInterface $pricingSet)
    {
        $this->pricingSets[$pricingSet->getKey()] = $pricingSet;
    }
}
