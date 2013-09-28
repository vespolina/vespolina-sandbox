<?php

use Behat\Behat\Context\ContextInterface;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Domain\Support\Helper;

/**
 * BaseContext
 */
class BaseContext implements ContextInterface
{
    protected $helper;

    /**
     * @BeforeScenario
     */
    public function prepareUseCasesAndHelpers($event)
    {
        $this->helper = new Helper();
        $this->helper->loadUseCases();
    }
}