<?php

namespace Vespolina\DefaultStoreBundle\Document;

class OmnipayPaymentDetails extends \ArrayObject
{
    protected $id;

    protected $details = array();

    public function getId()
    {
        return $this->id;
    }

    public function addDetail($detail)
    {
        $this->details[] = $detail;

        return $this;
    }

    public function setDetails(array $details)
    {
        $this->details = $details;

        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }
}