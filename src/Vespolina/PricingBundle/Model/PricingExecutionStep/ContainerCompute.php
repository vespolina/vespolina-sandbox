<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model\PricingExecutionStep;

use Vespolina\PricingBundle\Model\PricingContextContainerInterface;
use Vespolina\PricingBundle\Model\BasePricingExecutionStep;

class ContainerCompute extends BasePricingExecutionStep{

    public function execute(){
  
        $total = 0;

        $expression = $this->getOption('source');
        $variables = str_word_count($expression, 1, '_');

        foreach($variables as $variable){

            $value = $this->pricingContextContainer->get($variable);
            if (!$value) {
            
                $value = 0;
            }
            $expression = str_replace($variable, $value, $expression);
            
        }
        
        $expression = '$total = ' . $expression . ';';
        eval($expression);

        $this->pricingContextContainer->set(
                $this->getOption('target'),
                $total);
}
}
