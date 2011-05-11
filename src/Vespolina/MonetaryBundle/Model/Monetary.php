<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class Monetary implements MonetaryInterface
{
    protected $value;
    protected $currency;

    public function __construct($amount, CurrencyInterface $currency)
    {
        $this->value = $amount;
        $this->currency = $currency;
    }

    /**
     * @inheritdoc
     */
    public function divide($divisor)
    {
        $this->value = $this->value / $divisor;
    }

    /**
     * @inheritdoc
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @inheritdoc
     */
    public function multiply($multiplier)
    {
        $this->value = $this->value * $multiplier;
    }

    /**
     * @inheritdoc
     */
    public function setValue($amount)
    {
        $this->value = $amount;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }
}