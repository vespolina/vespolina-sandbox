<?php

namespace Vespolina\MonetaryBundle\Tests\Model;

use Vespolina\MonetaryBundle\Model\Monetary;
use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;

class MonetaryTest extends MonetaryTestBase
{
    protected $currency;

    public function testConstruct()
    {
        $monetary = new Monetary(3.42, $this->currency);
        $this->assertSame(3.42, $monetary->getValue(), 'the value must be set on initialization');
        $this->assertSame($this->currency, $monetary->getCurrency(), 'the currency must be set on initialization');
    }

    public function testSetValue()
    {
        $monetary = new Monetary(3.42, $this->currency);
        $monetary->setValue(1.23);
        $this->assertSame(1.23, $monetary->getValue(), 'update the value');
    }

    public function setUp()
    {
        $this->currency = $this->getBaseCurrency();
    }
}
