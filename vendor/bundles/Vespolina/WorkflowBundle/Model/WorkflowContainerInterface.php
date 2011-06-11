<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\WorkflowBundle\Model;

interface WorkflowContainerInterface
{
    /**
     * Get container item identified by key $key
     *
     * @abstract
     * @param  $key
     * @param null $default Default value to be returned if item is not present
     * @return void
     */
    function get($key, $default = null);

    /**
     * Set container item identified by $key to value $value
     *
     * @abstract
     * @param  $key
     * @param  $value
     * @return void
     */
    function set($key, $value);

    /**
     * Returns all container data as an associated array
     * @abstract
     * @return void
     */
    function getContainerData();
}
