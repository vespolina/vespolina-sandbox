<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model;

use Vespolina\CoreBundle\Component\Identifier\IdentifierInterface;
use Vespolina\DocumentBundle\Model\DocumentInterface;
use Vespolina\DocumentBundle\Model\DocumentItemInterface;
use Vespolina\DocumentBundle\Model\DocumentPartnerRoleInterface;
use Vespolina\PartnerBundle\Model\PartnerInterface;

class Document implements DocumentInterface
{
    protected $documentConfigurationName;
    protected $identifiers;
    protected $items;
    protected $partnersByRole;

    /**
     * Constructor
     */
    public function __construct($documentConfigurationName)
    {
        $this->documentConfigurationName = $documentConfigurationName;
        $this->identifiers = array();
        $this->items = array();
        $this->partnersByRole = array();
    }

    /**
     * @inheritdoc
     */
    public function addItem(DocumentItemInterface $documentItem)
    {
        $this->items[] = $documentItem;
    }

    /**
     * @inheritdoc
     */
    public function addPartner(PartnerInterface $partner, DocumentPartnerRoleInterface $partnerFunction)
    {
        $partnerRoleName = $partnerFunction->getName();

        if (!array_key_exists($partnerRoleName, $this->partnersByRole)) {
            $this->partnersByRole[$partnerRoleName] = array();
        }

        $this->partnersByRole[$partnerRoleName][] = $partner;
    }

    /**
     * @inheritdoc
     */
    public function getDocumentIdentifier($name)
    {
        return $this->identifiers[$name];
    }


    /**
     * @inheritdoc
     */
    public function getDocumentConfigurationName()
    {
        return $this->documentConfigurationName;
    }

    /**
     * @inheritdoc
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @inheritdoc
     */
    public function getPartners(DocumentPartnerRoleInterface $partnerRole = null)
    {
        if ($partnerRole) {
            return $this->partnersByRole[$partnerRole->getName()];
        } else {
            $partners = array();

            foreach ($this->partnersByRole as $partnersInRole) {
                foreach ($partnersInRole as $partnerInRole) {
                    $partners[] = $partnerInRole;
                }
            }
            return $partners;
        }
    }

    /**
     * @inheritdoc
     */
    public function setDocumentIdentifier($name, IdentifierInterface $documentIdentifier)
    {
        $this->identifiers[$name] = $documentIdentifier;
    }
}