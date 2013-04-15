<?php

/**
 * Initializer factory class
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Initializer_Factory
{
    /**
     * Initializers array
     *
     * @var array array('Class_Name' => object, ...)
     */
    protected static $_initializers = array();

    /**
     * Rollback and remove all initializers from the factory
     */
    public static function cleanInitializers()
    {
        foreach (self::$_initializers as $initializer) {
            $initializer->reset();
        }
        self::$_initializers = array();
    }

    /**
     * Runs all initializers
     */
    public static function run()
    {
        foreach (self::$_initializers as $initializer) {
            $initializer->run();
        }
    }

    /**
     * Creates initializer object by class
     *
     * @param string $class initializer's classname
     * @param bool $addToRunQuery if we should add object to initializers array
     *  to clean it automatically after test is finished
     * @throws Exception Initializer must be instance of Magento_PHPUnit_Initializer_Abstract
     * @return Magento_PHPUnit_Initializer_Abstract
     */
    public static function createInitializer($class, $addToRunQuery = true)
    {
        $initializer = new $class();
        if (!($initializer instanceof Magento_PHPUnit_Initializer_Abstract)) {
            throw new Exception(
                'Magento PHPUnit test initializer must be instance of Magento_PHPUnit_Initializer_Abstract'
            );
        }
        if ($addToRunQuery) {
            self::$_initializers[$class] = $initializer;
        }
        return $initializer;
    }

    /**
     * Returns initializer from initializers pool.
     *
     * @param string $class
     * @return Magento_PHPUnit_Initializer_Abstract|null
     */
    public static function getInitializer($class)
    {
        if (isset(self::$_initializers[$class])) {
            return self::$_initializers[$class];
        }
        return null;
    }
}
