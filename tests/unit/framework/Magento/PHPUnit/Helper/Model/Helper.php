<?php

/**
 * Helper for Magento Helper objects.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Model_Helper
    extends Magento_PHPUnit_Helper_Model_Abstract
    implements Magento_PHPUnit_Helper_Model_SingletonInterface
{
    /**
     * Returns real Magento helper's class name by helper's name.
     *
     * @param string $modelName Helper name like 'catalog'
     * @return string
     */
    public function getModelClass($modelName)
    {
        return Mage::getConfig()->getHelperClassName($modelName);
    }

    /**
     * Registers singleton object in the Mage::registry().
     *
     * @param string $modelKey
     * @param object $object
     */
    public function registerSingleton($modelKey, $object)
    {
        Magento_PHPUnit_Helper_Factory::getHelper('singleton')->registerSingleton('_helper', $modelKey, $object);
    }
}
