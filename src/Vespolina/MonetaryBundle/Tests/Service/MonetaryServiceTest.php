<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Service;

use Vespolina\MonetaryBundle\Service\MonetaryService;
use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;

class MonetaryServiceTest extends MonetaryTestBase
{
    protected $baseCurrency;
    protected $service;

    public function testGetCurrency()
    {
        $currency = $this->service->getCurrency('MOCK', $this->baseCurrency);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Tests\Document\MOCKCurrency', $currency, 'currency instance, based on another currency and time');
    }

    public function testExchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null)
    {
//        $this->assertEquals(2.835, $this->service->exchange($this->eurMonetary, 'USD'));
    }

    function testGetExchangeRate()
    {
        $usdCurrency = $this->service->getCurrency('MOCK', $this->baseCurrency);
        $this->assertEquals(1.4175, $this->service->getExchangeRate('VES', 'MOCK'), 'get rate with two symbols');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->baseCurrency, 'MOCK'), 'get rate with currency and symbol');
        $this->assertEquals(1.4175, $this->service->getExchangeRate('VES', $usdCurrency), 'get rate with a symbol and a currency');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->baseCurrency, $usdCurrency), 'get rate with two currencies');
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

    protected function setUp()
    {
        $this->service = $this->getMock('Vespolina\MonetaryBundle\Service\MonetaryService');
        $rc = new \ReflectionClass($this->service);
        $property = $rc->getProperty('currencyRoot');
        $property->setAccessible(true);
        $property->setValue($this->service, 'Vespolina\MonetaryBundle\Tests\Document');

        $this->baseCurrency = $this->getBaseCurrency();
    }
}
