<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\DocumentBundle\Model;

interface DocumentIdentifierConfigurationInterface
{
    /**
     * Retrieve the base class of document identifier instance(s) which this configuration should create
     *
     * @abstract
     * @return void
     */
    function getBaseClass();

    /**
     * Set the base class of document identifier instance(s) which this configuration should create
     *
     * @abstract
     * @param  $baseClass
     * @return void
     */
    function setBaseClass($baseClass);
}