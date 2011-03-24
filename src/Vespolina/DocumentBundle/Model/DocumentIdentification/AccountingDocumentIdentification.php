<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DocumentBundle\Model\DocumentIdentification;

use Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification;
use Vespolina\DocumentBundle\Model\DocumentIdentificationConfigurationInterface;

/**
 * This class holds an accounting document id
 *
 */

class AccountingDocumentIdentification extends DbDocumentIdentification {

    protected $fiscalYear;

    /**
     * @inheritdoc
     */
    public function generate(DocumentIdentificationConfigurationInterface $documentIdentificationConfiguration, $context = array())
    {

        //Todo get newly created id from the database
        return $this->getId();
    }

    /**
     * Get the fiscal year component of the document identification
     *
     * @return int fiscal year
     */
    public function getFiscalYear()
    {
        // Extract the fiscal year from the id only if it is requested
        if (!$this->fiscalYear && strlen($this->id) > 4 ) {

            $this->fiscalYear = substr($this->id, 0, 4);
        }

        return $this->fiscalYear;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {

        return $this->id;
    }


    /**
     * Set the fiscal year for this component
     *
     * @param  $fiscalYear
     * @return void
     */
    public function setFiscalYear($fiscalYear)
    {
       $this->fiscalYear = $fiscalYear;
    }

}
