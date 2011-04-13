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
    public function __construct(CurrencyManagerInterface $currencyManager)
    {
        $this->currencyManager = $currencyManager;
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
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null)
    {
        $exchangeRate = $this->currencyManager->getExchangeRate($monetary->getCurrency, $currencyCode);
        return (float)$this->rounding(bcmul((string)$monetary->getValue(),(string)$exchangeRate, 16));
    }

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->precision+1));
        return bcadd((string)$amount, $roundUp, $this->precision);
    }
}
