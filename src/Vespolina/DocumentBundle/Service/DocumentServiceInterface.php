<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\DocumentBundle\Service;

use Vespolina\DocumentBundle\Model\DocumentConfigurationInterface;
use Vespolina\DocumentBundle\Model\DocumentInterface;


interface DocumentServiceInterface
{
    /**
     * Create a document instance for the given document configuration
     *
     * @abstract
     * @param \Vespolina\DocumentBundle\Model\DocumentConfigurationInterface $documentConfiguration
     * @return void
     */
    function create(DocumentConfigurationInterface $documentConfiguration);

    /**
     * Create a document item and attach it to the document
     *
     * @abstract
     * @param \Vespolina\DocumentBundle\Model\Document $document The document for which we want to create an item
     * @param \Vespolina\DocumentBundle\Model\DocumentConfigurationInterface $documentConfiguration
     *
     * @return void
     */
    function createItem(DocumentInterface $document, DocumentConfigurationInterface $documentConfiguration = null);

    /**
     * Generate a document id for the supplied document identified by the supplied document id name
     *
     * @abstract
     * @param DocumentInterface $document
     * @param  $identificationName The name of the document identification
     * @param  $context The required context to generate the id
         * @return void
     */
    function generateDocumentIdentification(DocumentInterface $document, $identificationName = 'id', $context);

    /**
     * Save the document
     *
     * @abstract
     * @param DocumentInterface $document
     * @return void
     */
    function save(DocumentInterface $document);
   
   
}
