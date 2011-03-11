<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Vespolina\PricingBundle\Model\PricingContextContainerInterface;

interface PricingElementInterface
{
    /**
     * Get name of the pricing element
     *
     * @abstract
     * @return void
     */
    function getName();

    /**
     * Get name of the pricing element
     *
     * @abstract
     * @return void
     */
    function getValue();

    /**
     * Get value of the pricing element
     *
     * @abstract
     * @param  $value
     * @return void
     */
    function setValue($value);

    /**
     * Toggle whether or not the pricing element has been determined
     *
     * @abstract
     * @param  $isDetermined
     * @return void
     */
    function setIsDetermined($isDetermined);
   
}
