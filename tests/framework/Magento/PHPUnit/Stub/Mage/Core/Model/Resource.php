<?php

/**
 * Stub class for Magento_Core_Model_Resource.
 * Needed to load real modules configs.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Stub_Mage_Core_Model_Resource extends Mage_Core_Model_Resource
{
    /**
     * Sets connection object.
     * It is needed to mock connection adapter object.
     *
     * @param string $connectionName
     * @param Zend_Db_Adapter_Abstract $connectionObject
     * @return Magento_PHPUnit_Stub_Mage_Core_Model_Resource_Config
     */
    public function setConnection($connectionName, $connectionObject)
    {
        $this->_connections[$connectionName] = $connectionObject;
        return $this;
    }
}
