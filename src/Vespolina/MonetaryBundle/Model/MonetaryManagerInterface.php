<?php

namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Model\CurrencyInterface;

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
     * Return a monetary quotent for monetary dividend and divisor
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
     * @parma mixed $divisor
     */
    public function divideBy(MonetaryInterface $dividend, $divisor);

    /**
     * Retrieve an monetary instance of a set amount
     * If $baseCurrency is not set, the global base currency will be used
     *  
     * @param  $amount
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency optional
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function getMonetary($amount, CurrencyInterface $baseCurrency=null );

    /**
     * Return the product of a Monetary multiplicand and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function multiply(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Set the Monetary multiplicand to the product of itself and multiplier
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     */
    public function multiplyBy(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Return a instance with difference between two Monetary values
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     */
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend);

    /**
     * Set the minuend with the difference between itself and the subtrahend
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     *
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
     */
    public function subtractFrom(MonetaryInterface $minuend, MonetaryInterface $subtrahend);
}
