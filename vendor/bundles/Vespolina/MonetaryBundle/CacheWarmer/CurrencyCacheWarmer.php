<?php

/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\MonetaryBundle\CacheWarmer;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * The currency generator cache warmer generates currencies.
 *
 * @author Benjamin Eberlei <kontakt@beberlei.de>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author Richard Shank <develop@zestic.com>
 */
class CurrencyCacheWarmer implements CacheWarmerInterface
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * This cache warmer is not optional.
     *
     * @return false
     */
    public function isOptional()
    {
        return false;
    }

    public function warmUp($cacheDir)
    {
        // we need the directory no matter the currency cache generation strategy.
        $currencyCacheDir = $this->container->getParameter('vespolina.monetary.currency_dir');
        if (!file_exists($currencyCacheDir)) {
            if (false === @mkdir($currencyCacheDir, 0777, true)) {
                throw new \RuntimeException(sprintf('Unable to create the Vespolina Currency directory (%s)', dirname($currencyCacheDir)));
            }
        } else if (!is_writable($currencyCacheDir)) {
            throw new \RuntimeException(sprintf('Vespolina Currency directory (%s) is not writeable for the current system user.', $currencyCacheDir));
        }
    }
}