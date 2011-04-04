<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;

interface CurrencyExchangerInterface
{
    /**
     * Get the exchange rate from on currency to another.  $from and $to can be an
     * ISO 4217 currency code or a Currency object
     * 
     * @param  mixed $from string | Vespolina\MonetaryBundle\Model\CurrencyInterface
     * @param  mixed $to string | Vespolina\MonetaryBundle\Model\CurrencyInterface
     * @return float
     */
    public function getExchangeRate($from, $to);
}
