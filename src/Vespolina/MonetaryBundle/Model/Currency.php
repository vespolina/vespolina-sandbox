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
    protected $currencyCode;
    protected $name;
    protected $precision;
    protected $shortName;
    protected $symbol;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getShortName()
    {
        return $this->shortName;
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

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->precision+1));
        return bcadd((string)$amount, $roundUp, $this->precision);
    }
}
