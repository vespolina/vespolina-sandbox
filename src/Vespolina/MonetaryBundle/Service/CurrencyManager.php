<?php
/**
 * (c) 2011 Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vespolina\MonetaryBundle\Service;

use Vespolina\MonetaryBundle\Model\CurrencyInterface;
use Vespolina\MonetaryBundle\Model\MonetaryInterface;
use Vespolina\MonetaryBundle\Service\CurrencyManagerInterface;

/**
 * @author Richard Shank <develop@zestic.com>
 * @author  Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class CurrencyManager implements CurrencyManagerInterface
{
    protected $autoReload;
    protected $cache;
    protected $currencyExchanger;
    protected $debug;
    protected $loadedCurrencies;

    /**
     * Constructor.
     *
     * Available options:
     *
     *  * debug: When set to `true`, the generated templates have a __toString()
     *           method that you can use to display the generated nodes (default to
     *           false).
     *
     *  * auto_reload: Whether to reload the template is the original source changed.
     *                 If you don't provide the auto_reload option, it will be
     *                 determined automatically base on the debug value.
     *
     * @param CurrencyExchangerInterface   $currencyExchanger  A CurrencyExchangerInterface instance
     * @param $cache An absolute path where to store the compiled templates
     * @param array                  $options An array of options
     */
    public function __construct(CurrencyExchangerInterface $currencyExchanger, $cache, $options = array())
    {
        $this->currencyExchanger  = $currencyExchanger;
        $this->cache              = $cache;

        $options = array_merge(array(
            'debug'               => false,
            'auto_reload'         => null,
        ), $options);

        $this->debug              = (bool) $options['debug'];
        $this->autoReload         = null === $options['auto_reload'] ? $this->debug : (bool) $options['auto_reload'];
    }

    /**
     * @inheritdoc
     */
    public function createCurrency($currencyCode)
    {
        $cls = $currencyCode.'Currency';

        if (isset($this->loadedCurrencies[$cls])) {
            return $this->loadedCurrencies[$cls];
        }

        if (!class_exists($cls, false)) {
            $cache = $this->getCacheFilename($cls);
                if (!file_exists($cache) || ($this->autoReload && !$this->isFresh($cls, filemtime($cache)))) {
                    $this->writeCacheFile($cache, $this->getCurrencyClass($this->getCurrencyData($currencyCode)));

            }
            require $cache;
        }

        $currencyClass = 'Currencies\\' . $cls;
        $currency = $this->loadedCurrencies[$cls] = new $currencyClass();
        return $currency;
    }

    /**
     * Gets the cache directory or false if cache is disabled.
     *
     * @return string|false
     */
    public function getCache()
    {
        return $this->cache;
    }

     /**
      * Sets the cache directory or false if cache is disabled.
      *
      * @param string|false $cache The absolute path to the compiled templates,
      *                            or false to disable cache
      */
    public function setCache($cache)
    {
        $this->cache = $cache ? $cache : false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($from, $to, \DateTime $datetime=null)
    {
        return $this->currencyExchanger->getExchangeRate($from, $to, $datetime);
    }

    protected function getCurrencyClass($data)
    {
        return sprintf(
'<?php
namespace Currencies;

use Vespolina\MonetaryBundle\Model\Currency;
/**
 * Auto-generated Currency
 */
class %sCurrency extends Currency
{
    public function getCurrencyCode()
    {
        return \'%s\';
    }

    public function getName()
    {
        return \'%s\';
    }

    public function getPrecision()
    {
        return %s;
    }

    public function getShortName()
    {
        return \'%s\';
    }

    public function getSymbol()
    {
        return \'%s\';
    }

    public function formatAmount($amount)
    {
        return $this->getSymbol() . $this->rounding($amount);
    }

    protected function rounding($amount)
    {
        $roundUp = \'.\'.substr(\'0000000000000005\', -($this->getPrecision() + 1));
        return bcadd((string)$amount, $roundUp, $this->getPrecision());
    }
}',
    (string)$data['name_code'], (string)$data['name_code'], (string)$data['name'],
    (string)$data['precision'], (string)$data['name'], (string)$data['symbol']);

    }

    /**
     * Load the currency data from the xml file
     *
     * @param $currencyCode ISO 4217 code
     * @return array currency data or false
     */
    protected function getCurrencyData($currencyCode)
    {
        $xmlFile = __DIR__ . '/../Resources/currencies/currencies.xml';
        $currencies = simplexml_load_file($xmlFile);
        foreach ($currencies as $currency) {
            if ((string)$currency->name_code === strtoupper($currencyCode)) {
                return (array)$currency;
            }
        }
        throw new Exception(sprintf("The currency code %s is not defined", $currencyCode));
    }


    /**
     * Gets the cache filename for a given currency.
     *
     * @param string $name The currency class name
     *
     * @return string The cache file name
     */
    public function getCacheFilename($class)
    {
        if (false === $this->cache) {
            return false;
        }

        return $this->getCache().'/'.$class.'.php';
    }

    /**
     * Write the currency class in the cache
     * 
     * @throws Exception
     * @param  $file
     * @param  $content
     * @return
     */
    protected function writeCacheFile($file, $content)
    {
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0777, true);
        }

        $tmpFile = tempnam(dirname($file), basename($file));
        if (false !== @file_put_contents($tmpFile, $content)) {
            if (@rename($tmpFile, $file) || (@copy($tmpFile, $file) && unlink($tmpFile))) {
                chmod($file, 0644);

                return;
            }
        }

        throw new Exception(sprintf('Failed to write cache file "%s".', $file));
    }
}
