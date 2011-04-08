<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Service\CurrencyExchanger;
 
class GoogleCurrencyExchanger extends CurrencyExchanger
{
    /**
     * @inheritdoc
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        $from = $this->getCurrency($from);
        $to = $this->getCurrency($to);
        $url = sprintf("http://www.google.com/ig/calculator?hl=en&q=1%s%3D%3F%s", $from, $to);
        $conversion = wget($url);

    }
}