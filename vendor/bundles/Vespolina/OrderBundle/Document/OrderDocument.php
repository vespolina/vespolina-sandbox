<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Vespolina\OrderBundle\Document\BaseOrderDocument;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class OrderDocument extends BaseOrderDocument
{
    public function __construct($documentConfigurationName)
    {
        parent::__construct($documentConfigurationName);
    }
}