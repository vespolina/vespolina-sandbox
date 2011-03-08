<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\OrderBundle\Model;

use Vespolina\PricingBundle\Model\OrderDocumentItemInterface;

class OrderDocumentItem implements OrderDocumentItemInterface
{
	protected $pricingSet = null;
	
    public function getId(){}
	
	public function getPricingSet(){
		
      return $this->pricingSet;
	}
  
  public function setPricingSet(PricingSetInterface $pricingSet){
  
    $this->pricingSet = $pricingSet;
  }
   
	
}
