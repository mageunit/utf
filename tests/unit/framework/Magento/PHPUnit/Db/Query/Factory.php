<?php

/**
 * Local DB queries factory
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Query_Factory
{
    /**
     * Array, which contains available processor class names
     *
     * @var array
     */
    protected static $_queryModels = array(
        'Magento_PHPUnit_Db_Query_Select',
        'Magento_PHPUnit_Db_Query_Delete'
    );

    /**
     * Gets all available query processors
     *
     * @return array
     */
    public static function getAllQueryModels()
    {
        $models = array();
        foreach (self::$_queryModels as $modelName) {
            $models[$modelName] = new $modelName();
        }
        return $models;
    }
}
