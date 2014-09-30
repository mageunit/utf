<?php

/**
 * Class which creates mock object for models when they are created
 * in a code using Mage::getModel('...');
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_MockBuilder_Model_Model extends Magento_PHPUnit_MockBuilder_Model_Abstract
{
    /**
     * Additional setting for MockBuilder.
     * Allows to make one mock object for all Mage::getModel() for concrete model.
     *
     * @var bool
     */
    protected $_asSingleton = false;

    /**
     * Gets 'asSingleton' setting value
     *
     * @return bool
     */
    public function getAsSingleton()
    {
        return $this->_asSingleton;
    }

    /**
     * Sets 'asSingleton' setting value.
     * Allows to make one mock object for all Mage::getModel() for concrete model.
     *
     * @param bool $asSingleton
     * @return Magento_PHPUnit_MockBuilder_Model_Model
     */
    public function setAsSingleton($asSingleton)
    {
        $this->_asSingleton = $asSingleton;
        return $this;
    }

    /**
     * Prepared the strategy object for generating mocks in Magento
     *
     * @return Magento_PHPUnit_Core_MockGenerator_Model_Delegate
     */
    protected function _prepareMockGeneratorStrategy()
    {
        $mockGenerator = new Magento_PHPUnit_Core_MockGenerator_Model_Delegate(
            Magento_PHPUnit_Core_DataPool_Factory::MODEL_DELEGATES,
            Magento_PHPUnit_Helper_Factory::getHelper('model_model')
        );

        return $mockGenerator;
    }
}
