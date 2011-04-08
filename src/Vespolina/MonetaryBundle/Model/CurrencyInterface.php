<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Model;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface CurrencyInterface
{
    /**
     * The date and time of now should be set by default
     */
    public function __construct();

    /**
     * Return the name of the currency
     */
    public function getName();

    /**
     * Return the short name of the currency
     */
    public function getShortName();

    /**
     * Get the ISO 4217 currency code of this currency.
     *
     * @return string
     */
    public function getCurrencyCode();

    /**
     * Get the symbol for the currency
     *
     * @return string
     */
    public function getSymbol();

    /**
     * Get the default number of precision digits for the currency
     *
     * @return integer
     */
    public function getPrecision();

    /**
     * Return the amount, formatted for the currency
     *
     * @param mixed $amount
     *
     * @return string
     */
    public function formatAmount($amount);
}
