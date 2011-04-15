<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests;

use Vespolina\MonetaryBundle\Model\Currency;
use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Service\MonetaryManagerInterface;

class MonetaryTestBase extends \PHPUnit_Framework_TestCase
{
    protected function getCurrency($name, $code, $symbol, $precision=2)
    {
        $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
        $rc = new \ReflectionClass($currency);

        $property = $rc->getProperty('name');
        $property->setAccessible(true);
        $property->setValue($currency, $name);

        $property = $rc->getProperty('currencyCode');
        $property->setAccessible(true);
        $property->setValue($currency, $code);

        $property = $rc->getProperty('symbol');
        $property->setAccessible(true);
        $property->setValue($currency, $symbol);

        $property = $rc->getProperty('precision');
        $property->setAccessible(true);
        $property->setValue($currency, $precision);

        return $currency;
    }

    protected function getBaseCurrency()
    {
        return $this->getCurrency('Codes specifically reserved for testing purpose', 'XTS', 'Z');
    }
}