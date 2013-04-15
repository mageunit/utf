<?php

/**
 * Helper for Magento resource model objects.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Model_ResourceModel
    extends Magento_PHPUnit_Helper_Model_Model
    implements Magento_PHPUnit_Helper_Model_SingletonInterface
{
    /**
     * Name of the pool with real resource model names
     *
     * @var string
     */
    protected $_resourceModelNamesPool = Magento_PHPUnit_Core_DataPool_Factory::RESOURCE_MODELS;

    /**
     * Returns pool of real resource model names
     *
     * @return Magento_PHPUnit_Core_DataPool_ResourceModelName
     */
    protected function _getResourceModelNamesPool()
    {
        return Magento_PHPUnit_Core_DataPool_Factory::getPoolObject($this->_resourceModelNamesPool);
    }

    /**
     * Returns real model class name.
     *
     * @param string $modelName
     * @return string
     */
    public function getModelClass($modelName)
    {
        return parent::getModelClass($this->getResourceModelName($modelName));
    }

    /**
     * Returns real resource model name
     *
     * @param string $modelName Model name like 'catalog/product'
     * @return string Real model name like 'catalog/mysql4_product'
     */
    public function getResourceModelName($modelName)
    {
        $resourceModelName = $this->_getResourceModelNamesPool()->getResourceModelName($modelName);
        if (!$resourceModelName) {
            $resourceModelName = $this->_getResourceModelNameFromConfig($modelName);
            $this->_getResourceModelNamesPool()->setResourceModelName($modelName, $resourceModelName);
        }
        return $resourceModelName;
    }

    /**
     * Get real resource model name
     *
     * @param string $modelName
     * @return string
     */
    protected function _getResourceModelNameFromConfig($modelName)
    {
        $classArray = explode('/', $modelName);
        if (count($classArray) != 2) {
            return false;
        }

        list($module, $model) = $classArray;
        $moduleNode = Mage::getConfig()->getNode("global/models/{$module}");
        if (!$moduleNode) {
            return false;
        }

        if (!empty($moduleNode->resourceModel)) {
            $resourceModel = (string)$moduleNode->resourceModel;
        } else {
            return false;
        }

        return $resourceModel . '/' . $model;
    }

    /**
     * Rewrite model by delegate class.
     * You can rewrite one model only once for one test.
     *
     * @param string $model
     * @param string $className delegate class name
     */
    public function rewriteModelByClass($model, $className)
    {
        parent::rewriteModelByClass($this->getResourceModelName($model), $className);
    }

    /**
     * Registers singleton object in the Mage::registry().
     *
     * @param string $modelKey
     * @param object $object
     */
    public function registerSingleton($modelKey, $object)
    {
        Magento_PHPUnit_Helper_Factory::getHelper('singleton')
            ->registerSingleton('_resource_singleton', $modelKey, $object);
    }
}
