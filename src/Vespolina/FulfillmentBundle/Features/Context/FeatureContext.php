<?php

namespace Vespolina\FulfillmentBundle\Features\Context;

use Behat\BehatBundle\Context\BehatContext,
    Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
   require_once 'PHPUnit/Autoload.php';
   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends BehatContext //MinkContext if you want to test web
{
//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        $container = $this->getContainer();
//        $container->get('some_service')->doSomethingWith($argument);
//    }
//

    /**
      * @Given /^I have an order on a product$/
      */
     public function iHaveAnOrderOnAProduct()
     {
         throw new PendingException();
     }

     /**
      * @When /^I configure the fulfillment of this product$/
      */
     public function iConfigureTheFulfillmentOfThisProduct()
     {
         throw new PendingException();
     }

     /**
      * @Then /^I should see fulfillment of this product initialized$/
      */
     public function iShouldSeeFulfillmentOfThisProductInitialized()
     {
         throw new PendingException();
     }

     /**
      * @Given /^I set status to processing$/
      */
     public function iSetStatusToProcessing()
     {
         throw new PendingException();
     }

     /**
      * @Then /^I should read back "([^"]*)" for status$/
      */
     public function iShouldReadBackForStatus($argument1)
     {
         throw new PendingException();
     }

     /**
      * @Given /^I set status to "([^"]*)"$/
      */
     public function iSetStatusTo($argument1)
     {
         throw new PendingException();
     }

}
