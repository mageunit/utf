<?php

/**
 * Helper for blocks.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Model_Block extends Magento_PHPUnit_Helper_Model_Model
{
    /**
     * Name of the pool with block's real class names
     *
     * @var string
     */
    protected $_realModelClassesPool = Magento_PHPUnit_Core_DataPool_Factory::BLOCK_CLASSES;

    /**
     * Group type name
     *
     * @var string
     */
    protected $_group = 'block';
}
