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

class BasePricingDimension implements PricingDimensionInterface
{

    protected $name;
    protected $parameters;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->parameters = array();
    }

    public function getName()
    {

        return $this->name;

    }
    
  public function addParameter($name, $value)
  {
    
    $this->parameters[$name] = $value;
    
  }
  
  public function getParameterNames()
  {
    
    return array_keys($this->parameters);
  }
  
  
  public function getParameter($name)
  {
    if (array_keys_exist($name)) {
        
        return $this->parameters[$name];
    }
  }
  
  public function getParameters()
  {
    
    return $this->parameters;
  }
  
  
  public function setDefaultParametersForPricingSet(PricingSetInterface $pricingSet)
  {
  
  }

  
}