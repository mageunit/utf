<?php

/**
 * Helper for Magento models.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Helper_Model_Model
    extends Magento_PHPUnit_Helper_Model_Abstract
    implements Magento_PHPUnit_Helper_Model_SingletonInterface
{
    /**
     * Model class names pool key
     *
     * @var string
     */
    protected $_modelClassesPool = Magento_PHPUnit_Core_DataPool_Factory::MODEL_CLASSES;

    /**
     * Group type name
     *
     * @var string
     */
    protected $_group = 'model';

    /**
     * Returns pool of real model class names
     *
     * @return Magento_PHPUnit_Core_DataPool_ModelClass
     */
    protected function _getModelClassNamesPool()
    {
        return Magento_PHPUnit_Core_DataPool_Factory::getPoolObject($this->_modelClassesPool);
    }

    /**
     * Returns real model class name
     *
     * @param string $modelName
     * @return string
     */
    public function getModelClass($modelName)
    {
        $className = $this->_getModelClassNamesPool()->getModelClass($modelName);
        if (!$className) {
            $className = $this->_getModelClassNameFromConfig($modelName);
            $this->_getModelClassNamesPool()->setModelClass($modelName, $className);
        }
        return $className;
    }

    /**
     * Gets model's real class name from config object,
     * but does not add it to config object's cache array.
     * So, this method is safe for models rewriting.
     *
     * @param string $model
     * @return string
     */
    protected function _getModelClassNameFromConfig($model)
    {
        $classArr = explode('/', trim($model));
        $module = $classArr[0];
        $class = !empty($classArr[1]) ? $classArr[1] : null;

        $config = Mage::getConfig()->getNode("global/{$this->_group}s/{$module}");

        if ($config->rewrite->{$class}) {
            $className = (string)$config->rewrite->{$class};
        } else {
            if (!empty($config)) {
                if ($config->class) {
                    $modelNew = (string)$config->class;
                } elseif ($config->model) {
                    $modelNew = (string)$config->model;
                } else {
                    $className = false;
                    $modelNew = false;
                }
                if ($modelNew) {
                    $modelNew = trim($modelNew);
                    if (strpos($modelNew, '/')===false) {
                        $className = $modelNew;
                    } else {
                        $className = $this->_getModelClassNameFromConfig($modelNew);
                    }
                }
            }
            if (empty($className)) {
                $className = 'mage_'.$module.'_'.$this->_group;
            }
            if (!empty($class)) {
                $className .= '_'.$class;
            }
            $className = uc_words($className);
        }

        return $className;
    }

    /**
     * Rewrite model by delegator class.
     * You can rewrite one model only once for one test.
     *
     * @param string $model
     * @param string $className delegator class name
     */
    public function rewriteModelByClass($model, $className)
    {
        list($module, $modelName) = explode('/', $model);
        $nodePath = "global/{$this->_group}s/{$module}/rewrite/{$modelName}";
        if (Mage::getConfig()->getNode($nodePath) != $className) {
            Mage::getConfig()->setNode($nodePath, $className);
        }
    }

    /**
     * Registers singleton object in the Mage::registry().
     *
     * @param string $modelKey
     * @param object $object
     */
    public function registerSingleton($modelKey, $object)
    {
        Magento_PHPUnit_Helper_Factory::getHelper('singleton')->registerSingleton('_singleton', $modelKey, $object);
    }
}
