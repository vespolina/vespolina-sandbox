<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model\PricingDimension;

use Vespolina\PricingBundle\Model\PricingDimension;

class PeriodPricingDimension extends PricingDimension
{
    protected $from;
    protected $name;
    protected $parameters;
    protected $to;
    
    public function __construct($name)
    {
        parent::__construct($name);
    }
    
    public function getDeterminationKeyForParameters($parameters)
    {
        return 'default';
    }
}