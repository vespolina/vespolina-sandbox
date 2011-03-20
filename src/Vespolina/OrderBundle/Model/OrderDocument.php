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
use Vespolina\PartnerBundle\Model\PartnerFunction;


class OrderDocument extends Document implements OrderDocumentInterface
{
	protected $documentIdentifcations = null;
    protected $pricingSet = null;
    
    public function OrderDocument()
    {

        $this->documentIdentifications = array();

    }
    
    public function getCustomer()
    {
    
        if ($partners = $this->getPartners(new PartnerFunction('customer'))) {
        
            return $partners[0];
        }
        
    }
    
    public function getDocumentId()
    {

    }
	
	public function getPricingSet(){
		
      return $this->pricingSet;
	}
  
  public function setPricingSet(PricingSetInterface $pricingSet){
  
    $this->pricingSet = $pricingSet;
  }
   
	
}
