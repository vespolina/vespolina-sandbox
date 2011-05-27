<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\PricingBundle\Model\PricingExecutionStep;

use Vespolina\PricingBundle\Model\PricingExecutionStep;
use Vespolina\PricingBundle\Model\PricingContextContainerInterface;

class SetContainerValue extends PricingExecutionStep
{
    public function SetContainerValue($options = array())
    {
        parent::BasePricingExecutionStep($options);
    }

    public function execute()
    {
        $source = $this->getOption('source');

        //Is the supplied value numeric?
        if (is_numeric($source)) {
            $value = $source;
        } else {
            //It is not numeric -> it must be the name of a container value
            $value = $this->pricingContextContainer->get($source);
        }

        $this->pricingContextContainer->set(
            $this->getOption('target'),
            $value);
    }
}
