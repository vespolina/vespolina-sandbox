<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\CurrencyManagerInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Model\MonetaryManagerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 */
interface MonetaryServiceInterface extends CurrencyManagerInterface, MonetaryManagerInterface
{
  public function __construct();
}
