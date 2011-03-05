<?php

namespace Bundle\ECommerce\MonetaryBundle\Service;

use Bundle\ECommerce\MonetaryBundle\Model\CurrencyInterface;
use Bundle\ECommerce\MonetaryBundle\Model\CurrencyManagerInterface;
use Bundle\ECommerce\MonetaryBundle\Model\MonetaryInterface;
use Bundle\ECommerce\MonetaryBundle\Model\MonetaryManagerInterface;

interface MonetaryService extends CurrencyManagerInterface, MonetaryManagerInterface
{
  public function __contruct();
}
