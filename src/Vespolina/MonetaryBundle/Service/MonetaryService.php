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
use Vespolina\MonetaryBundle\Model\CurrencyExchangerInterface;
use Vespolina\MonetaryBundle\Service\MonetaryServiceInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class MonetaryService implements MonetaryServiceInterface
{
    protected $currencyRoot = "Vespolina\MonetaryBundle\Currency";
    protected $currencyExchanger;

    public function __construct(CurrencyExchangerInterface $currencyExchanger)
    {
        $this->currencyExchanger = $currencyExchanger;
    }

    /**
     * @inheritdoc
     */
    public function add(MonetaryInterface $addend1, MonetaryInterface $addend2)
    {

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
    public function divide(MonetaryInterface $dividend, $divisor)
    {

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
    public function getMonetary($amount, CurrencyInterface $baseCurrency=null )
    {

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
    public function subtract(MonetaryInterface $minuend, MonetaryInterface $subtrahend)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function subtractFrom(MonetaryInterface $minuend, MonetaryInterface $subtrahend)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getCurrency($currencyCode)
    {
        $class = $this->getCurrencyClassName($currencyCode);
        return new $class();
    }

    /**
     * {@inheritdoc}
     */
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null)
    {
        return (float)$this->rounding(bcmul((string)$monetary->getValue(),(string)$this->exchangeRate, 16));
    }

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->precision+1));
        return bcadd((string)$amount, $roundUp, $this->precision);
    }

    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        return $this->currencyExchanger->getExchangeRate($from, $to, $datetime);
    }

    protected function getCurrencyClassName($currencyCode)
    {
        // todo: expand this to allow user defined currencies in configuration
        return sprintf("%s\%sCurrency", $this->currencyRoot, $currencyCode);
    }
}
