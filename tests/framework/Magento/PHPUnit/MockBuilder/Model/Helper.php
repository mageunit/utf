<?php

/**
 * Class which creates mock object for Mage::helper() construction
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_MockBuilder_Model_Helper extends Magento_PHPUnit_MockBuilder_Model_Abstract
{
    /**
     * Prepared the strategy object for generating mocks in Magento
     *
     * @return Magento_PHPUnit_Core_MockGenerator_Model_Singleton
     */
    protected function _prepareMockGeneratorStrategy()
    {
        $mockGenerator = new Magento_PHPUnit_Core_MockGenerator_Model_Singleton(
            Magento_PHPUnit_Helper_Factory::getHelper('model_helper')
        );

        return $mockGenerator;
    }
}
