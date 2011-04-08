<?php

namespace Vespolina\MonetaryBundle\Tests\Model;

use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;

class CurrencyTest extends MonetaryTestBase
{
    protected $currency;
    protected $largerCurrency;
    protected $smallerCurrency;
    protected $startTime;

    public function testGetCurrencyCode()
    {
        $this->assertSame('EUR', $this->currency->getCurrencyCode(), 'the currency code of the currency');
    }

    public function testGetName()
    {
        $this->assertSame('Euro', $this->currency->getName(), 'the name of the currency');
    }

    public function testGetSymbol()
    {
        $this->assertSame('€', $this->currency->getSymbol(), 'the symbol for the currency');
    }

    public function testGetPrecision()
    {
        $this->assertSame(2, $this->currency->getPrecision(), 'default number of precision digits');
    }

    public function testFormatAmount()
    {
        $this->assertSame('€3.21', $this->currency->formatAmount(3.205), 'amount, formatted for the currency');
    }

    public function setUp()
    {
        $this->currency = $this->getBaseCurrency();
    }
}
