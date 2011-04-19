<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Service;

use Vespolina\MonetaryBundle\Model\Monetary;
use Vespolina\MonetaryBundle\Service\MonetaryManager;
use Vespolina\MonetaryBundle\Service\CurrencyManager;
use Vespolina\MonetaryBundle\Tests\MonetaryTestBase;
use Vespolina\MonetaryBundle\Tests\Document\CurrencyExchanger;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class MonetaryManagerTest extends MonetaryTestBase
{
    protected $baseCurrency;
    protected $secondCurrency;
    protected $service;

    public function testSetBaseCurrency()
    {
        $baseCurrency = $this->getBaseCurrency();
        $currencyManager = new CurrencyManager(new CurrencyExchanger());

        $monetaryMgr = new MonetaryManager('Vespolina\MonetaryBundle\Model\Monetary', $currencyManager, $this->baseCurrency);
        $this->assertEquals($baseCurrency, $monetaryMgr->getBaseCurrency(), 'base currency set in construct with currency object');

        $monetaryMgr = new MonetaryManager('Vespolina\MonetaryBundle\Model\Monetary', $currencyManager, 'XXX');
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\CurrencyInterface', $monetaryMgr->getBaseCurrency(), 'base currency set in construct with ISO code');
        $this->assertSame('XXX', $monetaryMgr->getBaseCurrency()->getCode(), 'correct code set in construct with ISO code');

        $monetaryMgr->setBaseCurrency($baseCurrency);
        $this->assertSame($baseCurrency, $monetaryMgr->getBaseCurrency(), 'base currency set by method with currency object');

        $monetaryMgr->setBaseCurrency('XXX');
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\CurrencyInterface', $monetaryMgr->getBaseCurrency(), 'base currency set in construct with ISO code');
        $this->assertSame('XXX', $monetaryMgr->getBaseCurrency()->getCode(), 'correct code set in construct with ISO code');
    }

    public function testExchange()
    {
        $monetary1 = new Monetary(1,$this->baseCurrency);

        $monetaryTotal = $this->service->exchange($monetary1, 'XXX');
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(0.71, $monetaryTotal->getValue(), 'exchange currency with ISO');

        $monetaryTotal = $this->service->exchange($monetary1, $this->secondCurrency);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(0.71, $monetaryTotal->getValue(), 'exchange currency with Currency');
    }

    public function testAdd()
    {
        $monetary1 = new Monetary(1,$this->baseCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary1);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(2, $monetaryTotal->getValue(), 'adding same currency correctly');
        $monetary2 = new Monetary(2, $this->secondCurrency);
        $monetaryTotal = $this->service->add($monetary1, $monetary2);
        $this->assertEquals(3.84, $monetaryTotal->getValue(), 'adding different currencies correctly');
    }

    public function testAddTo()
    {
        $monetary1 = new Monetary(1,$this->baseCurrency);
        $this->service->addTo($monetary1, $monetary1);
        $this->assertEquals(2, $monetary1->getValue(), 'adding same currency correctly');
        $monetary2 = new Monetary(2, $this->secondCurrency); // converted value is 2.84
        $this->service->addTo($monetary1, $monetary2);  // monetary1 is 2
        $this->assertEquals(4.84, $monetary1->getValue(), 'adding different currencies correctly');
    }

    public function testAddSet()
    {
        $set = array(
            new Monetary(2, $this->baseCurrency),
            new Monetary(3, $this->baseCurrency),
            new Monetary(4, $this->baseCurrency),
        );
        $monetaryTotal = $this->service->addSet($set);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(9, $monetaryTotal->getValue(), 'adding set of monetaries with same currencies');

        $set = array(
            new Monetary(2, $this->baseCurrency),
            new Monetary(3, $this->secondCurrency), // 3.13
            new Monetary(4, $this->baseCurrency),
        );
        $monetaryTotal = $this->service->addSet($set);
        $this->assertEquals(9, $monetaryTotal->getValue(), 'adding set of monetaries with different currencies');
    }

    public function testDivide()
    {
        $monetary1 = new Monetary(4, $this->baseCurrency);
        $monetaryTotal = $this->service->divide($monetary1, .5);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $this->assertEquals(8, $monetaryTotal->getValue(), 'divide by a float');

        $monetary2 = new Monetary(2, $this->baseCurrency);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $monetaryTotal = $this->service->divide($monetary2, $monetary1);
        $this->assertEquals(2, $monetaryTotal->getValue(), 'divide same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency); // 1.42
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetaryTotal, 'make sure a Monetary class is returned');
        $monetaryTotal = $this->service->divide($monetary1, $monetary3);
        $this->assertEquals(2.82, $monetaryTotal->getValue(), 'divide different currencies');
    }

    public function testDivideBy()
    {
        $monetary1 = new Monetary(4, $this->baseCurrency);
        $this->service->divideBy($monetary1, .5);
        $this->assertEquals(8, $monetary1->getValue(), 'divide by a float');

        $monetary2 = new Monetary(2, $this->baseCurrency);
        $this->service->divideBy($monetary2, $monetary1);
        $this->assertEquals(2, $monetary2->getValue(), 'divide same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency);
        $this->service->divideBy($monetary1, $monetary3);
        $this->assertEquals(2.82, $monetary3->getValue(), 'divide different currencies');
    }

    public function testCreateMonetary()
    {
        $this->service->setBaseCurrency($this->baseCurrency);
        $monetary = $this->service->createMonetary(2);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetary);
        $this->assertSame($this->baseCurrency, $monetary->getCurrency(), 'set to base currency in monetary mgr');

        $monetary = $this->service->createMonetary(4, $this->secondCurrency);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $monetary);
        $this->assertSame($this->secondCurrency, $monetary->getCurrency(), 'set specific currency');
    }

    public function testMultiply()
    {
        $monetary1 = new Monetary(2, $this->baseCurrency);
        $totalMonetary = $this->service->multiply($monetary1, 2);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(4, $totalMonetary->getValue(), 'multiply by a numeric');

        $monetary2 = new Monetary(2, $this->baseCurrency);
        $totalMonetary = $this->service->multiply($monetary2, $monetary1);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(4, $totalMonetary->getValue(), 'multiply by  same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency); // 1.42
        $totalMonetary = $this->service->multiply($monetary1, $monetary3);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(2.82, $totalMonetary->getValue(), 'multiply by different currencies');
    }

    public function testMultiplyBy()
    {
        $monetary1 = new Monetary(2, $this->baseCurrency);
        $this->service->multiplyBy($monetary1, 2);
        $this->assertEquals(4, $monetary1->getValue(), 'multiply by a numeric');

        $monetary2 = new Monetary(2, $this->baseCurrency);
        $this->service->multiplyBy($monetary2, $monetary1);
        $this->assertEquals(4, $monetary2->getValue(), 'multiply by  same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency);
        $this->service->multiplyBy($monetary1, $monetary3);
        $this->assertEquals(2.82, $monetary1->getValue(), 'multiply by different currencies');
    }

    public function testSubtract()
    {
        $monetary1 = new Monetary(8, $this->baseCurrency);
        $totalMonetary = $this->service->subtract($monetary1, 5);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(3, $totalMonetary->getValue(), 'subtract by a numeric');

        $monetary2 = new Monetary(5, $this->baseCurrency);
        $totalMonetary = $this->service->subtract($monetary2, $monetary1);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(3, $totalMonetary->getValue(), 'subtract by same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency); // 1.42
        $totalMonetary = $this->service->subtract($monetary1, $monetary3);
        $this->assertInstanceOf('Vespolina\MonetaryBundle\Model\MonetaryInterface', $totalMonetary);
        $this->assertEquals(6.58, $totalMonetary->getValue(), 'subtract by different currencies');
    }

    public function testSubtractFrom()
    {
        $monetary1 = new Monetary(8, $this->baseCurrency);
        $this->service->subtractFrom($monetary1, 5);
        $this->assertEquals(3, $monetary1->getValue(), 'subtract by a numeric');

        $monetary2 = new Monetary(5, $this->baseCurrency);
        $this->service->subtractFrom($monetary2, $monetary1);
        $this->assertEquals(2, $monetary2->getValue(), 'subtract by same currency');

        $monetary3 = new Monetary(2, $this->secondCurrency);  // 1.42
        $this->service->subtractFrom($monetary1, $monetary3);
        $this->assertEquals(.68, $monetary1->getValue(), 'subtract by different currencies');
    }

    protected function setUp()
    {
        $this->baseCurrency = $this->getBaseCurrency();

        $currencyManager = new CurrencyManager(new CurrencyExchanger());
        $this->service = new MonetaryManager('Vespolina\MonetaryBundle\Model\Monetary', $currencyManager, $this->baseCurrency);

        $this->secondCurrency = $this->getCurrency('The codes assigned for transactions where no name is involve', 'XXX', 'X');
    }
}
