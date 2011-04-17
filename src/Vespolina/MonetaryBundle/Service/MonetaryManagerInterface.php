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
     * Return an instance with the sum of two addends
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2);

    /**
     * Set addend1 to the sum of addend1 and addend2
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend2
     */
    public function addTo(MonetaryInterface $addend1, MonetaryInterface $addend2);

    /**
     * Return an instance with the sum of a set of addends
     *
     * @param array of Vespolina\MonetaryBundle\Model\MonetaryInterface
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function addSet($set);

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
     * Return a monetary quotient for monetary dividend and divisor
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function divide(MonetaryInterface $dividend, $divisor);

    /**
     * Set the monetary dividend to the quotent of itself and a divisor
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $dividend
     * @param mixed $divisor
     */
    public function divideBy(MonetaryInterface $dividend, $divisor);

    /**
     * Exchange an amount against a currency, this is short cut to having to get an instance of a currency
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $monetary
     * @param string ISO 4217 currency code
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     */
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null);


    /**
     * Return the base currency for the functions
     *
     * @return Vespolina\MonetaryBundle\Model\CurrencyInterface
     */
    public function getBaseCurrency();

    /**
     * Return the product of a Monetary multiplicand and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $multiplicand
     * @param $multiplier
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function multiply(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Set the Monetary multiplicand to the product of itself and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $multiplicand
     * @param $multiplier
     */
    public function multiplyBy(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Set the base currency for functions
     *
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $currency
     */
    public function setBaseCurrency(CurrencyInterface $currency);

    /**
     * Return a instance with difference between two Monetary values
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param mixed $subtrahend
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function subtract(MonetaryInterface $minuend, $subtrahend);

    /**
     * Set the minuend with the difference between itself and the subtrahend
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param mixed $subtrahend
     */
    public function subtractFrom(MonetaryInterface $minuend, $subtrahend);
}
