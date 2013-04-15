<?php

/**
 * Class for pool of real resource model names
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_DataPool_ResourceModelName
{
    /**
     * Real resource models names.
     *  array('catalog/product' => 'mysql4_catalog/product')
     *
     * @var array
     */
    protected $_resourceModels = array();

    /**
     * Returns real resource model name
     *
     * @param string $model
     * @return string
     */
    public function getResourceModelName($model)
    {
        if (!isset($this->_resourceModels[$model])) {
            return false;
        }
        return $this->_resourceModels[$model];
    }

    /**
     * Set real resource model name
     *
     * @param string $model
     * @param string $realName
     */
    public function setResourceModelName($model, $realName)
    {
        $this->_resourceModels[$model] = $realName;
    }
}
