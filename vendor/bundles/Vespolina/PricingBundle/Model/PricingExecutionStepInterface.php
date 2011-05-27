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

interface PricingExecutionStepInterface
{
    /**
     * Initialize this pricing execution step (eg. init cache )
     *
     * @abstract
     * @param PricingContextContainerInterface $pricingContextContainer
     * @return void
     */
    function init(PricingContextContainerInterface $pricingContextContainer);

    /**
     * Execute this step
     *
     * @abstract
     * @return void
     */
    function execute();
}
