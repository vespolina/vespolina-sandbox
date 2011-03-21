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
use Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification;
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
    public function createInstance(DocumentConfigurationInterface $documentConfiguration)
    {
        
        $baseClass = $documentConfiguration->getBaseClass();
        
        $document = new $baseClass($documentConfiguration->getName());

        //Init document identification instances
        foreach ($documentConfiguration->getDocumentIdentificationConfigurations() as $name => $documentIdentificationConfiguration)
        {
            $baseClass = $documentIdentificationConfiguration->getBaseClass();
            $documentIdentification = new $baseClass();
            $document->setDocumentIdentification($name, $documentIdentification);
        }


        return $document;
    }

    /**
     * @inheritdoc
     */
    public function generateDocumentIdentification(DocumentInterface $document, $identificationName = 'id', $context)
    {
        $documentConfiguration = $this->documentConfigurations[$document->getDocumentConfigurationName()];
        $documentIdentificationConfiguration = $documentConfiguration->getDocumentIdentificationConfiguration($identificationName);

        return $document->getDocumentIdentification($identificationName)->generate($documentIdentificationConfiguration, $context);
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
    public function save(DocumentInterface $document){
    }
    


}
