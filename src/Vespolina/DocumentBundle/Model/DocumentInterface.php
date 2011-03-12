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

interface DocumentInterface
{

    function addPartner(PartnerInterface $partner, DocumentPartnerFunctionInterface $partnerFunction);
      
    function getPartners(DocumentPartnerFunctionInterface $partnerFunction = null);

}
