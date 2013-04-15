<?php

/**
 * Abstract initializer class.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_Initializer_Abstract
{
    /**
     * Runs initialization process.
     */
    abstract public function run();

    /**
     * Rollback all changes after the test is ended (on tearDown)
     * Can be empty if nothing to rollback.
     */
    abstract public function reset();
}
