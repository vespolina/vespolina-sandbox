<?php

namespace spec\Domain\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HelperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Support\Helper');
    }
}