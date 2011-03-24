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

/**
 * This class holds a database auto generated id
 *
 */

class DbDocumentIdentification extends DocumentIdentification {

    /**
     * @inheritdoc
     */
    public function generate(DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration, $context = array())
    {

        //Todo get newly created id from the database
        return $this->getId();
    }


}
