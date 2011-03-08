<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Vespolina\PricingBundle\Model\PricingElementInterface;

class BasePricingElement implements PricingElementInterface
{
  
    protected $isDetermined;
    protected $name;
    protected $value;
    

    function __construct($options)
    {

        $this->name = $options['name'];
    }

    public function getIsDetermined()
    {
    
        return $this->isDetermined;
    }    
    
    public function getName()
    {

        return $this->name;

    }
    
    public function getValue()
    {

        return $this->value;
    }

    public function setIsDetermined($isDetermined){
    
        return $this->isDetermined = $isDetermined;
    
    }    
    
    public function setValue($value)
    {

        $this->value = $value;

    }

}
