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
use Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface;


class DocumentConfiguration implements DocumentConfigurationInterface
{
    protected $baseClass;
    protected $documentIdentificationConfigurations;
    protected $name;

    /**
     * Constructor
     */
    public function __construct($name)
    {
        $this->documentIdentificationConfigurations = array();
        $this->name = $name;
    }


    /**
     * Add a document identification configuration
     *
     */
    public function addDocumentIdentificationConfiguration($name, DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration)
    {
        $this->documentIdentificationConfigurations[$name] = $documentIdentificationConfiguration;
    }


    public function getDocumentIdentificationConfiguration($name)
    {


        return $this->documentIdentificationConfigurations[$name];

    }
    /**
     * @inheritdoc
     */
    public function getName(){
    
        return $this->name;
    }
    
    /**
     * @inheritdoc
     */
    public function getBaseClass(){
        
        return $this->baseClass;
    
    }

    /**
     * @inheritdoc
     */
    public function getDocumentIdentificationConfigurations()
    {
        return $this->documentIdentificationConfigurations;
    }

    /**
     * @inheritdoc
     */
    public function setBaseClass($baseClass){
    
        $this->baseClass = $baseClass;
        
    }
    
    /**
     * @inheritdoc
     */
    public function setName($name){
    
        $this->name = $name;
        
    }

}
