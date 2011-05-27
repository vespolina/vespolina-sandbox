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

interface PricingDimensionInterface
{
    /**
     * Return the name of this pricing dimension
     * @return
     */
    function getName();

    /**
     * Add dimension parameter
     *
     * @param  $name Dimension name
     * @param  $value Dimension value
     * @return void
     */
    function addParameter($name, $value);

    /**
     * Get all the parameter names for this dimension
     *
     * @return array
     */
    function getParameterNames();

    /**
     * Return all parameters names and associated values
     *
     * @return array
     */
    function getParameters();

    /**
     * Get parameter value
     *
     * @param  $name
     * @return array
     */
    function getParameter($name);

    /**
     * Set default values
     *
     * @abstract
     * @param PricingSetInterface $pricingSet
     * @return void
     */
    function setDefaultParametersForPricingSet(PricingSetInterface $pricingSet);
}
