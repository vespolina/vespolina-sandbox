<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

class PricingContextContainer implements PricingContextContainerInterface {

    protected $entities;
    protected $data;

    public function PricingContextContainer($data = array())
    {
        $this->entities = array();
        $this->data = $data;
    }

    public function addEntity(&$entity)
    {
        $this->entities[] = $entity;
    }

    public function getEntities()
    {
    
        return $this->entities;
    }


    public function setEntities($entities)
    {
        $this->entities = $entities;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
        
            return $this->data[$key];
            
        } elseif($default) {
        
            return $default;
        
        } else{
        
            return null;
        }
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getContainerData()
    {
        return $this->data;
    }
}
