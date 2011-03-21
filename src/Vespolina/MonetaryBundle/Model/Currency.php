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
abstract class Currency implements CurrencyInterface
{
    protected $baseCurrency;
    protected $currencyCode;
    protected $exchangeRate;
    protected $exchangeDateTime;
    protected $precision;
    protected $symbol;

    public function __construct()
    {
        $this->exchangeDateTime = new \DateTime('now');
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @inheritdoc
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @inheritdoc
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @inheritdoc
     */
    public function formatAmount($amount)
    {
        return sprintf('%s%s', $this->symbol, $this->rounding($amount));
    }

    /**
     * @inheritdoc
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @inheritdoc
     */
    public function getExchangeDateTime()
    {
        return $this->exchangeDateTime;
    }

    /**
     * @inheritdoc
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency->getCurrencyCode() == 'VESPOLINA_BASE_CURRENCY' ? null : $this->baseCurrency;
    }

    /**
     * @inheritdoc
     */
    public function exchange($amount)
    {
        return (float)$this->rounding(bcmul((string)$amount,(string)$this->exchangeRate, 16));
    }

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->precision+1));
        return bcadd((string)$amount, $roundUp, $this->precision);
    }
}
