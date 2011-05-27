<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\OrderBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentInterface;
use Vespolina\PricingBundle\Model\PriceableInterface;

interface OrderDocumentInterface extends DocumentInterface, PriceableInterface
{
    public function getCustomer();
}