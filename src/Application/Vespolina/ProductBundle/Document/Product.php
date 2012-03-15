<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Application\Vespolina\ProductBundle\Document;

use Vespolina\ProductBundle\Document\BaseProduct as BaseProduct;
use Vespolina\CartBundle\Model\CartableItemInterface;

class Product extends BaseProduct implements CartableItemInterface
{
    protected $id;
    protected $pricing;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCartableName()
    {
        return $this->cartableName ? $this->cartableName : $this->getName();
    }

    /**
     * Get $price
     *
     * @return string $price
     */
    public function getPricing()
    {
      return $this->pricing;
    }

    /**
     * Set $price
     */
    public function setPricing($pricing)
    {
      $this->pricing = $pricing;
    }

    public function getType()
    {
        return 'default';
    }
}