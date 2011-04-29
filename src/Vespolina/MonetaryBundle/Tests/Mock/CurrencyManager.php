<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Mock;

use Vespolina\MonetaryBundle\Model\Currency;
use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Service\CurrencyExchangerInterface;
use Vespolina\MonetaryBundle\Service\CurrencyManagerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class CurrencyManager extends \PHPUnit_Framework_TestCase implements CurrencyManagerInterface
{
    protected $currencyExchanger;

    public function __construct(CurrencyExchangerInterface $currencyExchanger)
    {
        $this->currencyExchanger = $currencyExchanger;
    }

    /**
     * @inheritdoc
     */
    public function createCurrency($currencyCode)
    {
        if ($currencyCode=='XXX') {
            $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
            $rc = new \ReflectionClass($currency);

            $property = $rc->getProperty('name');
            $property->setAccessible(true);
            $property->setValue($currency, 'XXX is normally no currency');

            $property = $rc->getProperty('currencyCode');
            $property->setAccessible(true);
            $property->setValue($currency, 'XXX');

            $property = $rc->getProperty('symbol');
            $property->setAccessible(true);
            $property->setValue($currency, 'X');

            $property = $rc->getProperty('precision');
            $property->setAccessible(true);
            $property->setValue($currency, 2);

            return $currency;
        }
        if ($currencyCode=='XTS') {
            $currency = $this->getMockForAbstractClass('Vespolina\MonetaryBundle\Model\Currency');
            $rc = new \ReflectionClass($currency);

            $property = $rc->getProperty('name');
            $property->setAccessible(true);
            $property->setValue($currency, 'Codes specifically reserved for testing purpose');

            $property = $rc->getProperty('currencyCode');
            $property->setAccessible(true);
            $property->setValue($currency, 'XTS');

            $property = $rc->getProperty('symbol');
            $property->setAccessible(true);
            $property->setValue($currency, 'Z');

            $property = $rc->getProperty('precision');
            $property->setAccessible(true);
            $property->setValue($currency, 2);

            return $currency;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        return $this->currencyExchanger->getExchangeRate($from, $to, $datetime);
    }
}
