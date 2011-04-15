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
    public function __construct($amount, CurrencyInterface $currency)
    {

    }

    /**
     * @inheritdoc
     */
    public function divide($divisor)
    {

    }

    /**
     * @inheritdoc
     */
    public function getCurrency()
    {
        
    }

    /**
     * @inheritdoc
     */
    public function multiply($multiplier)
    {

    }

    /**
     * @inheritdoc
     */
    public function setValue($amount)
    {

    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {

    }
}