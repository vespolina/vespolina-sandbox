<?php

namespace Bundle\ECommerce\MonetaryBundle\Model;

use Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface;
use Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface;

interface CurrencyManagerInterface
{
    /**
     * Get currency instance, based on another currency and time
     *
     * @param string ISO 4217 currency code
     * @param Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface $baseCurrency
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     *
     * @return Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface
     */
    public function getCurrency($currencyCode, Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface $currency, \DateTime $datetime=null);

    /**
     * Exchange an amount against a currency, this is short cut to having to get an instance of a currency
     *
     * @param Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $monetary
     * @param string ISO 4217 currency code
     * @param DateTime $datetime optional date and time of exchange rate, defaults to now
     */
    public function exchange(Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null);
}
