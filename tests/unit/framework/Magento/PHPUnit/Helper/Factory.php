<?php

/**
 * Helper factory class
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Factory
{
    /**
     * Helpers array
     *
     * @var array array('key' => object, ...)
     */
    protected static $_helpers = array();

    /**
     * Creates new helper object by keyname
     *
     * @param string $key helper's part of the classname after Magento_PHPUnit_Helper_
     * @return Magento_PHPUnit_Helper_Abstract
     */
    protected static function _initHelper($key)
    {
        $class = 'Magento_PHPUnit_Helper_' . uc_words($key);
        return new $class();
    }

    /**
     * Returns a helper object.
     *
     * @param string $key
     * @return Magento_PHPUnit_Helper_Abstract|null
     */
    public static function getHelper($key)
    {
        if (!isset(self::$_helpers[$key])) {
            self::$_helpers[$key] = self::_initHelper($key);
        }

        return self::$_helpers[$key];
    }
}
