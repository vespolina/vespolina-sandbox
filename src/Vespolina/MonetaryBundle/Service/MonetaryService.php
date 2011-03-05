<?php

namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Service\MonetaryServiceInterface;

class MonetaryService implements MonetaryServiceInterface
{
    public function __construct()
    {
      
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
    public function getCurrency($currencyCode, CurrencyInterface $currency, \DateTime $datetime=null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function exchange(MonetaryInterface $monetary, $currencyCode, \DateTime $datetime=null)
    {

    }
}
