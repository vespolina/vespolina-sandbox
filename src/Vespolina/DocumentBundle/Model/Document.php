<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentInterface;
use Vespolina\DocumentBundle\Model\DocumentPartnerFunctionInterface;
use Vespolina\PartnerBundle\Model\PartnerInterface;

class Document implements DocumentInterface
{

    protected $partners;
    
    public function __construct()
    {
        $this->partners = array();
    
    }
    
    
    public function addPartner(PartnerInterface $partner, DocumentPartnerFunctionInterface $partnerFunction)
    {
        $partnerFunctionName = $partnerFunction->getName();
        
        if (!array_key_exists($partnerFunctionName, $this->partners)) {
            
            $this->partners[$partnerFunctionName][] = array($partner);
        }
        
        $this->partners[$partnerFunctionName][] = $partner;
    }
    
    function getPartners(DocumentPartnerFunctionInterface $partnerFunction = null)
    {
        if ($partnerFunction) {

            return $this->partners[$partnerFunction->getName()];
            
        } else {
        
        
        }
    
    }
    
  
	
}
