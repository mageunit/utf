<?php

/**
 * Main TestCase class for Magento unit tests.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Is called before test will be run.
     */
    protected function setUp()
    {
        $this->prepareInitializers();
        $this->runInitializers();
        $this->checkModuleEnabled();
    }

    /**
     * Prepares initializers.
     * Is called in setUp method first. Can be overridden in testCases to add more initializers.
     */
    protected function prepareInitializers()
    {
        Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_App');
    }

    /**
     * Runs initializers.
     * Is called in setUp method.
     */
    protected function runInitializers()
    {
        Magento_PHPUnit_Initializer_Factory::run();
    }

    /**
     * Mark a test as skipped if its module is disabled
     */
    protected function checkModuleEnabled()
    {
        $moduleHelper = Magento_PHPUnit_Helper_Factory::getHelper('module');
        $moduleName = $moduleHelper->getModuleNameByClass($this);
        if ($moduleHelper->isModuleDisabled($moduleName)) {
            $this->markTestSkipped("Module '{$moduleName}' is disabled");
        }
    }

    /**
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->cleanPoolsData();
        Magento_PHPUnit_Initializer_Factory::cleanInitializers();
    }

    /**
     * Helper method. Can be needed to reset cache manually.
     */
    protected function resetCache()
    {
        Magento_PHPUnit_BackendCache_Memory::cleanById();
    }

    /**
     * Returns mock builder for model.
     * Needed to create a mock for Mage::getModel(...) calls
     *
     * @param string $modelName like 'catalog/product'
     * @return Magento_PHPUnit_MockBuilder_Model_Model
     */
    protected function getModelMockBuilder($modelName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_Model($this, $modelName);
    }

    /**
     * Returns mock builder for resource model.
     * Needed to create a mock for Mage::getResourceModel(...) calls
     *
     * @param string $modelName Resource model name like 'catalog/product'
     * @return Magento_PHPUnit_MockBuilder_Model_ResourceModel
     */
    protected function getResourceModelMockBuilder($modelName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_ResourceModel($this, $modelName);
    }

    /**
     * Returns mock builder for singleton models.
     * Needed to create a mock for Mage::getSingleton(...) calls
     *
     * @param string $modelName like 'catalog/product'
     * @return Magento_PHPUnit_MockBuilder_Model_Singleton
     */
    protected function getSingletonMockBuilder($modelName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_Singleton($this, $modelName);
    }

    /**
     * Returns mock builder for resource singleton models.
     * Needed to create a mock for Mage::getResourceSingleton(...) calls
     *
     * @param string $modelName like 'catalog/product'
     * @return Magento_PHPUnit_MockBuilder_Model_ResourceSingleton
     */
    protected function getResourceSingletonMockBuilder($modelName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_ResourceSingleton($this, $modelName);
    }

    /**
     * Returns mock builder for helper.
     * Needed to create a mock for Mage::helper(...) calls
     *
     * @param string $helperName like 'catalog'
     * @return Magento_PHPUnit_MockBuilder_Model_Helper
     */
    protected function getHelperMockBuilder($helperName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_Helper($this, $helperName);
    }

    /**
     * Returns mock builder for Mage::dispatchEvent(...) construction
     *
     * @param string $eventName
     * @return Magento_PHPUnit_MockBuilder_Event
     */
    protected function getEventMockBuilder($eventName)
    {
        return new Magento_PHPUnit_MockBuilder_Event($this, $eventName);
    }

    /**
     * Returns mock builder for block.
     *
     * @param string $blockName
     * @return Magento_PHPUnit_MockBuilder_Model_Block
     */
    protected function getBlockMockBuilder($blockName)
    {
        return new Magento_PHPUnit_MockBuilder_Model_Block($this, $blockName);
    }

    /**
     * Returns mock builder for database adapter, which can be used in resource models in
     * $this->_getReadAdapter() or $this->_getWriteAdapter() or $this->_getConnection('core_read'), for example
     *
     * @param string $connectionName Full connection name like 'core_read' or 'customer_write' or 'default_read'
     * @return Magento_PHPUnit_MockBuilder_DbAdapter
     */
    protected function getAdapterMockBuilder($connectionName)
    {
        return new Magento_PHPUnit_MockBuilder_DbAdapter($this, $connectionName);
    }

    /**
     * Returns mock builder for database adapter for construction $this->_getReadAdapter()
     *
     * @return Magento_PHPUnit_MockBuilder_DbAdapter
     */
    protected function getReadAdapterMockBuilder()
    {
        return $this->getAdapterMockBuilder($this->_getConnectionHelper()->getDefaultReadResource());
    }

    /**
     * Returns mock builder for database adapter for construction $this->_getWriteAdapter()
     *
     * @return Magento_PHPUnit_MockBuilder_DbAdapter
     */
    protected function getWriteAdapterMockBuilder()
    {
        return $this->getAdapterMockBuilder($this->_getConnectionHelper()->getDefaultWriteResource());
    }

    /**
     * Clean all data from static data pools.
     */
    protected function cleanPoolsData()
    {
        Magento_PHPUnit_Core_DataPool_Factory::clean();
    }

    /**
     * Get model helper.
     * Needed to get real model's class name.
     *
     * @return Magento_PHPUnit_Helper_Model_Model
     */
    protected function _getModelHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('model_model');
    }

    /**
     * Get resource model helper.
     * Needed to get real resource model's class name.
     *
     * @return Magento_PHPUnit_Helper_Model_ResourceModel
     */
    protected function _getResourceModelHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('model_resourceModel');
    }

    /**
     * Get helper model for Magento Helpers.
     * Needed to get real helper's class name.
     *
     * @return Magento_PHPUnit_Helper_Model_Helper
     */
    protected function _getHelperModelHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('model_helper');
    }

    /**
     * Get helper model for Magento Blocks.
     * Needed to get real block's class name.
     *
     * @return Magento_PHPUnit_Helper_Model_Block
     */
    protected function _getBlockHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('model_block');
    }

    /**
     * Get helper for Magento stores.
     *
     * @return Magento_PHPUnit_Helper_Store
     */
    protected function _getStoreHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('store');
    }

    /**
     * Get event helper.
     *
     * @return Magento_PHPUnit_Helper_Event
     */
    protected function _getEventHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('event');
    }

    /**
     * Get connection helper.
     *
     * @return Magento_PHPUnit_Helper_Connection
     */
    protected function _getConnectionHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('connection');
    }

    /**
     * Returns model's className.
     * Does not save it into Config's cache array.
     *
     * @param string $model
     * @return string
     */
    protected function getModelClassName($model)
    {
        return $this->_getModelHelper()->getModelClass($model);
    }

    /**
     * Returns Resource model's className.
     * Does not save it into Config's cache array.
     *
     * @param string $model
     * @return string
     */
    protected function getResourceModelClassName($model)
    {
        return $this->_getResourceModelHelper()->getModelClass($model);
    }

    /**
     * Returns helper's className.
     *
     * @param string $helper
     * @return string
     */
    protected function getHelperClassName($helper)
    {
        return $this->_getHelperModelHelper()->getModelClass($helper);
    }

    /**
     * Returns block's className.
     *
     * @param string $block
     * @return string
     */
    protected function getBlockClassName($block)
    {
        return $this->_getBlockHelper()->getModelClass($block);
    }

    /**
     * Sets config data for store.
     * Can be needed to get your value in Mage::getStoreConfig()
     *
     * @param string $path
     * @param string $value
     * @param int|null|Mage_Core_Model_Store $store Non null value will work only if Magento is installed
     */
    protected function setStoreConfig($path, $value, $store = null)
    {
        $this->_getStoreHelper()->setStoreConfig($path, $value, $store);
    }

    /**
     * Remove event observers from config
     *
     * @param array $eventNames - remove observers for events from this array. if array is empty, remove for all events
     * @return Magento_PHPUnit_TestCase
     */
    protected function disableObservers($eventNames = array())
    {
        $this->_getEventHelper()->disableObservers($eventNames);
        return $this;
    }
}
