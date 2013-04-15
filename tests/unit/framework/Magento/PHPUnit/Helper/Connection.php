<?php

/**
 * Helper class for database connections (adapters).
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Connection extends Magento_PHPUnit_Helper_Abstract
{
    /**
     * Name of the pool with real connection classes
     *
     * @var string
     */
    protected $_connectionClassesPool = Magento_PHPUnit_Core_DataPool_Factory::CONNECTION_CLASSES;

    /**
     * Sets connection object.
     * Can be needed for setting mock object for DB adapter.
     *
     * @param string $connectionName
     * @param Zend_Db_Adapter_Abstract $connectionObject
     */
    public function setConnection($connectionName, $connectionObject)
    {
        //stub for resource is used for setting connection object.
        //@see Magento_PHPUnit_Stub_Magento_Core_Model_Resource
        Mage::getSingleton('core/resource')->setConnection($connectionName, $connectionObject);
    }

    /**
     * Gets curent connection config.
     *
     * @param string $connectionName
     * @return array
     */
    public function getConnectionConfig($connectionName)
    {
        return Mage::getSingleton('core/resource')->getConnection($connectionName)->getConfig();
    }

    /**
     * Sets connection object.
     * Can be needed for setting mock object for DB adapter.
     *
     * @param string $connectionName
     * @return string
     */
    public function getConnectionClassName($connectionName)
    {
        $className = $this->_getConnectionClassesPool()->getData($connectionName);
        if (!$className) {
            //stub for resource config is used for setting connection object.
            //@see Magento_PHPUnit_Stub_Magento_Core_Model_Resource_Config
            $connection = Mage::getSingleton('core/resource')->getConnection($connectionName);
            $className = get_class($connection);
            $this->_getConnectionClassesPool()->setData($connectionName, $className);
        }
        return $className;
    }

    /**
     * Returns pool of real resource model names
     *
     * @return Magento_PHPUnit_Core_DataPool_Connection
     */
    protected function _getConnectionClassesPool()
    {
        return  Magento_PHPUnit_Core_DataPool_Factory::getPoolObject($this->_connectionClassesPool);
    }

    /**
     * Returns default read resource key from Magento
     *
     * @return string
     */
    public function getDefaultReadResource()
    {
        return Mage_Core_Model_Resource::DEFAULT_READ_RESOURCE;
    }

    /**
     * Returns default write resource key from Magento
     *
     * @return string
     */
    public function getDefaultWriteResource()
    {
        return Mage_Core_Model_Resource::DEFAULT_WRITE_RESOURCE;
    }
}
