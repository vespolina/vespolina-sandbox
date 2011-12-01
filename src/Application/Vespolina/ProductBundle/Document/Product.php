<?php
/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Vespolina\ProductBundle\Document;

use Vespolina\ProductBundle\Document\BaseProduct as BaseProduct;

/**
 * This file has been generated by the EasyExtends bundle ( http://sonata-project.org/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/docs/mongodb_odm/1.0/en/reference/working-with-objects.html
 *
 * @author <yourname> <youremail>
 */
class Product extends BaseProduct
{

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * @var string $id
     */
    protected $price;

    /**
     * Get $price
     *
     * @return string $price
     */
    public function getPrice()
    {
      return $this->price;
    }

    /**
     * Set $price
     */
    public function setPrice($price)
    {
      $this->price = $price;
    }
}