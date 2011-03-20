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
        
        $documentService = $this->getKernel()->getContainer()->get('vespolina.document');
        $partnerService = $this->getKernel()->getContainer()->get('vespolina.partner');
        
        //Use case 1: Create a generic business object involving an customer and an employee acting as contact person
    
        $documentConfiguration = $documentService->getDocumentConfiguration('generic_document');
        $documentConfiguration->setBaseClass('Vespolina\DocumentBundle\Model\Document');
                
        $document = $documentService->createInstance($documentConfiguration);

        //Generate the document id identified in the document configuration by the name 'id'
        $documentService->generateDocumentIdentification($document, 'id');

        $documentIdentification = $document->getDocumentIdentification('id');


        $partnerCustomerB2CConfiguration = new PartnerConfiguration();
        $partnerCustomerB2CConfiguration->setName('customer_b2c'); //Business to Consumer
        $partnerCustomerB2CConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Customer');
        
        $partnerEmployeeConfiguration = new PartnerConfiguration();
        $partnerEmployeeConfiguration->setName('internal_employee');
        $partnerEmployeeConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Employee');
        
        $customer = $partnerService->createInstance($partnerCustomerB2CConfiguration);
        $employee = $partnerService->createInstance($partnerEmployeeConfiguration);

        //Attach the partner to the business object and let it have the role of a customer for this document
        $document->addPartner($customer, new DocumentPartnerFunction('customer'));
        
        //Attach the partner to the business object and let it have the role of a sales manager for this document
        $document->addPartner($employee, new DocumentPartnerFunction('contact_person'));
        
        if ($customers = $document->getPartners(new DocumentPartnerFunction('customer'))){
        
            $customer = $customers[0];
            
        }
        
        
        //$DocumentService->addPartner($Document, $customer, new PartnerFunction('customer'));
        //$DocumentService->addPartner($Document, $employee, new PartnerFunction('employee'));
        
        

    }
}