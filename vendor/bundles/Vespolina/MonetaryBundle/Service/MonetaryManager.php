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
use Vespolina\MonetaryBundle\Service\CurrencyManagerInterface;
use Vespolina\MonetaryBundle\Service\MonetaryManagerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class MonetaryManager implements MonetaryManagerInterface
{
    protected $baseCurrency;
    protected $currencyManager;
    protected $monetaryClass;
    
    /**
     * construct
     *
     * @param string $monetaryClass
     * @param Vespolina\MonetaryBundle\Service\CurrencyManagerInterface $currencyManager
     * @param mixed $baseCurrency
     */
    public function __construct($monetaryClass, CurrencyManagerInterface $currencyManager, $baseCurrency)
    {
        $this->monetaryClass = $monetaryClass;
        $this->currencyManager = $currencyManager;
        $this->setBaseCurrency($baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2, CurrencyInterface $baseCurrency = null)
    {
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        $addend1 = $this->exchange($addend1, $baseCurrency);
        $addend2 = $this->exchange($addend2, $baseCurrency);
        $sum = bcadd($addend1->getValue(), $addend2->getValue(), $baseCurrency->getPrecision());
        return $this->createMonetary($sum, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function addTo(MonetaryInterface &$addend1, MonetaryInterface $addend2)
    {
        $baseCurrency = $addend1->getCurrency();
        $addend2 = $this->exchange($addend2, $baseCurrency);
        $sum = bcadd($addend1->getValue(), $addend2->getValue(), $baseCurrency->getPrecision());
        $addend1->setValue($sum);
    }

    /**
     * @inheritdoc
     */
    public function addSet($set, CurrencyInterface $baseCurrency = null)
    {
        $total = 0;
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        foreach ($set as $monetary) {
            $monetary = $this->exchange($monetary, $baseCurrency);
            $value = $monetary->getValue();
            $total = bcadd($total, $value, $baseCurrency->getPrecision());
        }
        return $this->createMonetary($total, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function createMonetary($amount, CurrencyInterface $baseCurrency=null)
    {
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        return new $this->monetaryClass($amount, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function divide(MonetaryInterface $dividend, $divisor, CurrencyInterface $baseCurrency = null)
    {
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        $dividend = $this->exchange($dividend, $baseCurrency);
        $quotient = bcdiv($dividend->getValue(), $divisor, $baseCurrency->getPrecision());
        return $this->createMonetary($quotient, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function divideBy(MonetaryInterface &$dividend, $divisor)
    {
        $baseCurrency = $dividend->getCurrency();
        $quotient = bcdiv($dividend->getValue(), $divisor, $baseCurrency->getPrecision());
        $dividend->setValue($quotient);
    }

    /**
     * {@inheritdoc}
     */
    public function exchange(MonetaryInterface $monetary, $currency, \DateTime $datetime=null)
    {
        $baseCurrency = $monetary->getCurrency();
        $exchangeRate = $this->currencyManager->getExchangeRate($baseCurrency, $currency);
        $value = (float)$this->rounding(bcmul((string)$monetary->getValue(),(string)$exchangeRate, 16),
                                        $baseCurrency->getPrecision());
        return $this->createMonetary($value, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @inheritdoc
     */
    public function multiply(MonetaryInterface $multiplicand, $multiplier, CurrencyInterface $baseCurrency = null)
    {
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        $multiplicand = $this->exchange($multiplicand, $baseCurrency);
        $result = bcmul($multiplicand->getValue(), $multiplier, $baseCurrency->getPrecision());
        return $this->createMonetary($result, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function multiplyBy(MonetaryInterface &$multiplicand, $multiplier)
    {
        $baseCurrency = $multiplicand->getCurrency();
        $result = bcmul($multiplicand->getValue(), $multiplier, $baseCurrency->getPrecision());
        $multiplicand->setValue($result);
    }

    /**
     * @inheritdoc
     */
    public function setBaseCurrency($currency)
    {
        if (is_string($currency)) {
            $this->baseCurrency = $this->currencyManager->createCurrency($currency);
        } else {
            $this->baseCurrency = $currency;
        }
    }

    /**
     * @inheritdoc
     */
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend, CurrencyInterface $baseCurrency = null)
    {
        $baseCurrency = $baseCurrency ? $baseCurrency : $this->baseCurrency;
        $minuend = $this->exchange($minuend, $baseCurrency);
        $subtrahend = $this->exchange($subtrahend, $baseCurrency);
        $difference = bcsub($minuend->getValue(), $subtrahend->getValue(), $baseCurrency->getPrecision());
        return $this->createMonetary($difference, $baseCurrency);
    }

    /**
     * {@inheritdoc}
     */
    public function subtractFrom(MonetaryInterface &$minuend, MonetaryInterface $subtrahend)
    {
        $baseCurrency = $minuend->getCurrency();
        $subtrahend = $this->exchange($subtrahend, $baseCurrency);
        $difference = bcsub($minuend->getValue(), $subtrahend->getValue(), $baseCurrency->getPrecision());
        $minuend->setValue($difference);
    }

    protected function rounding($amount, $precision)
    {
        $roundUp = '.'.substr('0000000000000005', -($precision+1));
        return bcadd((string)$amount, $roundUp, $precision);
    }
}
