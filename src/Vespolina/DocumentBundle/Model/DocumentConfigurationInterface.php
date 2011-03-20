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

interface DocumentConfigurationInterface
{

    /**
     * Retrieve the base class of document instance(s) which this configuration should create
     *
     * @abstract
     * @return void
     */
    function getBaseClass();

    /**
     * Get the document configuration name
     *
     * @abstract
     * @return void
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
