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
     * Create an instance for the given document configuration
     *
     * @abstract
     * @param \Vespolina\DocumentBundle\Model\DocumentConfigurationInterface $DocumentConfiguration
     * @return void
     */
    function createInstance(DocumentConfigurationInterface $DocumentConfiguration);

    /**
     * Generate a document id for the supplied document identified by the supplie document id name
     *
     * @abstract
     * @param DocumentInterface $document
     * @param  $identificationName The name of the document identification
     * @return void
     */
    function generateDocumentIdentification(DocumentInterface $document, $identificationName = 'id');

    /**
     * Save the document
     *
     * @abstract
     * @param DocumentInterface $document
     * @return void
     */
    function save(DocumentInterface $document);
   
   
}
