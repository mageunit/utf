<?php

/**
 * Allows helper to register Magento objects as Singletons in Magento registry.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
interface Magento_PHPUnit_Helper_Model_SingletonInterface
{
    /**
     * Registers the object in Magento registry.
     *
     * @param string $modelKey
     * @param object $object
     */
    public function registerSingleton($modelKey, $object);

    /**
     * Returns the class name of the model
     *
     * @param string $modelName
     * @return string
     */
    public function getModelClass($modelName);
}
