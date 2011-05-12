<?php

namespace Vespolina\MonetaryBundle\Tests\Model;

use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;

class CurrencyTest extends MonetaryTestBase
{
    protected $currency;

    public function testGetCurrencyCode()
    {
        $this->assertSame('XTS', $this->currency->getCurrencyCode(), 'the currency code of the currency');
    }

    public function testGetName()
    {
        $this->assertSame('Codes specifically reserved for testing purpose', $this->currency->getName(), 'the name of the currency');
    }

    public function testGetSymbol()
    {
        $this->assertSame('Z', $this->currency->getSymbol(), 'the symbol for the currency');
    }

    public function testGetPrecision()
    {
        $this->assertSame(2, $this->currency->getPrecision(), 'default number of precision digits');
    }

    public function testFormatAmount()
    {
        $this->assertSame('Z3.21', $this->currency->formatAmount(3.205), 'amount, formatted for the currency');
    }

    public function setUp()
    {
        $this->currency = $this->getBaseCurrency();
    }
}
