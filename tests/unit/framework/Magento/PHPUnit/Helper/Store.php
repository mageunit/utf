<?php

/**
 * Helper class for stores.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Store extends Magento_PHPUnit_Helper_Abstract
{
    /**
     * Sets config data for store.
     * Can be needed to get your value in Mage::getStoreConfig()
     *
     * @param string $path
     * @param string $value
     * @param int|null|Mage_Core_Model_Store $store Non-null value will work only if Magento is installed
     */
    public function setStoreConfig($path, $value, $store = null)
    {
        //needed to allow set arrays and objects to the config (initializes cache array).
        Mage::app()->getStore($store)->getConfig($path);
        Mage::app()->getStore($store)->setConfig($path, $value);
    }
}
