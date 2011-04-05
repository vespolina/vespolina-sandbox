<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PartnerBundle\Model;

interface PartnerInterface
{

    /**
     * Get unique identifier
     */
    public function getId();


    /**
     * Name of the partner
     */
    public function getName();

    /**
     * Get the name of the partner configuration to which this partner belongs
     */
    public function getPartnerConfigurationName();

    /**
     * Set the partner id
     *
     * @abstract
     * @param  $id
     * @return void
     */
    public function setId($id);

    /**
     * Set partner name
     *
     * @abstract
     * @param  $name
     * @return void
     */
    public function setName($name);


  
}
