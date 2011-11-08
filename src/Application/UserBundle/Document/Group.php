<?php

namespace Application\UserBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use FOS\UserBundle\Document\Group as BaseGroup;

/**
 * @MongoDB\Document
 */
class Group extends BaseGroup
{
    /** @MongoDB\Id(strategy="auto") */
    protected $id;
}
