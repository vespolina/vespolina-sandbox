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

interface DocumentConfigurationInterface
{

    /**
     * Add a document identification configuration
     *
     */
    function addDocumentIdentificationConfiguration($name, DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration);

    /**
     * Retrieve the base class of document instance(s) which this configuration should create
     *
     * @abstract
     * @return void
     */
    function getBaseClass();


    /**
     * Retrieve the list of known document identification configurations
     *
     * @abstract
     * @return array Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface instance
     */
    function getDocumentIdentificationConfigurations();

    /**
     * Retrieve the document identification configuration specified by the supplied name
     *
     */
    function getDocumentIdentificationConfiguration($name);

    /**
     * Get the document configuration name
     *
     * @abstract
     * @return \Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface
     */
    function getName();

    /**
     * Set the base class of document instance(s) which this configuration should create
     *
     * @abstract
     * @param  $baseClass
     * @return void
     */
    function setBaseClass($baseClass);

    /**
     * Set the document configuration name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);

}
