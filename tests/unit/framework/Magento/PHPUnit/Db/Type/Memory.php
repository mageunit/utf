<?php

/**
 * Local database resource type
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Type_Memory extends Mage_Core_Model_Resource_Type_Db
{
    /**
     * Get stub adapter
     *
     * @param array $config Connection config
     * @return Magento_PHPUnit_Db_Adapter
     */
    public function getConnection($config)
    {
        $configArr = (array)$config;
        $configArr['profiler'] = false;

        return $this->_getDbAdapterInstance($configArr);
    }

    /**
     * Create and return stub adapter object instance
     *
     * @param array $configArr Connection config
     * @return Magento_PHPUnit_Db_Adapter
     */
    protected function _getDbAdapterInstance($configArr)
    {
        $className = $this->_getDbAdapterClassName();
        $adapter = new $className($configArr);
        return $adapter;
    }

    /**
     * Retrieve stub adapter class name
     *
     * @return string
     */
    protected function _getDbAdapterClassName()
    {
        return 'Magento_PHPUnit_Db_Adapter';
    }

}
