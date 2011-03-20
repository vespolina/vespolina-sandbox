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
    /**
     * Add a partner to this document
     *
     * @abstract
     * @param \Vespolina\PartnerBundle\Model\PartnerInterface $partner
     * @param DocumentPartnerFunctionInterface $partnerFunction
     * @return void
     */
    function addPartner(PartnerInterface $partner, DocumentPartnerFunctionInterface $partnerFunction);


    /**
     * Get the document configuration name
     *
     * @abstract
     * @return Name of the document configuration
     */
    function getDocumentConfigurationName();

    /**
     * Get the document identification identified by the supplied name
     */
    function getDocumentIdentification($name);

    /**
     * Retrieve all partners or filtered for a given partner role
     *
     * @abstract
     * @param null|DocumentPartnerFunctionInterface $partnerFunction
     * @return void
     */
    function getPartners(DocumentPartnerFunctionInterface $partnerFunction = null);

}
