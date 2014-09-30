<?php

/**
 * Class which creates mock object for resource models when they are created
 * in a code using Mage::getResourceModel('...');
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_MockBuilder_Model_ResourceModel extends Magento_PHPUnit_MockBuilder_Model_Model
{
    /**
     * Prepared the strategy object for generating mocks in Magento
     *
     * @return Magento_PHPUnit_Core_MockGenerator_Model_Delegate
     */
    protected function _prepareMockGeneratorStrategy()
    {
        $mockGenerator = new Magento_PHPUnit_Core_MockGenerator_Model_Delegate(
            Magento_PHPUnit_Core_DataPool_Factory::RESOURCE_MODEL_DELEGATES,
            Magento_PHPUnit_Helper_Factory::getHelper('model_resourceModel')
        );

        return $mockGenerator;
    }
}
