<?php

namespace Vespolina\MonetaryBundle\Tests\Model;

use Vespolina\MonetaryBundle\Model\Currency;
use Vespolina\MonetaryBundle\Model\BaseCurrency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    protected $currency;
    protected $largerCurrency;
    protected $smallerCurrency;
    protected $startTime;
    protected $exchangeRates = array(
        ''
    );

    public function testGetCurrencyCode()
    {
        $this->assertSame('VES', $this->currency->getCurrencyCode(), 'the currency code of the currency');
    }

    public function testGetSymbol()
    {
        $this->assertSame('V', $this->currency->getCurrencyCode(), 'the symbol for the currency');
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
        $this->assertSame('2010-07-05 08:00:00+0000', $this->currency->getExchangeDateTime(),' the date and time of the exchange rate');
        $this->assertGreaterThanOrEqual($this->startTime, $this->largerCurrency->getExchangeDateTime(),' the default date and time should be now');
    }

    public function testGetBaseCurrency()
    {
        $this->assertNull($this->currency->getBaseCurrency(), 'if this is the base currency, it should return null');
        $this->assertEquals($this->currency, $this->largerCurrency->getBaseCurrency(), 'base currency for the exchange rate');

    }

    public function testExchange()
    {
        $this->assertEquals(1.5, $this->currency->exchange(1.5),'exchange rate of 1 with base');
        $this->assertEquals(100, $this->largerCurrency->exchange(50),'exchange rate of 1 with base');
        $this->assertEquals(1.5, $this->currency->exchange(1.5),'exchange rate of 1 with base');

        $this->skipTest('is returning Monetary the right thing to do?');
    }

    public function setUp()
    {
        $this->startTime = new \DateTime('now');
        $this->currency = $this->getCurrency(null, 'VES', 'V', 1, new \DateTime('2010-07-05T06:00:00Z'));
        $this->largerCurrency = $this->getCurrency($this->currency, 'LGR', 'L', 2);
        $this->smallerCurrency = $this->getCurrency($this->currency, 'SML', 'S', .5);
    }

    protected function getCurrency($baseCurrency=null, $code, $symbol, $exchangeRate, $time=null)
    {
        $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
        $rc = new \ReflectionClass($currency);

        if (!$baseCurrency) {
            $baseCurrency = new BaseCurrency();
        }
        $property = $rc->getProperty('baseCurrency');
        $property->setAccessible(true);
        $property->setValue($currency, $baseCurrency);

        $property = $rc->getProperty('code');
        $property->setAccessible(true);
        $property->setValue($currency, $code);

        $property = $rc->getProperty('symbol');
        $property->setAccessible(true);
        $property->setValue($currency, $symbol);

        $property = $rc->getProperty('exchangeRate');
        $property->setAccessible(true);
        $property->setValue($currency, $exchangeRate);

        $property = $rc->getProperty('time');
        $property->setAccessible(true);
        $property->setValue($currency, $time);

        $property = $rc->getProperty('precision');
        $property->setAccessible(true);
        $property->setValue($currency, 2);
    }
}
