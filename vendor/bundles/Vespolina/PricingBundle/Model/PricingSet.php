<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\PricingBundle\Model;

class PricingSet implements PricingSetInterface
{
    protected $key;
    protected $pricingConfigurationName;
    protected $pricingDimensionParameters;
    protected $pricingElements;

    public function __construct()
    {
        $this->pricingDimensionParameters = array();
        $this->pricingElements = array();
    }

    public function getKey()
    {
        if ($this->key == '') {
            //Construct the unique pricing set key based on the supplied dimensions parameters
            foreach ($this->pricingDimensionParameters as $pricingDimensionParameter) {
                foreach ($pricingDimensionParameter as $parameter) {
                    if (is_object($parameter) && get_class($parameter) == 'DateTime') {
                        $this->key .= '_' . $parameter->getTimestamp();
                    } else {
                        $this->key .= '_' . $parameter;
                    }
                }
            }

            if ($this->key == '') {
                $this->key = 'default';
            }
        }
        return $this->key;
    }

    public function addPricingElement(PricingElementInterface $pricingElement)
    {
        $this->pricingElements[$pricingElement->getName()] = $pricingElement;
    }

    public function getPricingConfigurationName()
    {
        return $this->pricingConfigurationName;
    }

    public function getPricingElement($name)
    {
        if (array_key_exists($name, $this->pricingElements)) {
            return $this->pricingElements[$name];
        }
    }

    public function getPricingElements()
    {
        return $this->pricingElements;
    }

    public function setPricingDimensionParameters($name, $parameters)
    {
        $this->pricingDimensionParameters[$name] = $parameters;
    }
}