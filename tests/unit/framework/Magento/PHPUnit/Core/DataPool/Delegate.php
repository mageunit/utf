<?php

/**
 * Class for pool of internal data needed for models mocking.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_DataPool_Delegate
{
    /**
     * Array of delegate class names:
     *  array('catalog/product' => 'MockDelegate_Mage_Sales_Model_Order_acea23d3', ...)
     *
     * @var array
     */
    protected $_delegateClassNames = array();

    /**
     * Array of mocked models:
     *  array('sales/order' => array(Mock1, Mock2, ...), ...)
     *
     * @var array
     */
    protected $_modelMocks = array();

    /**
     * Mocked models, which were created as singletons, array:
     *  array('sales/order' => Mock1, 'catalog/product' => Mock2, ...)
     *
     * @var array
     */
    protected $_singletonModelMocks = array();

    /**
     * Get delegate class name for model
     *
     * @param string $model
     * @return string|bool
     */
    public function getDelegateClassName($model)
    {
        if (empty($this->_delegateClassNames[$model])) {
            return false;
        }
        return $this->_delegateClassNames[$model];
    }

    /**
     * Set delegate class name for model
     *
     * @param string $model
     * @param string $delegateClassName
     * @return Magento_PHPUnit_Core_DataPool_Delegate
     */
    public function setDelegateClassName($model, $delegateClassName)
    {
        $this->_delegateClassNames[$model] = $delegateClassName;
        return $this;
    }

    /**
     * Adds mock object to mocks queue array.
     * Is needed for delegates to get right mock object after each Mage::getModel() call.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     * @param string $model
     * @param bool $asSingleton
     */
    public function addMockObject($mock, $model, $asSingleton = false)
    {
        if ($asSingleton) {
            $this->_singletonModelMocks[$model] = $mock;
            unset($this->_modelMocks[$model]);
        } else {
            if (!isset($this->_modelMocks[$model])) {
                $this->_modelMocks[$model] = array();
            }
            $this->_modelMocks[$model][] = $mock;
        }
    }

    /**
     * Gets real mock object for delegator from $mockModels array.
     *
     * @param string $model
     * @param array $constructorArgs
     * @return PHPUnit_Framework_MockObject_MockObject|Mage_Core_Model_Abstract|object
     */
    public function getMockObject($model, $constructorArgs = array())
    {
        if (!empty($this->_singletonModelMocks[$model])) {
            return $this->_singletonModelMocks[$model];
        }

        if (!empty($this->_modelMocks[$model])) {
            return array_shift($this->_modelMocks[$model]);
        }
        //create real model otherwise
        $realModelClass = Magento_PHPUnit_Core_DataPool_Factory::getPoolObject(
                Magento_PHPUnit_Core_DataPool_Factory::MODEL_CLASSES
            )
            ->getRealModelClass($model);
        if (!$realModelClass) {
            throw new Exception(sprintf('Cannot initialize new Model \'%s\'', $model));
        }
        return new $realModelClass($constructorArgs);
    }
}
