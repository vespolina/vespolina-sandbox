<?php

namespace Vespolina\MonetaryBundle\Tests\Document;

use Vespolina\MonetaryBundle\Model\Currency;

class MOCKCurrency extends Currency
{
    protected $currencyCode = 'MOCK';
    protected $precision = 2;
    protected $symbol = 'M';

}
