<?php

namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;

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
    public function getCurrency($currencyCode, CurrencyInterface $currency, \DateTime $datetime=null);

    /**
     * Exchange an amount against a currency, this is short cut to having to get an instance of a currency
     *
     * @param Vespolina\MonetaryBundle\Model\MonetaryInterface $monetary
     * @param string ISO 4217 currency code
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     */
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null);
}
