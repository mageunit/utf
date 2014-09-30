<?php

/**
 * Interface for model mock generators.
 */
interface Magento_PHPUnit_Core_MockGenerator_Model_Interface
{
    /**
     * Generate mock class name and place the mock object into right place of the application.
     *
     * @param Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder
     * @return string
     */
    public function generateMockClassName(Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder);

    /**
     * Makes final changes in mocks.
     * The method should be run in MockBuilder after building the mock (getMock() method).
     *
     * @param $mock
     * @param Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder
     */
    public function afterGetMock($mock, Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder);
}
