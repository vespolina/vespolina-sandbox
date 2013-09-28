<?php

namespace spec\Domain\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Dough\Money\Money;

class BookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Model\Book');
    }

    function it_gets_identity()
    {
        $this->setId(123);
        $this->getId()->shouldBe(123);
    }

    function it_has_a_price()
    {
        $price = new Money(12.80);
        $this->setPrice($price);
        $this->getPrice()->shouldBe($price);
    }
}