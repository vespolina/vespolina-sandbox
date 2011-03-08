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

class DocumentConfiguration implements DocumentConfigurationInterface
{
    protected $baseClass;
    protected $name;
    
    public function getName(){
    
        return $this->name;
    }
    
    public function getBaseClass(){
        
        return $this->baseClass;
    
    }
    
    public function setBaseClass($baseClass){
    
        $this->baseClass = $baseClass;
        
    }
    
    public function setName($name){
    
        $this->name = $name;
        
    }  
	
}
