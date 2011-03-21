<?php

namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\Currency;

class BaseCurrency extends Currency
{
    protected $currencyCode = 'VESPOLINA_BASE_CURRENCY';
    protected $symbol = '';
    protected $precision = 0;  // its always 1.0
    protected $exchangeRate = 1;

    /**
     * @inheritdoc
     */
    public function formatAmount($amount)
    {
        return $amount;
    }

    /**
     * @inheritdoc
     */
    public function getBaseCurrency()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function exchange($amount)
    {
        return $amount;
    }
}
