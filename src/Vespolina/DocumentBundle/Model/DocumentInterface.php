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
use Vespolina\DocumentBundle\Model\DocumentItemInterface;
use Vespolina\DocumentBundle\Model\DocumentPartnerRoleInterface;
use Vespolina\PartnerBundle\Model\PartnerInterface;

interface DocumentInterface
{
    /**
     * Add item to the collection
     */
    function addItem(DocumentItemInterface $documentItem);

    /**
     * Add a partner to this document
     *
     * @abstract
     * @param \Vespolina\PartnerBundle\Model\PartnerInterface $partner
     * @param DocumentPartnerFunctionInterface $partnerFunction
     * @return void
     */
    function addPartner(PartnerInterface $partner, DocumentPartnerRoleInterface $partnerFunction);

    /**
     * Get the document configuration name
     *
     * @abstract
     * @return Name of the document configuration
     */
    function getDocumentConfigurationName();

    /**
     * Get the document identifier identified by the supplied name
     */
    function getDocumentIdentifier($name);

    /**
     * Get items belonging to this document
     */
    function getItems();

    /**
     * Retrieve all partners or all matching the supplied partner role
     *
     * @abstract
     * @param null|DocumentPartnerRoleInterface $partnerFunction
     * @return void
     */
    function getPartners(DocumentPartnerRoleInterface $partnerRole = null);
}