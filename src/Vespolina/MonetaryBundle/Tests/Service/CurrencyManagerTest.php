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
use Vespolina\MonetaryBundle\Tests\Mock\CurrencyExchanger;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class CurrencyManagerTest extends MonetaryTestBase
{
    protected $baseCurrency;
    protected $service;

    public function testGetCurrency()
    {
        $currency = $this->service->createCurrency('XTS');
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\CurrencyInterface', $currency, 'currency instance');
        $this->assertSame('XTS', $currency->getCurrencyCode(), 'make sure the data was loaded correctly');
    }

    function testGetExchangeRate()
    {
        $xxxCurrency = $this->service->createCurrency('XXX');
        $this->assertEquals(0.705467372, $this->service->getExchangeRate('XTS', 'XXX'), 'get rate with two symbols');
        $this->assertEquals(0.705467372, $this->service->getExchangeRate($this->baseCurrency, 'XXX'), 'get rate with currency and symbol');
        $this->assertEquals(0.705467372, $this->service->getExchangeRate('XTS', $xxxCurrency), 'get rate with a symbol and a currency');
        $this->assertEquals(0.705467372, $this->service->getExchangeRate($this->baseCurrency, $xxxCurrency), 'get rate with two currencies');
    }
    
    protected function setUp()
    {
        $this->client = $this->createClient();
        $cacheDir = $this->kernel->getContainer()->getParameter('vespolina.monetary.currency_dir');
        $this->service = new CurrencyManager(new CurrencyExchanger(), $cacheDir);

        $this->baseCurrency = $this->getBaseCurrency();
    }
}
