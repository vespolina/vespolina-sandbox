<?php

namespace Bundle\ECommerce\MonetaryBundle\Model;

use Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface;

interface MonetaryInterface
{
    public function __construct($amount, CurrencyInterface $currency);

    /**
     * Add monetary amount to this instance.
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $addend
     */
    public function add(MonetaryInterface $addend);

    /**
     * Divide the monetary instance by a divisor
     *
     * @parma mixed $divisor
     */
    public function divide($divisor);

    /**
     * Get the currency of the monetary amount.
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface
     */
    public function getCurrency();

    /**
     * Set the the monetary instance by a multiplier
     *
     * @param $multiplier
     */
    public function multiply($multiplier);

    /**
     * Set the monitary value
     *
     * @param $amount
     */
    public function setValue($amount);

    /**
     * Subtract a monetary $subtrahend from this instance.
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $subtrahend
     */
    public function subtract(MonetaryInterface $subtrahend);

    /**
     * Get the value of the monetary amount.
     *
     * @param Bundle\ECommerce\MonetaryBundle\CurrencyInterface
     */
    public function getValue(CurrencyInterface $currency = null);

    /**
     * Set the currency for the monitary value
     *
     * @param Bundle\ECommerce\MonetaryBundle\CurrencyInterface $currency
     */
    public function setCurrency(CurrencyInterface $currency);

}