<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Vespolina\PricingBundle\Model\PricingDimensionInterface;
use Vespolina\PricingBundle\Model\PricingSetInterface;

class PricingDimension implements PricingDimensionInterface
{
    protected $name;
    protected $parameters;

    /**
     * @param  $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->parameters = array();
    }

    /**
     * Return the name of this pricing dimension
     * @return
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add dimension parameter
     *
     * @param  $name Dimension name
     * @param  $value Dimension value
     * @return void
     */
    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Get all the parameter names for this dimension
     *
     * @return array
     */
    public function getParameterNames()
    {
        return array_keys($this->parameters);
    }

    /**
     * Get parameter value
     *
     * @param  $name
     * @return array
     */
    public function getParameter($name)
    {
        if (array_keys_exist($name)) {
            return $this->parameters[$name];
        }
    }

    /**
     * Return all parameters names and associated values
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    public function setDefaultParametersForPricingSet(PricingSetInterface $pricingSet)
    {

    }
}