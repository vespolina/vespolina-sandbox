<?php

namespace Application\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\UserBundle\Model\User as BaseUser;
use Vespolina\Entity\Partner\PartnerInterface;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /** @MongoDB\Id(strategy="auto") */
    protected $id;

    protected $partner;



    public function setPartner(PartnerInterface $partner)
    {
        $this->partner = $partner;
    }

    public function getPartner()
    {
        return $this->partner;
    }
}

