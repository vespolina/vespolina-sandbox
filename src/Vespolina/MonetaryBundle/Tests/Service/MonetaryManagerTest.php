<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Service;

use Vespolina\MonetaryBundle\Model\Monetary;
use Vespolina\MonetaryBundle\Service\MonetaryManager;
use Vespolina\MonetaryBundle\Service\CurrencyManager;
use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;
use Vespolina\MonetaryBundle\Tests\Document\CurrencyExchanger;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class MonetaryManagerTest extends MonetaryTestBase
{
    protected $baseCurrency;
    protected $secondCurrency;
    protected $service;

    public function testExchange()
    {
        // $->exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null);
//        $this->assertEquals(2.835, $this->service->exchange($this->eurMonetary, 'USD'));
    }

    public function testAdd()
    {
        $monetary1 = new Monetary(1,$this->baseCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary1);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(2, $monetaryTotal->getValue(), 'adding same currency correctly');
        $monetary2 = new Monetary(2, $this->secondCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary2);
        $this->assertEquals(2, $monetaryTotal->getValue(), 'adding different currencies correctly');
    }

    public function testAddTo()
    {
        $monetary1 = new Monetary(1,$this->baseCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary1);
        $this->assertEquals(2, $monetary1->getValue(), 'adding same currency correctly');
        $monetary2 = new Monetary(2, $this->secondCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary2);  // monetary1 is 2
        $this->assertEquals(2, $monetary1->getValue(), 'adding different currencies correctly');
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
        $currencyManager = new CurrencyManager(new CurrencyExchanger());
        $this->service = new MonetaryManager($currencyManager);

        $this->baseCurrency = $this->getBaseCurrency();
        $this->secondCurrency = $this->getCurrency('The codes assigned for transactions where no name is involve', 'XXX', 'X', 0);
    }
}
