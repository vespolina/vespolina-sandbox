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

        $currency->expects($this->any())
             ->method('getCurrencyCode')
             ->will($this->returnValue($code));

        $currency->expects($this->any())
             ->method('getName')
             ->will($this->returnValue($name));

        $currency->expects($this->any())
             ->method('getPrecision')
             ->will($this->returnValue($precision));

        $currency->expects($this->any())
             ->method('getShortName')
             ->will($this->returnValue($name));

        $currency->expects($this->any())
             ->method('getSymbol')
             ->will($this->returnValue($symbol));

        return $currency;
    }

    protected function getBaseCurrency()
    {
        return $this->getCurrency('Codes specifically reserved for testing purpose', 'XTS', 'Z');
    }
}