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

interface DocumentConfigurationInterface
{

    /**
     * Add a document identifier configuration
     *
     */
    function addDocumentIdentifierConfiguration($name, DocumentIdentifierConfigurationInterface $documentIdentifierConfiguration);

    /**
     * Retrieve the base class of document instance(s) which this configuration should create
     *
     * @abstract
     * @return string
     */
    function getBaseClass();

    /**
     * Retrieve the base class of document item instance(s) which this configuration should create
     *
     * @abstract
     * @return string
     */
    function getItemBaseClass();


    /**
     * Retrieve the list of known document identifier configurations
     *
     * @abstract
     * @return array Vespolina\DocumentBundle\Model\DocumentIdentifierConfigurationInterface instance
     */
    function getDocumentIdentifierConfigurations();

    /**
     * Retrieve the document identifier configuration specified by the supplied name
     *
     */
    function getDocumentIdentifierConfiguration($name);

    /**
     * Get the document configuration name
     *
     * @abstract
     * @return \Vespolina\DocumentBundle\Model\DocumentIdentifierConfigurationInterface
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
     * Set the base class of document item instance(s) which this configuration should create
     *
     * @abstract
     * @param  $itemBaseClass
     * @return void
     */
    function setItemBaseClass($itemBaseClass);

    /**
     * Set the document configuration name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    function setName($name);

}
