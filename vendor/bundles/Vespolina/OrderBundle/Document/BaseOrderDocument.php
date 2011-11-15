<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\DocumentBundle\Document;

use Vespolina\DocumentBundle\Model\Document as AbstractDocument;
/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
abstract class BaseDocument extends AbstractDocument
{
    protected $id;
}