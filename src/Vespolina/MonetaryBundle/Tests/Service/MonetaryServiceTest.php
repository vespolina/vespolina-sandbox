<?php

namespace Vespolina\MonetaryBundle\Tests\Service;

use Vespolina\MonetaryBundle\Service\MonetaryService;

class MonetaryServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $eurCurrency;
    protected $exchangeRate = array(
        'EUR' => array('USD' => 1.4175),
    );
    protected $service;

    public function testGetCurrency()
    {
        $currency = $this->service->getCurrency('USD', $this->eurCurrency);
        $this->assertIsInstanceOf('USDCurrency', $currency, 'currency instance, based on another currency and time');
    }

    public function testExchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null)
    {
//        $this->assertEquals(2.835, $this->service->exchange($this->eurMonetary, 'USD'));
    }

    function testGetExchangeRate()
    {
        $usdCurrency = $this->service->getCurrency('USD', $this->eurCurrency);
        $this->assertEquals(1.4175, $this->service->getExchangeRate('EUR', 'USD'), 'get rate with two symbols');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->eurCurrency, 'USD'), 'get rate with currency and symbol');
        $this->assertEquals(1.4175, $this->service->getExchangeRate('EUR', $usdCurrency), 'get rate with a symbol and a currency');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->eurCurrency, $usdCurrency), 'get rate with two currencies');
    }

        /**
     * Return an instance with the sum of two addends
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testAdd(MonetaryInterface $addend1, MonetaryInterface $addend2)
    {

    }

    /**
     * Set addend1 to the sum of addend1 and addend2
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     */
    public function testAddTo(MonetaryInterface $addend1, MonetaryInterface $addend2)
    {

    }

    /**
     * Return an instance with the sum of a set of addends
     *
     * @param array of Vespolina\MonetaryBundle\Model\MonetaryInterface
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testAddSet($set)
    {

    }

    /**
     * Return a monetary quotent for monetary dividend and divisor
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testDivide(MonetaryInterface $dividend, $divisor)
    {

    }


    /**
     * Set the monetary dividend to the quotent of itself and a divisor
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     */
    public function testDivideBy(MonetaryInterface $dividend, $divisor)
    {

    }

    /**
     * Retrieve an monetary instance of a set amount
     * If $baseCurrency is not set, the global base currency will be used
     *
     * @param  $amount
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency optional
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testGetMonetary($amount, CurrencyInterface $baseCurrency=null)
    {

    }

    /**
     * Return the product of a Monetary multiplicand and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testMultiply(MonetaryInterface $multiplicand, $multiplier)
    {

    }

    /**
     * Set the Monetary multiplicand to the product of itself and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     */
    public function testMultiplyBy(MonetaryInterface $multiplicand, $multiplier)
    {

    }

    /**
     * Return a instance with difference between two Monetary values
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     */
    public function testSubtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend)
    {

    }

    /**
     * Set the minuend with the difference between itself and the subtrahend
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function testSubtractFrom(MonetaryInterface $minuend, MonetaryInterface $subtrahend)
    {

    }
    
    public function setUp()
    {
        $this->service = $this->getMock('MonetaryService');
    }

}
