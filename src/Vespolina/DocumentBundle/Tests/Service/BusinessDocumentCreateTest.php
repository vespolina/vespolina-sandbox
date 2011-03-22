<?php

namespace Vespolina\DocumentBundle\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Vespolina\DocumentBundle\Model\DocumentIdentificationConfiguration;
use Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification;

use Vespolina\DocumentBundle\Model\DocumentConfiguration;
use Vespolina\DocumentBundle\Model\DocumentPartnerFunction;

use Vespolina\OrderBundle\Model\OrderDocument;
use Vespolina\PartnerBundle\Service\PartnerServiceInterface;
use Vespolina\PartnerBundle\Model\PartnerConfiguration;


class DocumentCreateTest extends WebTestCase
{
    protected $client;
    protected $documentService;
    protected $partnerService;

    protected $documentConfigurationGenericDoc;

    protected $documentB1;

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


    public function testA1DocumentConfigurationCreate()
    {

        $c['documentService'] = $this->getKernel()->getContainer()->get('vespolina.document');

        //Test 1: create document configuration

        $c['documentConfigurationGenericDoc1'] = $c['documentService']->getDocumentConfiguration('generic_document_1');
        $c['documentConfigurationGenericDoc1']->setBaseClass('Vespolina\DocumentBundle\Model\Document');
        $c['documentConfigurationGenericDoc1']->setItemBaseClass('Vespolina\DocumentBundle\Model\DocumentItem');

        $c['documentConfigurationGenericDoc2'] = $c['documentService']->getDocumentConfiguration('generic_document_2');
        $c['documentConfigurationGenericDoc2']->setBaseClass('Vespolina\DocumentBundle\Model\Document');
        $c['documentConfigurationGenericDoc2']->setItemBaseClass('Vespolina\DocumentBundle\Model\DocumentItem');

        //Create document identification configurations (how documents should be identified/numbered)
        $documentIdentificationConfiguration1 = new DocumentIdentificationConfiguration();
        $documentIdentificationConfiguration1->setBaseClass('Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification');

        $documentIdentificationConfiguration2a = new DocumentIdentificationConfiguration();
        $documentIdentificationConfiguration2a->setBaseClass('Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification');

        $documentIdentificationConfiguration2b = new DocumentIdentificationConfiguration();
        $documentIdentificationConfiguration2b->setBaseClass('Vespolina\DocumentBundle\Model\DocumentIdentification\DbDocumentIdentification');

        $c['documentConfigurationGenericDoc1']->addDocumentIdentificationConfiguration('id', $documentIdentificationConfiguration1);

        $c['documentConfigurationGenericDoc2']->addDocumentIdentificationConfiguration('id', $documentIdentificationConfiguration2a);
        $c['documentConfigurationGenericDoc2']->addDocumentIdentificationConfiguration('barcode', $documentIdentificationConfiguration2b);


        return $c;
    }

    /**
     * @depends testA1DocumentConfigurationCreate
     */
    public function testB1DocumentCreate($c)
    {

        $c['document1'] = $c['documentService']->create($c['documentConfigurationGenericDoc1']);
        $c['document2'] = $c['documentService']->create($c['documentConfigurationGenericDoc2']);

        $this->assertEquals('generic_document_1', $c['document1']->getDocumentConfigurationName());
        $this->assertEquals('generic_document_2', $c['document2']->getDocumentConfigurationName());

       //Generate the document id identified in the document configuration by the name 'id'
        $identificationContext = array();

        $c['documentService']->generateDocumentIdentification( $c['document1'], 'id', $identificationContext);
        $c['documentService']->generateDocumentIdentification( $c['document2'], 'id', $identificationContext);
        $c['documentService']->generateDocumentIdentification( $c['document2'], 'barcode', $identificationContext);

        return $c;
    }

    /**
     * @depends testB1DocumentCreate
     */
    public function testB2DocumentItemCreate($c)
    {

        $documentItem1a = $c['documentService']->createItem($c['document1']);

        //$this->assertNotEquals($documentItem1a, null);
        $documentItems = $c['document1']->getItems();

        return $c;

    }

    /**
     * @depends testB2DocumentItemCreate
     */
    public function testB3DocumentPartnerCreate($c)
    {

        $c['partnerService'] = $this->getKernel()->getContainer()->get('vespolina.partner');

        $partnerCustomerB2CConfiguration = new PartnerConfiguration();
        $partnerCustomerB2CConfiguration->setName('customer_b2c'); //Business to Consumer
        $partnerCustomerB2CConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Customer');
        
        $partnerEmployeeConfiguration = new PartnerConfiguration();
        $partnerEmployeeConfiguration->setName('internal_employee');
        $partnerEmployeeConfiguration->setBaseClass('Vespolina\PartnerBundle\Model\Employee');
        
        $customer = $c['partnerService']->createInstance($partnerCustomerB2CConfiguration);
        $employee = $c['partnerService']->createInstance($partnerEmployeeConfiguration);

        //Attach the partner to the business object and let it have the role of a customer for this document
        $c['document1']->addPartner($customer, new DocumentPartnerFunction('customer'));
        
        //Attach the partner to the business object and let it have the role of a sales manager for this document
        $c['document1']->addPartner($employee, new DocumentPartnerFunction('contact_person'));
        
        if ($customers = $c['document1']->getPartners(new DocumentPartnerFunction('customer'))){
        
            $customer = $customers[0];
            
        }
        
        
        //$DocumentService->addPartner($Document, $customer, new PartnerFunction('customer'));
        //$DocumentService->addPartner($Document, $employee, new PartnerFunction('employee'));
        
        return $c;

    }
}