<?php

namespace spec\Domain\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HelperSpec extends ObjectBehavior
{
    function let()
    {
        $this->loadUseCases();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Support\Helper');
    }

    function it_creates_a_request_for_a_specific_book()
    {
        $this->createTheRequestForTheSpecificBook()->shouldHaveKey('bookId');
    }

    function it_creates_book_with_id()
    {
        $this->persistBookSampleOnInventoryWithId(123);
    }

    function it_redirectsCustomerToThirdPartyForPayment()
    {
        $params = [
            'id' => 123,
            'amount' => 12,
            'quantity' => 1
        ];

        $response = new RedirectResponse('https://sandbox.paypal.com');

        $this->redirectsCustomerToThirdPartyForPayment()->shouldReturn($response);
    }
}