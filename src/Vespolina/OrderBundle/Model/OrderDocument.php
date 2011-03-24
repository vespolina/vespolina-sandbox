<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\DocumentBundle\Model\Document;
use Vespolina\OrderBundle\Model\OrderDocumentInterface;
use Vespolina\PricingBundle\Model\PricingElementContainer;
use Vespolina\PricingBundle\Model\PricingSetInterface;
use Vespolina\PartnerBundle\Model\PartnerRole;


class OrderDocument extends Document implements OrderDocumentInterface
{
    protected $customer = null;
    protected $documentIdentifications = null;
    protected $pricingSet = null;
    
    public function __construct($documentConfigurationName)
    {
        parent::__construct($documentConfigurationName);

        $this->documentIdentifications = array();

    }

    /**
     * Get the (primary) customer for this order
     */
    public function getCustomer()
    {
        if (!$this->customer) {

            if ($partners = $this->getPartners(new PartnerRole('customer'))) {

               $this->customer = $partners[0];
            }
        }

        return $this->customer;
    }

    /**
     * @inheritdoc
     */
    public function getPricingSet(){

      return $this->pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function setPricingSet(PricingSetInterface $pricingSet){
  
        $this->pricingSet = $pricingSet;
    }

    /**
     * @inheritdoc
     */
    public function getPricingSets()
    {
        //A typical order has only one pricing set

        return array($this->pricingSet);
    }


    /**
     * @inheritdoc
     */
    public function addPricingSet(PricingSetInterface $pricingSet)
    {
        //A typical order has only one pricing set

        $this->setPricingSet($pricingSet);
    }
}
