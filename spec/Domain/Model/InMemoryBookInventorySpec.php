<?php

namespace spec\Domain\Model;

use Domain\Model\Book;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InMemoryBookInventorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Model\InMemoryBookInventory');
        $this->shouldImplement('Domain\Model\BookInventory');
    }

    function it_finds_book_by_id()
    {
        $book123 = new Book();
        $book123->setId(123);
        $this->save($book123);
        $this->findBy(['id' => 123])->shouldReturn([$book123]);
    }
}