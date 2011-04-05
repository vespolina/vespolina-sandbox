<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\DocumentBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\DocumentBundle\Model\DocumentConfiguration;
use Vespolina\DocumentBundle\Model\DocumentConfigurationInterface;
use Vespolina\DocumentBundle\Model\DocumentInterface;
use Vespolina\DocumentBundle\Model\DocumentIdentifier\DbDocumentIdentifier;
use Vespolina\DocumentBundle\Service\DocumentServiceInterface;


class DocumentService extends ContainerAware implements DocumentServiceInterface
{

    protected $documentConfigurations;

    function __construct()
    {
        $this->documentConfigurations = array();
    }

    /**
     * @inheritdoc
     */
    public function create(DocumentConfigurationInterface $documentConfiguration)
    {
        
        $baseClass = $documentConfiguration->getBaseClass();
        
        $document = new $baseClass($documentConfiguration->getName());

        //Init document identifier instances
        foreach ($documentConfiguration->getDocumentIdentifierConfigurations() as $name => $documentIdentifierConfiguration)
        {
            $baseClass = $documentIdentifierConfiguration->getBaseClass();
            $documentIdentifier = new $baseClass();
            $documentIdentifier->setName($name);
            $document->setDocumentIdentifier($name, $documentIdentifier);
        }


        return $document;
    }

    public function createItem(DocumentInterface $document, DocumentConfigurationInterface $documentConfiguration = null)
    {
        if (!$documentConfiguration) {


            if (!$documentConfiguration = $this->getDocumentConfiguration($document->getDocumentConfigurationName())) {

                //Throw exception
            }
        }

        if ($itemBaseClass = $documentConfiguration->getItemBaseClass()) {

            $documentItem = new $itemBaseClass($document);

            $document->addItem($documentItem);

            return $documentItem;

        }

    }

    /**
     * @inheritdoc
     */
    public function generateDocumentIdentifier(DocumentInterface $document, $identifierName = 'id', $context)
    {
        $documentConfiguration = $this->documentConfigurations[$document->getDocumentConfigurationName()];
        $documentIdentifierConfiguration = $documentConfiguration->getDocumentIdentifierConfiguration($identifierName);

        //Todo handle generation part
    }

    /**
     * @inheritdoc
     */
    public function getDocumentConfiguration($name)
    {
        if (!array_key_exists($name, $this->documentConfigurations)) {

            $this->documentConfigurations[$name] = new DocumentConfiguration($name);

        }

        return $this->documentConfigurations[$name];

    }

    /**
     * @inheritdoc
     */
    public function save(DocumentInterface $document)
    {
    }
    


}
