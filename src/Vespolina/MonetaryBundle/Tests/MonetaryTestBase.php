<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests;

use Vespolina\MonetaryBundle\Model\BaseCurrency;
use Vespolina\MonetaryBundle\Model\Currency;
use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Service\MonetaryServiceInterface;

class MonetaryTestBase extends \PHPUnit_Framework_TestCase
{
    protected function getCurrency($baseCurrency=null, $code, $symbol, $exchangeRate, $time=null)
    {
        $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
        $rc = new \ReflectionClass($currency);

        if (!$baseCurrency) {
            $baseCurrency = new BaseCurrency();
        }
        $property = $rc->getProperty('baseCurrency');
        $property->setAccessible(true);
        $property->setValue($currency, $baseCurrency);

        $property = $rc->getProperty('currencyCode');
        $property->setAccessible(true);
        $property->setValue($currency, $code);

        $property = $rc->getProperty('symbol');
        $property->setAccessible(true);
        $property->setValue($currency, $symbol);

        $property = $rc->getProperty('exchangeRate');
        $property->setAccessible(true);
        $property->setValue($currency, $exchangeRate);

        if ($time) {
            $property = $rc->getProperty('exchangeDateTime');
            $property->setAccessible(true);
            $property->setValue($currency, $time);
        }

        $property = $rc->getProperty('precision');
        $property->setAccessible(true);
        $property->setValue($currency, 2);

        return $currency;
    }

    protected function getBaseCurrency()
    {
        return $this->getCurrency(null, 'VES', 'V', 1, new \DateTime('2010-07-05T06:00:00'));
    }
}