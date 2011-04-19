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
        'XXX' => array('XTS' => 1.4175),
        'XTS' => array('XXX' => 0.705467372),
    );

    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        if (is_object($from)) {
            $from = $from->getCurrencyCode();
        }
        if (is_object($to)) {
            $to = $to->getCurrencyCode();
        }
        if ($from == $to) {
            return 1;
        }
        return $this->exchangeRate[$from][$to];
    }
}