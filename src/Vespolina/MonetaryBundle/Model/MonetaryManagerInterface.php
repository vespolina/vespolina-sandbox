<?php

namespace Bundle\ECommerce\MonetaryBundle\Model;

use Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface;
use Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface;

interface MonetaryManagerInterface
{

    /**
     * Return an instance with the sum of two addends
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $addend2
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2);

    /**
     * Set addend1 to the sum of addend1 and addend2
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $addend1
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $addend2
     */
    public function addTo(MonetaryInterface $addend1, MonetaryInterface $addend2);

    /**
     * Return an instance with the sum of a set of addends
     *
     * @param array of Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function addSet($set);

    /**
     * Return a monetary quotent for monetary dividend and divisor
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function divide(MonetaryInterface $dividend, $divisor);


    /**
     * Set the monetary dividend to the quotent of itself and a divisor
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $dividend
     * @parma mixed $divisor
     */
    public function divideBy(MonetaryInterface $dividend, $divisor);

    /**
     * Retrieve an monetary instance of a set amount
     * If $baseCurrency is not set, the global base currency will be used
     *  
     * @param  $amount
     * @param Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface $baseCurrency optional
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function getMonetary($amount, Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface $baseCurrency=null );

    /**
     * Return the product of a Monetary multiplicand and multiplier
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function multiply(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Set the Monetary multiplicand to the product of itself and multiplier
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface multiplicand
     * @param $multiplier
     */
    public function multiplyBy(MonetaryInterface $multiplicand, $multiplier);

    /**
     * Return a instance with difference between two Monetary values
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $subtrahend
     */
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend);

    /**
     * Set the minuend with the difference between itself and the subtrahend
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $minuend
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $subtrahend
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function subtractFrom(MonetaryInterface $minuend, MonetaryInterface $subtrahend);
}
