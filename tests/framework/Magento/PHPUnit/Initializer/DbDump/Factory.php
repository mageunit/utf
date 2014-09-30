<?php
/**
 * DB Dumpers factory
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Initializer_DbDump_Factory
{
    /**
     * List of available dumpers.
     *
     * @var array
     */
    protected static $_dumpClasses = array(
        'mysql4' => 'Magento_PHPUnit_Initializer_DbDump_Mysql'
    );

    /**
     * Returns DB dumper by resource model (taken from config->global->default_setup->connection->model XML node)
     *
     * @param string $model
     * @return Magento_PHPUnit_Initializer_DbDump_Interface
     * @throws InvalidArgumentException
     */
    public static function getDumperByModel($model)
    {
        if (isset(self::$_dumpClasses[$model])) {
            $class = self::$_dumpClasses[$model];
            return new $class();
        }

        throw new InvalidArgumentException("DB dumper for model '{$model}' was not found");
    }
}
