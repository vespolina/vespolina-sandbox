<?php

namespace Application\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\UserBundle\Document\User as BaseUser;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /** @MongoDB\Id(strategy="auto") */
    protected $id;

}

