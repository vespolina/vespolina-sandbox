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
        $this->assertSame('VES', $this->currency->getCurrencyCode(), 'the currency code of the currency');
    }

    public function testGetSymbol()
    {
        $this->assertSame('V', $this->currency->getSymbol(), 'the symbol for the currency');
    }

    public function testGetPrecision()
    {
        $this->assertSame(2, $this->currency->getPrecision(), 'default number of precision digits');
    }

    public function testFormatAmount()
    {
        $this->assertSame('V3.21', $this->currency->formatAmount(3.205), 'amount, formatted for the currency');
    }

    public function testGetExchangeRate()
    {
        $this->assertSame(1, $this->currency->getExchangeRate(),' exchange rate, based on base currency');
        $this->assertSame(2, $this->largerCurrency->getExchangeRate(),' exchange rate, based on base currency');
        $this->assertSame(.5, $this->smallerCurrency->getExchangeRate(),' exchange rate, based on base currency');
    }

    public function testGetExchangeDateTime()
    {
        $this->assertEquals(new \DateTime('2010-07-05T06:00:00'), $this->currency->getExchangeDateTime(), 'the date and time of the exchange rate');
        $this->assertInstanceOf('DateTime', $this->largerCurrency->getExchangeDateTime(), 'the default date and time should be now');
    }

    public function testGetBaseCurrency()
    {
        $this->assertNull($this->currency->getBaseCurrency(), 'if this is the base currency, it should return null');
        $this->assertEquals($this->currency, $this->largerCurrency->getBaseCurrency(), 'base currency for the exchange rate');

    }

    public function testExchange()
    {
        $this->assertSame(1.5, $this->currency->exchange(1.5),'exchange rate of 1 with base');
        $this->assertEquals(100, $this->largerCurrency->exchange(50),'exchange rate of 1 with base');
        $this->assertSame(.38, $this->smallerCurrency->exchange(.75),'exchange rate of 1 with base');
    }

    public function setUp()
    {
        $this->startTime = new \DateTime('now');
        $this->currency = $this->getBaseCurrency();
        $this->largerCurrency = $this->getCurrency($this->currency, 'LGR', 'L', 2);
        $this->smallerCurrency = $this->getCurrency($this->currency, 'SML', 'S', .5);
    }
}
