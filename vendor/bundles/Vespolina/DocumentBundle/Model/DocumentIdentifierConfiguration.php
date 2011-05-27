<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model;

use Vespolina\DocumentBundle\Model\DocumentIdentifierConfigurationInterface;

class DocumentIdentifierConfiguration implements DocumentIdentifierConfigurationInterface
{
    protected $baseClass;

    /**
     * @inheritdoc
     */
    public function getBaseClass()
    {
        return $this->baseClass;
    }

    /**
     * @inheritdoc
     */
    public function setBaseClass($baseClass)
    {
        $this->baseClass = $baseClass;
    }
}