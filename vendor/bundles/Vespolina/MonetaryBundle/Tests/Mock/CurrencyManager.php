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

            $currency->expects($this->any())
                 ->method('getCurrencyCode')
                 ->will($this->returnValue('XXX'));

            $currency->expects($this->any())
                 ->method('getName')
                 ->will($this->returnValue('XXX is normally no currency'));

            $currency->expects($this->any())
                 ->method('getPrecision')
                 ->will($this->returnValue(2));

            $currency->expects($this->any())
                 ->method('getShortName')
                 ->will($this->returnValue('XXX'));

            $currency->expects($this->any())
                 ->method('getSymbol')
                 ->will($this->returnValue('X'));

            return $currency;
        }
        if ($currencyCode=='XTS') {

            $currency->expects($this->any())
                 ->method('getCurrencyCode')
                 ->will($this->returnValue('XTS'));

            $currency->expects($this->any())
                 ->method('getName')
                 ->will($this->returnValue('Codes specifically reserved for testing purpose'));

            $currency->expects($this->any())
                 ->method('getPrecision')
                 ->will($this->returnValue(2));

            $currency->expects($this->any())
                 ->method('getShortName')
                 ->will($this->returnValue('XTS'));

            $currency->expects($this->any())
                 ->method('getSymbol')
                 ->will($this->returnValue('Z'));

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
