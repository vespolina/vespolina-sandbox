<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Service\CurrencyManagerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class CurrencyManager implements CurrencyManagerInterface
{
    protected $currencyExchanger;

    public function __construct(CurrencyExchangerInterface $currencyExchanger)
    {
        $this->currencyExchanger = $currencyExchanger;
    }

    /**
     * @inheritdoc
     */
    public function getCurrency($currencyCode)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        return $this->currencyExchanger->getExchangeRate($from, $to, $datetime);
    }
}
