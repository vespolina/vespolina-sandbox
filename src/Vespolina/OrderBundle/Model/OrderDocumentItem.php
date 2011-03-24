<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentItem;
use Vespolina\OrderBundle\Model\OrderDocumentItemInterface;
use Vespolina\ProductBundle\Model\ProductInterface;

class OrderDocumentItem  extends DocumentItem implements OrderDocumentItemInterface
{

    protected $orderedQuantity;
    protected $product;

    /**
     * @inheritdoc
     */
    function getOrderedQuantity()
    {

        return $this->orderedQuantity;
    }

    /**
     * @inheritdoc
     */
    function getProduct()
    {

        return $this->product;
    }

    /**
     * @inheritdoc
     */
    function setOrderedQuantity($orderedQuantity)
    {

        $this->orderedQuantity = $orderedQuantity;
    }

    /**
     * @inheritdoc
     */
    function setProduct(ProductInterface $product)
    {

        $this->product = $product;
    }


}
