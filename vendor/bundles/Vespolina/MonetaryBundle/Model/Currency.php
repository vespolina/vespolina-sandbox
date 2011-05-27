<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Model;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
abstract class Currency implements CurrencyInterface
{
    /**
     * @inheritdoc
     */
    public function formatAmount($amount)
    {
        return sprintf('%s%s', $this->getSymbol(), $this->rounding($amount));
    }

    protected function rounding($amount)
    {
        $roundUp = '.'.substr('0000000000000005', -($this->getPrecision() + 1));
        return bcadd((string)$amount, $roundUp, $this->getPrecision());
    }
}
