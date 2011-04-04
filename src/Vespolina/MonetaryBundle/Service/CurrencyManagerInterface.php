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
interface CurrencyManagerInterface
{
    /**
     * Get currency instance, based on another currency and time
     *
     * @param string ISO 4217 currency code
     * @param Vespolina\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     *
     * @return Vespolina\MonetaryBundle\Model\CurrencyInterface
     */
    public function getCurrency($currencyCode, CurrencyInterface $baseCurrency, \DateTime $datetime=null);

    /**
     * Exchange an amount against a currency, this is short cut to having to get an instance of a currency
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $monetary
     * @param string ISO 4217 currency code
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     */
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null);

    /**
     * Get the exchange rate between the base currency and the desired currency
     *
     * @param  mixed $baseCurrency
     * @param  mixed $currency
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     * @return rate
     */
    function getExchangeRate($baseCurrency, $currency, \DateTime $datetime=null);
}
