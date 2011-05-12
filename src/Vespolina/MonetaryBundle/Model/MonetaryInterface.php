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
     * Divide the monetary instance by a divisor
     *
     * @param mixed $divisor
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
     * Set the monetary value
     *
     * @param $amount
     */
    public function setValue($amount);

    /**
     * Get the value of the monetary amount
     *
     * @return float
     */
    public function getValue();
}