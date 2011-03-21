<?php

namespace Vespolina\MonetaryBundle\Tests\Model;

use Vespolina\MonetaryBundle\Model\Currency;
use Vespolina\MonetaryBundle\Model\BaseCurrency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    protected $exchangeRates = array(
        ''
    );

    public function setUp()
    {
    }

    /**
     * Get the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function testGetCurrencyCode()
    {

    }

    /**
     * Get the symbol for the currency
     *
     * @param string optional locale
     *
     * @return string
     */
    public function testGetSymbol()
    {

    }

    /**
     * Get the default number of fraction digits for the currency
     *
     * @return integer
     */
    public function testGetFractionalDigits()
    {

    }

    /**
     * Return the amount, formatted for the currency
     *
     * @param mixed $amount
     *
     * @return string
     */
    public function testFormatAmount()
    {

    }

    /**
     * Return the exchange rate, based on base currency
     *
     * @return mixed $rate
     */
    public function testGetExchangeRate()
    {

    }

    /**
     * Return the date and time of the exchange rate
     *
     * @return \DateTime
     */
    public function testGetExchangeDateTime()
    {

    }

    /**
     * Return the base currency for the exchange rate
     *
     * @return Vespolina\MonetaryBundle\Model\CurrencyInterface
     */
    public function testGetBaseCurrency()
    {

    }

    /**
     * Return the value after the currency conversion, this can be an instance of
     * Vespolina\MonetaryBundle\Model\MonetaryInterface.  If a Monetary object is passed in as the amount
     * an new instance of Vespolina\MonetaryBundle\Model\MonetaryInterface, with this currency is returned
     *
     * @param mixed $amount
     * @return mixed
     */
    public function testExchange()
    {

    }

    protected function getCurrency($baseCurrency=null, $code, $symbol, $exchangeRate, $time=null)
    {
        $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
        $rc = new \ReflectionClass($currency);

        if (!$baseCurrency) {
            $baseCurrency = new \BaseCurrency();
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

        $time = $time ? new \DateTime('now') : $time;
        $property = $rc->getProperty('time');
        $property->setAccessible(true);
        $property->setValue($currency, $time);
    }
}
