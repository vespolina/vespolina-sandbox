<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\Currency;

/**
 * @author Richard Shank <develop@zestic.com>
 */
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
