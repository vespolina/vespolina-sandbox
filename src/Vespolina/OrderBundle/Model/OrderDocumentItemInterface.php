<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\PricingBundle\Model\PriceableInterface;
use Vespolina\ProductBundle\Model\ProductInterface;
use Vespolina\DocumentBundle\Model\DocumentItemInterface;

interface OrderDocumentItemInterface extends DocumentItemInterface
{
    /**
     * Get the product associated to this order item
     *
     * @abstract
     * @return Vespolina\ProductBundle\ProductInterface
     */
    function getProduct();

    /**
     * Get quantity initially ordered
     *
     * @abstract
     * @return int
     */
    function getOrderedQuantity();

    /**
     * Set product which needs to be associated to this order item
     *
     * @abstract
     * @param \Vespolina\ProductBundle\Model\ProductInterface $product
     * @return void
     */
    function setProduct(ProductInterface $product);

    /**
     * Set quantity ordered
     * @abstract
     * @param  $quantity
     * @return void
     */
    function setOrderedQuantity($quantity);
}