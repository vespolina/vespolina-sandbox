<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
 
namespace Vespolina\PricingBundle\Model;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Vespolina\PricingBundle\Model\PriceableEntityInterface;
use Vespolina\PricingBundle\Model\PricingContextContainer;
use Vespolina\PricingBundle\Model\PricingSet;
use Vespolina\PricingBundle\Model\PricingSetInterface;
use Vespolina\PricingBundle\Model\PricingElement\MonetaryPricingElement;

use Vespolina\PricingBundle\Model\PricingDimension\PeriodPricingDimension;
use Vespolina\PricingBundle\Model\PricingDimension\VolumePricingDimension;

use Vespolina\PricingBundle\Model\PricingExecutionStep\ContainerCompute;
use Vespolina\PricingBundle\Model\PricingExecutionStep\SetContainerValue;
use Vespolina\PricingBundle\Model\PricingExecutionStep\DetermineVatRate;
use Vespolina\PricingBundle\Model\PricingExecutionStep\SetPricingElementFromContainerValue;

use Vespolina\PricingBundle\Service\PricingServiceInterface;

class PricingConfiguration implements PricingConfigurationInterface
{
    protected $determinationSequence;
    protected $name;
    protected $pricingSetConfiguration;
    protected $pricingService;

    /**
     * Constructor
     *
     * @param \Vespolina\PricingBundle\Service\PricingServiceInterface $pricingService
     */
    public function __construct(PricingServiceInterface $pricingService)
    {
  
        $this->pricingService = $pricingService;
    }

    /**
     * Create a new pricing set for this pricing configuration
     *
     * @return PricingSet
     */
    public function createPricingSet()
    {
        $pricingSet = new PricingSet();
    
        //Set default pricing dimension values
        foreach ($this->getPricingSetConfiguration()->getPricingDimensions() as $pricingDimension){
        
            $pricingDimension->setDefaultParametersForPricingSet($pricingSet);
        }
        
        return $pricingSet;
    }
    

    public function createPricingContextContainer()
    {
    
        return new PricingContextContainer();
    }

    /**
     * Create a new pricing set container from an existing pricing set,
     * copying necessary pricing element values to the pricing set container
     *
     * @param PricingSetInterface $pricingSet
     * @return PricingContextContainer
     */
    public function createPricingContextContainerFromPricingSet(PricingSetInterface $pricingSet)
    {
  
        $pricingContextContainer = new PricingContextContainer();
        
        foreach ($this->getPricingSetConfiguration()->getPricingElements('all') as $pricingElement){
        
          $pricingContextContainer->set($pricingElement->getName(), $pricingElement->getValue());
          
        }
        
        return $pricingContextContainer;
    }

    /**
     * Build / calculate the necessary pricing values based on the pricing set,
     *  a given runtime pricing context container and possible some options.
     *
     * @param PricingSetInterface $pricingSet
     * @param PricingContextContainerInterface $container
     * @param array $options Possible
     *    Possible options:
     *      - execution_event ( all | context_independent | context_dependent )
     * @return PricingSetInterface
     */
    public function buildPricingSet(PricingSetInterface $pricingSet,
                                    PricingContextContainerInterface $container,
                                    $options = array())
    { 
		
        if (array_key_exists('execution_event', $options)) {
       
           $executionEvent = $options['execution_event'];
        
        } else {
        
           $executionEvent = 'all';
        
        }
        //Init all pricing executions steps
        foreach ($this->getPricingSetConfiguration()->getPricingExecutionSteps($executionEvent) as $pricingExecutionStep){
     
            $pricingExecutionStep->init($container);
        
        }
        
        //Execute all execution steps
        foreach ($this->pricingSetConfiguration->getPricingExecutionSteps($executionEvent) as $pricingExecutionStep){
     
            $pricingExecutionStep->execute();
        
        }
        
        //The pricing context container is nicely filled. For now expect that the name of the pricing element and 
        //the pricing context container name are the same
        
        foreach ($this->pricingSetConfiguration->getPricingElements($executionEvent) as $pricingElement){
          
            $pricingElement->setValue($container->get($pricingElement->getName()));
            $pricingSet->addPricingElement($pricingElement);
        }
        
        return $pricingSet;
    }  

    /**
     * Retrieve the pricing dimensions associated to this pricing set
     *
     * @return
     */
    protected function getPricingDimensions()
    {
        return $this->pricingDimensions;
    }

    /**
     * Temporary, should be moved into a PricingLoader class
     */
    protected function loadPricingSetConfiguration()
    {
  
        $pricingSetConfiguration = new PricingSetConfiguration();
        
        //begin of test: should be moved to pricing.xml
        
        //Our set will hold two price elements (net_value and packaging_cost)
        $pricingSetConfiguration->addPricingElement(
            new MonetaryPricingElement(array('name' => 'packaging_cost')),
            array('execution_event' => 'context_independent'));
        
        $pricingSetConfiguration->addPricingElement(
            new MonetaryPricingElement(array('name' => 'net_value')),
            array('execution_event' => 'context_independent'));
        
        $pricingSetConfiguration->addPricingElement(
            new MonetaryPricingElement(array('name' => 'vat_rate')),
            array('execution_event' => 'context_dependent'));
        
        $pricingSetConfiguration->addPricingElement(
            new MonetaryPricingElement(array('name' => 'total_excl_vat')),
            array('execution_event' => 'context_independent'));
        
        $pricingSetConfiguration->addPricingElement(
            new MonetaryPricingElement(array('name' => 'total_incl_vat')),
            array('execution_event' => 'context_dependent'));
        
        
        //Determine how the price will be calculated
        $pricingSetConfiguration->addPricingExecutionStep(
          new SetContainerValue(
                array('source' => '5',
                      'target' => 'packaging_cost_factor')),
          array('execution_event' => 'context_independent'));
       
        $pricingSetConfiguration->addPricingExecutionStep(
          new ContainerCompute(
                array('source' => 'net_value / 100 * packaging_cost_factor',
                      'target' => 'packaging_cost')),
          array('execution_event' => 'context_independent'));

        $pricingSetConfiguration->addPricingExecutionStep(
          new DetermineVatRate(
                array('source' => 'customer',
                      'strategy' => 'region_based_determination',
                      'target' => 'vat_rate')),
          array('execution_event' => 'context_independent'));
      
        $pricingSetConfiguration->addPricingExecutionStep(
          new ContainerCompute(
                array('source' => 'packaging_cost + net_value',
                      'target' => 'total_excl_vat')),
          array('execution_event' => 'context_independent'));
      
        $pricingSetConfiguration->addPricingExecutionStep(
          new ContainerCompute(
                array('source' => '(packaging_cost + net_value) * ( (100 + vat_rate) / 100)',
                      'target' => 'total_incl_vat')),
          array('execution_event' => 'context_dependent'));  //Indirect consequence of Vat rate determination
      
        //What pricing dimensions is this pricing set capable of
        $pricingSetConfiguration->addPricingDimension(
            new PeriodPricingDimension('period_1'));
      
        $pricingSetConfiguration->addPricingDimension(
            new VolumePricingDimension('volume_1'));
      
        //end of test
        
        return $pricingSetConfiguration;
    }

    /**
     * Return the pricing set configuration associated to this pricing configuration
     *
     * @return
     */
  
    protected function getPricingSetConfiguration(){

        if (!$this->pricingSetConfiguration) {
        
          $this->pricingSetConfiguration = $this->loadPricingSetConfiguration();
        }

        return $this->pricingSetConfiguration;

    }


}
