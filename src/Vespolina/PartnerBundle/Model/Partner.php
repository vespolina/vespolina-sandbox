<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\PartnerBundle\Model;

use Vespolina\PartnerBundle\Model\PartnerInterface;

class Partner implements PartnerInterface
{

    protected $partnerConfigurationName;

    public function __construct($partnerConfigurationName)
    {

        $this->partnerConfigurationName = $partnerConfigurationName;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getPartnerConfigurationName()
    {

        return $this->partnerConfigurationName;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
    }
  
    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
