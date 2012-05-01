<?php
/**
 * (c) 2012 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Application\Vespolina\ProductBundle\Document;
use Doctrine\Common\Collections\ArrayCollection;
use Vespolina\ProductBundle\Document\BaseProduct as BaseProduct;
use Vespolina\CartBundle\Model\CartableItemInterface;
use Vespolina\TaxonomyBundle\Model\TermInterface;

class Product extends BaseProduct implements CartableItemInterface
{
    protected $cartableName;
    protected $id;
    protected $pricing;
    protected $terms;

    public function __construct($identifierSetClass)
    {
        parent::__construct($identifierSetClass);
        $this->terms = array();
    }
    public function addTerm(TermInterface $term)
    {

        $this->terms['slug'] = $term->getName();    //TODO
    }

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

    public function getTerms()
    {
        return $this->terms;
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