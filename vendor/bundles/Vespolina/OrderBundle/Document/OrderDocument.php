<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\DocumentBundle\Document;

use Vespolina\DocumentBundle\Document\BaseDocument;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Document extends BaseDocument
{
    public function __construct($documentConfigurationName)
    {
        parent::__construct($documentConfigurationName);
    }
}