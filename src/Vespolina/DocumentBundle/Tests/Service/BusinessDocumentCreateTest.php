<?php

namespace Vespolina\DocumentBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\DocumentBundle\Model\DocumentConfiguration;
use Vespolina\DocumentBundle\Model\DocumentPartnerFunction;
use Vespolina\CoreBundle\Model\Product;
use Vespolina\OrderBundle\Model\OrderDocument;
use Vespolina\PartnerBundle\Service\PartnerServiceInterface;
use Vespolina\PartnerBundle\Model\PartnerConfiguration;


class DocumentCreateTest extends WebTestCase
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
     * @covers Vespolina\DocumentBundle\Service\DocumentService::create
     */
    public function testDocumentCreate()
    {
        
        $DocumentService = $this->getKernel()->getContainer()->get('vespolina.document');
        $partnerService = $this->getKernel()->getContainer()->get('vespolina.partner');
        
        //Create a generic business object involving an customer and an employee acting as contact person
    
        $DocumentConfiguration = new DocumentConfiguration();
        $DocumentConfiguration->setName('generic_document');
        $DocumentConfiguration->setBaseClass('Vespolina\DocumentBundle\Model\Document');
                
        $Document = $DocumentService->createInstance($DocumentConfiguration);
        
        $partnerCustomerB2CConfiguration = new PartnerConfiguration();
        $partnerCustomerB2CConfiguration->setName('customer_b2c'); //Business to Consumer
        $partnerCustomerB2CConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Customer');
        
        $partnerEmployeeConfiguration = new PartnerConfiguration();
        $partnerEmployeeConfiguration->setName('internal_employee');
        $partnerEmployeeConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Employee');
        
        $customer = $partnerService->createInstance($partnerCustomerB2CConfiguration);
        $employee = $partnerService->createInstance($partnerEmployeeConfiguration);

        //Attach the partner to the business object and let it have the role of a customer for this document
        $Document->addPartner($customer, new DocumentPartnerFunction('customer'));
        
        //Attach the partner to the business object and let it have the role of a sales manager for this document
        $Document->addPartner($employee, new DocumentPartnerFunction('contact_person'));
        
        if ($customers = $Document->getPartners(new DocumentPartnerFunction('customer'))){
        
            $customer = $customers[0];
            
        }
        
        
        //$DocumentService->addPartner($Document, $customer, new PartnerFunction('customer'));
        //$DocumentService->addPartner($Document, $employee, new PartnerFunction('employee'));
        
        

    }
}