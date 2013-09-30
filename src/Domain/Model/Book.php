<?php

namespace Domain\Model;

use Dough\Money\Money;

class Book
{
    protected $id;
    protected $price;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPrice(Money $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
