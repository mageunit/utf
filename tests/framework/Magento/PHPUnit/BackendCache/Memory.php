<?php

/**
 * In-memory cache backend model.
 * Currently is needed only for caching config XML data.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_BackendCache_Memory extends Zend_Cache_Backend implements Zend_Cache_Backend_Interface
{
    /**
     * Cached data
     *
     * @var array
     */
    static private $_cacheData = array();

    /**
     * Cache id prefix.
     * Should be equal to string in <id_prefix> field in the config
     *
     * @var string
     */
    protected $_idPrefix = 'm_';

    /**
     * Allowed data for saving
     *
     * @var array
     */
    protected $_allowedOptions = array(
        'config' => true
    );

    /**
     * Constructor
     *
     * @param  array $options Associative array of options
     * @throws Zend_Cache_Exception
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);

        $this->save(
            serialize($this->_allowedOptions),
            $this->_getCacheFullId(Mage_Core_Model_Cache::OPTIONS_CACHE_ID)
        );
    }

    /**
     * Gets cache full id
     *
     * @param string $id
     * @return string
     */
    protected function _getCacheFullId($id)
    {
        return $this->_idPrefix . strtoupper($id);
    }

    /**
     * The method is not needed for in-memory cache
     *
     * @param array $directives
     */
    public function setDirectives($directives)
    {
    }

    /**
     * Load data from cache
     *
     * @param string $id
     * @param bool $doNotTestCacheValidity Doesn't need for in-memory cache
     * @return mixed
     */
    public function load($id,  $doNotTestCacheValidity = false)
    {
        return isset(self::$_cacheData[$id]) ? self::$_cacheData[$id] : null;
    }

    /**
     * Test if a cache is available or not (for the given id)
     *
     * @param string $id
     * @return bool
     */
    public function test($id)
    {
        return array_key_exists($id, self::$_cacheData[$id]);
    }

    /**
     * Save data into cache
     *
     * @param mixed $data
     * @param string $id
     * @param array $tags Doesn't need for in-memory cache
     * @param bool $specificLifetime Doesn't need for in-memory cache
     * @return bool
     */
    public function save($data, $id, $tags = array(), $specificLifetime = false)
    {
        self::$_cacheData[$id] = $data;
        return true;
    }

    /**
     * Removes data from cache
     *
     * @param string $id
     */
    public function remove($id)
    {
        unset(self::$_cacheData[$id]);
    }

    /**
     * Cleans cache.
     * Works only when $mode == Zend_Cache::CLEANING_MODE_ALL
     *
     * @param string $mode
     * @param array $tags
     * @return bool
     */
    public function clean($mode = Zend_Cache::CLEANING_MODE_ALL, $tags = array())
    {
        if ($mode == Zend_Cache::CLEANING_MODE_ALL) {
            self::$_cacheData = array();
        }
        return true;
    }

    /**
     * Cleans cache data by id.
     * Is needed in Framework classes.
     *
     * @param string|null $id If $id == null then cleans entire cache
     */
    public static function cleanById($id = null)
    {
        if (is_null($id)) {
            self::$_cacheData = array();
        } else {
            unset(self::$_cacheData[$id]);
        }
    }
}
