<?php

namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\CurrencyManagerInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Model\MonetaryManagerInterface;

interface MonetaryServiceInterface extends CurrencyManagerInterface, MonetaryManagerInterface
{
  public function __construct();
}
