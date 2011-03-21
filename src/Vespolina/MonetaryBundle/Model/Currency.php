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

    }

    /**
     * @inheritdoc
     */
    public function getSymbol()
    {

    }

    /**
     * @inheritdoc
     */
    public function getPrecision()
    {

    }

    /**
     * @inheritdoc
     */
    public function formatAmount($amount)
    {

    }

    /**
     * @inheritdoc
     */
    public function getExchangeRate()
    {

    }

    /**
     * @inheritdoc
     */
    public function getExchangeDateTime()
    {

    }

    /**
     * @inheritdoc
     */
    public function getBaseCurrency()
    {

    }

    /**
     * @inheritdoc
     */
    public function exchange($amount)
    {

    }
}
