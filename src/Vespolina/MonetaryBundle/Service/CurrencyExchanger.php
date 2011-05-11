<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Service\CurrencyExchangerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
abstract class CurrencyExchanger implements CurrencyExchangerInterface
{
    protected function getCode($currency)
    {
        if ($currency instanceof Vespolina\MonetaryBundle\Model\CurrencyInterface)
        {
            return $currency->getCurrencyCode();
        }
        return strtoupper($currency);
    }
}