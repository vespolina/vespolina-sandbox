<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model\DocumentIdentification;

use Vespolina\DocumentBundle\Model\DocumentIdentification;
use Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface;


class DbDocumentIdentification extends DocumentIdentification {

    public function generate(DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration, $context = array())
    {

        return $this->getId();
    }


}
