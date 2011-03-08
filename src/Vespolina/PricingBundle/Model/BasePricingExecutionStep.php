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

abstract class BasePricingExecutionStep implements PricingExecutionStepInterface
{
  
    protected $options;
    protected $pricingContextContainer;

    function __construct($options = array())
    {
        $this->options = $options;
    }

    function init(PricingContextContainerInterface $pricingContextContainer)
    {

        $this->pricingContextContainer = $pricingContextContainer;

    }

    protected function getOption($name, $default = ''){

        if (array_key_exists($name, $this->options)) {
          
          return $this->options[$name];
        
        }else{
          
          return $default;
        }
    }

    function execute()
    {

    }

    function getHandlerClass()
    {
    }

}
