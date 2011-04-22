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
        $sum = bcadd((string)$addend1->getValue(), (string)$addend2->getValue(), $baseCurrency->getPrecision());
        return $this->createMonetary($sum, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function addTo(MonetaryInterface &$addend1, MonetaryInterface $addend2)
    {
        $baseCurrency = $addend1->getCurrency();
        $addend2 = $this->exchange($addend2, $baseCurrency);
        $sum = bcadd((string)$addend1->getValue(), (string)$addend2->getValue(), $baseCurrency->getPrecision());
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
            $total += $value;
        }
        return $this->createMonetary($total, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function createMonetary($amount, CurrencyInterface $baseCurrency=null )
    {
        return new $this->monetaryClass($amount, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function divide(MonetaryInterface $dividend, $divisor, CurrencyInterface $baseCurrency = null)
    {

    }

    /**
     * @inheritdoc
     */
    public function divideBy(MonetaryInterface &$dividend, $divisor)
    {

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

    }

    /**
     * @inheritdoc
     */
    public function multiplyBy(MonetaryInterface &$multiplicand, $multiplier)
    {

    }

    /**
     * @inheritdoc
     */
    public function setBaseCurrency(CurrencyInterface $currency)
    {
        $rc = new \ReflectionClass($currency);
        if ($rc->implementsInterface('Vespolina\MonetaryBundle\Model\CurrencyInterface')) {
            $this->baseCurrency = $currency;
        } else {
            $this->baseCurrency = $this->currencyManager->createCurrency($currency);
        }
    }

    /**
     * @inheritdoc
     */
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend, CurrencyInterface $baseCurrency = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function subtractFrom(MonetaryInterface &$minuend, MonetaryInterface $subtrahend)
    {

    }

    protected function rounding($amount, $precision)
    {
        $roundUp = '.'.substr('0000000000000005', -($precision+1));
        return bcadd((string)$amount, $roundUp, $precision);
    }
}
