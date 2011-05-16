<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\CoreBundle\Component\Identifier;

interface IdentifierInterface
{
    /**
     * Get identifier value
     *
     * @abstract
     * @return string
     */
    function getId();

    /**
     * Get identifier name
     *
     * @abstract
     * @return string
     */
    function getName();

    /**
     * Set the id value
     *
     * @abstract
     * @param string $id
     */
    function setId($id);

    /**
     * Set the id name
     *
     * @abstract
     * @param string $name
     */
    function setName($name);

    /**
     * Is the document identifier valid?
     *
     * @abstract
     * @return bool
     */
    function valid();
}