<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface MonetaryInterface
{
    public function __construct($amount, CurrencyInterface $currency);

    /**
     * Add monetary amount to this instance.
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $addend
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
     * @return Vespolina\MonetaryBundle\Model\MonetaryInterface
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
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $subtrahend
     */
    public function subtract(MonetaryInterface $subtrahend);

    /**
     * Get the value of the monetary amount.
     *
     * @param Vespolina\MonetaryBundle\CurrencyInterface
     */
    public function getValue(CurrencyInterface $currency = null);

    /**
     * Set the currency for the monitary value
     *
     * @param Vespolina\MonetaryBundle\CurrencyInterface $currency
     */
    public function setCurrency(CurrencyInterface $currency);

}