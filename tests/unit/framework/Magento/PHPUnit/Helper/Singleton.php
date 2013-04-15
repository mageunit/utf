<?php

/**
 * Helper class for singletons in Mage::registry.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Singleton extends Magento_PHPUnit_Helper_Abstract
{
    /**
     * Registers singleton object in the Mage::registry().
     *
     * @param string $registryKey
     * @param string $modelName
     * @param mixed $object
     */
    public function registerSingleton($registryKey, $modelName, $object)
    {
        $finalRegistryKey = "{$registryKey}/{$modelName}";
        Mage::unregister($finalRegistryKey);
        Mage::register($finalRegistryKey, $object);
    }
}
