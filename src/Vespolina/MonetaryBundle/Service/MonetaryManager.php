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
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2)
    {
        $baseCurrency = $addend1->getCurrency();
        $addend = $this->exchange($addend2, $baseCurrency);
        $sum = $addend1->getValue() + $addend->getValue();
        return $this->createMonetary($sum, $baseCurrency);
    }

    /**
     * @inheritdoc
     */
    public function addTo(MonetaryInterface $addend1, MonetaryInterface $addend2)
    {

    }

    /**
     * @inheritdoc
     */
    public function addSet($set)
    {

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
    public function divide(MonetaryInterface $dividend, $divisor)
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
    public function divideBy(MonetaryInterface $dividend, $divisor)
    {

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
    public function multiply(MonetaryInterface $multiplicand, $multiplier)
    {

    }

    /**
     * @inheritdoc
     */
    public function multiplyBy(MonetaryInterface $multiplicand, $multiplier)
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
    public function subtract(MonetaryInterface $minuend, $subtrahend)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function subtractFrom(MonetaryInterface $minuend, $subtrahend)
    {

    }

    protected function rounding($amount, $precision)
    {
        $roundUp = '.'.substr('0000000000000005', -($precision+1));
        return bcadd((string)$amount, $roundUp, $precision);
    }
}
