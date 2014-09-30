<?php

/**
 * Central object for setting and getting data from DataPools.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_DataPool_Factory
{
    /**
     * Keys for pools with static data
     */
    const MODEL_CLASSES = 'classes';
    const BLOCK_CLASSES = 'block_classes';
    const CONNECTION_CLASSES = 'connection_classes';
    const MODEL_DELEGATES = 'model';
    const RESOURCE_MODEL_DELEGATES = 'resource_model';
    const BLOCK_DELEGATES = 'block';
    const RESOURCE_MODELS = 'resource_model_name';


    /**
     * Classes of pools
     *
     * @var array
     */
    static private $_poolClasses = array(
        self::MODEL_CLASSES => 'Magento_PHPUnit_Core_DataPool_ModelClass',
        self::BLOCK_CLASSES => 'Magento_PHPUnit_Core_DataPool_ModelClass',
        self::CONNECTION_CLASSES => 'Magento_PHPUnit_Core_DataPool_Connection',
        self::MODEL_DELEGATES => 'Magento_PHPUnit_Core_DataPool_Delegate',
        self::RESOURCE_MODEL_DELEGATES => 'Magento_PHPUnit_Core_DataPool_Delegate',
        self::BLOCK_DELEGATES => 'Magento_PHPUnit_Core_DataPool_Delegate',
        self::RESOURCE_MODELS => 'Magento_PHPUnit_Core_DataPool_ResourceModelName'
    );

    /**
     * Pools array
     *
     * @var array array(poolKey => poolObject, ...)
     */
    static private $_pools = array();

    /**
     * Returns pool object by pool key
     *
     * @param string $poolKey
     * @return object
     */
    public static function getPoolObject($poolKey)
    {
        if (!isset(self::$_pools[$poolKey])) {
            $poolClass =  self::$_poolClasses[$poolKey];
            self::$_pools[$poolKey] = new $poolClass();
        }
        return self::$_pools[$poolKey];
    }

    /**
     * Delete pool object
     *
     * @param string $poolKey
     */
    public static function deletePoolObject($poolKey)
    {
        if (isset(self::$_pools[$poolKey])) {
            unset(self::$_pools[$poolKey]);
        }
    }

    /**
     * Cleans all pool objects
     */
    public static function clean()
    {
        self::$_pools = array();
    }
}
