<?php

use Behat\Behat\Context\ContextInterface;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Domain\Support\Helper;
use Dough\Money\Money;

/**
 * BaseContext
 */
class BaseContext implements ContextInterface
{
    protected $helper;
    protected $bookRequest;

    /**
     * @BeforeScenario
     */
    public function prepareUseCasesAndHelpers($event)
    {
        $this->helper = new Helper();
        $this->helper->loadUseCases();
    }

    /**
     * @Given /^customer specifies the book she wants$/
     */
    public function customerSpecifiesTheBookSheWants()
    {
        $this->helper->persistBookSampleOnInventoryWithId(123);
        $this->bookRequest = $this->helper->createTheRequestForTheSpecificBook();
        expect($this->bookRequest)->toBe(['bookId' => 123]);
    }

    /**
     * @Then /^customer is sent to third-party site$/
     */
    public function customerIsSentToPaypalSite()
    {
        expect($this->helper->findBookInformation($this->bookRequest))
            ->toBeLike([
                'id' => 123,
                'amount' => new Money(12),
                'quantity' => 1
            ])
        ;
        expect($this->helper->redirectsCustomerToThirdPartyForPayment())->shouldBe(true);
        expect($this->helper->waitsForResponseFromThirdPartyAfterPaymentIsDone())->shouldBe(true);
        expect($this->helper->issueOrderAndSendBookToCustomerUponConfirmation())->shouldBe(true);
    }

    /**
     * @When /^customer fills in info at third-party site and submits$/
     */
    public function customerFillsInPaypalInfoAndSubmits()
    {
        throw new PendingException();
    }

    /**
     * @Then /^customer is redirected to former site$/
     */
    public function customerIsRedirectedToFormerSite()
    {
        throw new PendingException();
    }

    /**
     * @Then /^customer finishes order and receives book$/
     */
    public function customerFinishesOrderAndReceivesBook()
    {
        throw new PendingException();
    }
}