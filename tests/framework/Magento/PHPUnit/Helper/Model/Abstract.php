<?php

/**
 * Abstract class for "model" helpers.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_Helper_Model_Abstract extends Magento_PHPUnit_Helper_Abstract
{
    /**
     * Returns real model class name by model name.
     *
     * @param string $modelName
     * @return string
     */
    abstract public function getModelClass($modelName);
}
