<?php

/**
 * Class for pool of real model class names
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_DataPool_ModelClass
{
    /**
     * Array of model class names:
     *  array('catalog/product' => 'Magento_Catalog_Model_Product')
     *
     * @var array
     */
    protected $_modelClasses = array();

    /**
     * Returns real model class name
     *
     * @param string $model
     * @return string
     */
    public function getModelClass($model)
    {
        if (!isset($this->_modelClasses[$model])) {
            return false;
        }
        return $this->_modelClasses[$model];
    }

    /**
     * Set real model class name
     *
     * @param string $model
     * @param string $className
     */
    public function setModelClass($model, $className)
    {
        $this->_modelClasses[$model] = $className;
    }
}
