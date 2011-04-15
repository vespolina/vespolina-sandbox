<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Service;

use Vespolina\MonetaryBundle\Service\CurrencyManager;
use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;
use Vespolina\MonetaryBundle\Tests\Document\CurrencyExchanger;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class CurrencyManagerTest extends MonetaryTestBase
{
    protected $baseCurrency;
    protected $service;

    public function testGetCurrency()
    {
        $currency = $this->service->getCurrency('XTS');
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Document\Currency', $currency, 'currency instance');
        $this->assertSame('XTS', $currency->getCurrencyCode(), 'make sure the data was loaded correctly');
    }

    function testGetExchangeRate()
    {
        $usdCurrency = $this->service->getCurrency('XXX');
        $this->assertEquals(1.4175, $this->service->getExchangeRate('XTS', 'XXX'), 'get rate with two symbols');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->baseCurrency, 'XXX'), 'get rate with currency and symbol');
        $this->assertEquals(1.4175, $this->service->getExchangeRate('XTS', $usdCurrency), 'get rate with a symbol and a currency');
        $this->assertEquals(1.4175, $this->service->getExchangeRate($this->baseCurrency, $usdCurrency), 'get rate with two currencies');
    }
    
    protected function setUp()
    {
        $this->service = new CurrencyManager(new CurrencyExchanger());

        $this->baseCurrency = $this->getBaseCurrency();
    }
}
