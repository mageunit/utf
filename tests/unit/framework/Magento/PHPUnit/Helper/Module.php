<?php

/**
 * Helper class for modules.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Module extends Magento_PHPUnit_Helper_Abstract
{
    /**
     * Returns if a module is disabled
     *
     * @param string $moduleName
     * @return bool
     */
    public function isModuleDisabled($moduleName)
    {
        $moduleConfig = Mage::app()->getConfig()->getModuleConfig($moduleName);
        return $moduleConfig && !$moduleConfig->is('active');
    }

    /**
     * Returns module name by the class name in it
     *
     * @param string|object $class
     * @return string
     */
    public function getModuleNameByClass($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }
        return strtok($class, '_') . '_' . strtok('_');
    }
}
