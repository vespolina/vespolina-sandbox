<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentConfigurationInterface;
use Vespolina\DocumentBundle\Model\DocumentIdentifierConfigurationInterface;


class DocumentConfiguration implements DocumentConfigurationInterface
{
    protected $baseClass;
    protected $documentIdentifierConfigurations;
    protected $itemBaseClass;
    protected $name;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->documentIdentifierConfigurations = array();
        $this->name = $name;
    }


    /**
     * Add a document identifier configuration
     *
     */
    public function addDocumentIdentifierConfiguration($name, DocumentIdentifierConfigurationInterface $documentIdentifierConfiguration)
    {
        $this->documentIdentifierConfigurations[$name] = $documentIdentifierConfiguration;
    }

    /**
     * @inheritdoc
     */
    public function getBaseClass()
    {

        return $this->baseClass;
    }

    /**
     * @inheritdoc
     */
    public function getDocumentIdentifierConfiguration($name)
    {

        return $this->documentIdentifierConfigurations[$name];
    }



    /**
     * @inheritdoc
     */
    public function getName()
    {
    
        return $this->name;
    }
    
    /**
     * @inheritdoc
     */
    public function getItemBaseClass()
    {
        
        return $this->itemBaseClass;
    }

    /**
     * @inheritdoc
     */
    public function getDocumentIdentifierConfigurations()
    {
        return $this->documentIdentifierConfigurations;
    }

    /**
     * @inheritdoc
     */
    public function setBaseClass($baseClass)
    {
    
        $this->baseClass = $baseClass;
    }

    /**
     * @inheritdoc
     */
    public function setItemBaseClass($itemBaseClass){

        $this->itemBaseClass = $itemBaseClass;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
    
        $this->name = $name;
    }

}
