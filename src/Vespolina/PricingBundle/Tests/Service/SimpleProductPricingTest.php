<?php

namespace Vespolina\PricingBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Vespolina\PricingBundle\Service\Pricing;
use Vespolina\ProductBundle\Model\Product;

class SimpleProductPricingTest extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = $this->createClient();
    }

    public function getKernel(array $options = array())
    {
        if (!$this->kernel) {
            $this->kernel = $this->createKernel($options);
            $this->kernel->boot();
        }

        return $this->kernel;
    }

    /**
     * @covers Vespolina\PricingBundle\Service\PricingService::determinePrices
     */
    public function testDeterminePrices()
    {
        $this->markTestSkipped();
    }

    public function testCalculatePricingSets()
    {

        $today = new \DateTime('now');
        $nextMonth = new \DateTime('first day of next month');
        
        $pricingService = $this->getKernel()->getContainer()->get('vespolina.pricing');
            
        /**
         *  Test case 1: Create a pricing set for a product with a net value of 100 euro for today till first of next month.
         *  The price is valid if the ordered quantity volume is 99 or less.
            if less than 10
         */

        $product = new Product();

        //Retrieve pricing meta data
        $pricingConfiguration = $pricingService->getPricingConfiguration('default_product');

        //Create a pricing context container which is only used for runtime/execution purposes
        $pricingContextContainer = $pricingService->createPricingContextContainer($pricingConfiguration);

        //Pricing Configuration already knows that net value is expressed in euro, so we just need to set a value
        $pricingContextContainer->set('net_value', '100');  

        //The difference between a price set and pricing context container is the fact that the latter
        //can contain more temporary runtime data which doesn't need to be stored at all

        $pricingSet = $pricingService->createPricingSet($pricingConfiguration);

        //1st dimension parameter: the price set is available only from today till next month
        $pricingSet->setPricingDimensionParameters( 'period', 
                                                    array('from' => $today, 
                                                          'to' =>   $nextMonth));
                                                   
        //2nd dimension parameter: the price set is only available for volumes between 1 and 99
        $pricingSet->setPricingDimensionParameters( 'volume', 
                                                    array('from' => 1, 
                                                          'to' =>  99));    

        $pricingService->buildPricingSet(
            $pricingSet, 
            $pricingContextContainer, 
            array('execution_event' => 'context_independent'));
        
        $product->addPricingSet($pricingSet);
       
        //Normally here we save everything to the database

        //Some time late we retrieve the product and associated active pricing set,
        //We now need to update the pricing set and add context dependent calculation ( add customer = TODO)

        //$pricingContextContainer->setValue('customer', blb);
            
        $pricingService->buildPricingSet(
            $pricingSet,
            $pricingContextContainer,
            array('execution_event' => 'context_dependent'));

        // Assertions

        foreach ($pricingSet->getPricingElements() as $pricingElement) {

            switch ($pricingElement->getName()){

                case 'net_value':
                    $this->assertEquals($pricingElement->getValue(), '100');
                    break;
                case 'packaging_cost':
                    $this->assertEquals($pricingElement->getValue(), '5');
                    break;
            }

        }
          
        /** Test case 2: Update the product so the net_value is 120 euro (starting next month, 
         *  no matter what the ordered quantity is).  
         *  The packaging cost is linked and should therefore be recalculated
         */
        
        //Create pricing context container from the existing pricing set
    
        $pricingSetTwo = $pricingService->createPricingSet($pricingConfiguration);

        $pricingSetTwo->setPricingDimensionParameters( 'period', 
                                                        array('from' => $nextMonth));
        
        $pricingContextContainerTwo = $pricingService->createPricingContextContainerFromPricingSet($pricingSetTwo);
        $pricingContextContainerTwo->set('net_value', '120');  
   
        $pricingService->buildPricingSet(
            $pricingSetTwo,
            $pricingContextContainerTwo, 
            array('execution_event' => 'all'));
        
          
        $product->addPricingSet($pricingSetTwo);
      



        foreach ($pricingSetTwo->getPricingElements() as $pricingElementTwo) {
            
            switch ($pricingElementTwo->getName()){
                
                case 'net_value':
                    $this->assertEquals($pricingElementTwo->getValue(), '120');
                    break;
                case 'packaging_cost':
                    $this->assertEquals($pricingElementTwo->getValue(), '6');
                    break;                    
            }
            
        }
    }
}