<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\DocumentBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Vespolina\DocumentBundle\Model\DocumentConfiguration;
use Vespolina\DocumentBundle\Model\DocumentConfigurationInterface;
use Vespolina\DocumentBundle\Service\DocumentServiceInterface;


class DocumentService extends ContainerAware implements DocumentServiceInterface
{

    
    public function createInstance(DocumentConfigurationInterface $DocumentConfiguration)
    {
        
        $baseClass = $DocumentConfiguration->getBaseClass();
        
        $Document = new $baseClass();
        
        return $Document;
    }
    
    public function save(DocumentInterface $Document){
    }
    
    
 
  
}
