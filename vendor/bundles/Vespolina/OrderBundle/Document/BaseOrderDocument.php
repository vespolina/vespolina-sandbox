<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\OrderBundle\Document;

use Vespolina\OrderBundle\Model\OrderDocument as AbstractOrderDocument;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseOrderDocument extends AbstractOrderDocument
{
    protected $id;
}