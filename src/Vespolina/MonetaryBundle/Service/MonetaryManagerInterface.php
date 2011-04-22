<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface MonetaryManagerInterface
{
    /**
     * construct
     *
     * @param string $monetaryClass
     * @param Vespolina\MonetaryBundle\Service\CurrencyManagerInterface $currencyManager
     * @param mixed $baseCurrency
     */
    public function __construct($monetaryClass, CurrencyManagerInterface $currencyManager, $baseCurrency);

    /**
     * Return a monetary instance of the service base currency with the sum of two addends.
     * The optional third parameter can be used to set the currency of the instance.
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2, CurrencyInterface $baseCurrency = null);

    /**
     * Set addend1 to the sum of addend1 and addend2
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     */
    public function addTo(MonetaryInterface &$addend1, MonetaryInterface $addend2);

    /**
     * Return an instance of the service base currency with the sum of a set of addends
     * The optional third parameter can be used to set the currency of the instance.
     *
     * @param array of Vespolina\MonetaryBundle\Model\MonetaryInterface
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function addSet($set, CurrencyInterface $baseCurrency = null);

    /**
     * Create a monetary instance of a set amount
     * If $baseCurrency is not set, the global base currency will be used
     *
     * @param  $amount
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency optional
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function createMonetary($amount, CurrencyInterface $baseCurrency=null);

    /**
     * Return a monetary quotient of the service base currency for monetary dividend and divisor
     * The optional third parameter can be used to set the currency of the instance.
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function divide(MonetaryInterface $dividend, $divisor, CurrencyInterface $baseCurrency = null);

    /**
     * Set the monetary dividend to the quotent of itself and a divisor
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @param mixed $divisor
     */
    public function divideBy(MonetaryInterface &$dividend, $divisor);

    /**
     * Exchange an amount against a currency, this is short cut to having to get an instance of a currency
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $monetary
     * @param mixed Vespolina\MonetaryBundle\Model\CurrencyInterface or ISO 4217 $currency
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     */
    public function exchange(MonetaryInterface $monetary, $currency, \DateTime $datetime=null);


    /**
     * Return the base currency for the functions
     *
     * @return Vespolina\MonetaryBundle\Model\CurrencyInterface
     */
    public function getBaseCurrency();

    /**
     * Return the product of a Monetary instance of the service base currency multiplicand and multiplier
     * The optional third parameter can be used to set the currency of the instance.
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $multiplicand
     * @param $multiplier
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function multiply(MonetaryInterface $multiplicand, $multiplier, CurrencyInterface $baseCurrency = null);

    /**
     * Set the Monetary multiplicand to the product of itself and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $multiplicand
     * @param $multiplier
     */
    public function multiplyBy(MonetaryInterface &$multiplicand, $multiplier);

    /**
     * Set the base currency for functions
     *
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $currency
     */
    public function setBaseCurrency(CurrencyInterface $currency);

    /**
     * Return a instance  of the service base currency with difference between two Monetary values
     * The optional third parameter can be used to set the currency of the instance.
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend, CurrencyInterface $baseCurrency = null);

    /**
     * Set the minuend with the difference between itself and the subtrahend
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param mixed $subtrahend
     */
    public function subtractFrom(MonetaryInterface &$minuend, MonetaryInterface $subtrahend);
}
