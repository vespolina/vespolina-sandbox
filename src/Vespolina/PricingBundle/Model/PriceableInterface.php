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

interface PriceableInterface
{

    /**
     * Attach the supplied pricing set to an priceable document
     *
     * @abstract
     * @param PricingSetInterface $pricingSet
     * @return void
     */
    public function addPricingSet(PricingSetInterface $pricingSet);


    /**
     * Retrieve all pricing sets
     *
     * @abstract
     * @return void
     */
    public function getPricingSets();
   
   
}
