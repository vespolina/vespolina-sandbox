<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Tests\Document;

use Vespolina\MonetaryBundle\Service\CurrencyExchangerInterface;

class CurrencyExchanger implements CurrencyExchangerInterface
{
    protected $exchangeRate = array(
        'VES' => array('MOCK' => 1.4175),
        'MOCK' => array('VES' => 0.705467372),
    );

    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        return $this->exchangeRate[$from][$to];
    }
}