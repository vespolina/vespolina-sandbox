<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\DocumentBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface;


interface DocumentIdentificationInterface
{

    /**
     * Get identification value
     *
     * @abstract
     * @return string
     */
    function getId();

    /**
     * Generate the identification value
     *
     * @abstract
     * @param array $context
     * @return string   the newly generated id
     */
    function generate(DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration, $context = array());


    /**
     * Set the id value
     *
     * @abstract
     * @param string $id
     */
    function setId($id);

    /**
     * Is the document identification valid?
     *
     * @abstract
     * @return bool
     */
    function valid();
   
}
