<?php

/**
 * Mock generator strategy. Creates a mock by setting it into the appropriate key in registry.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_MockGenerator_Model_Singleton implements Magento_PHPUnit_Core_MockGenerator_Model_Interface
{
    /**
     * Model Helper
     *
     * @var Magento_PHPUnit_Helper_Model_SingletonInterface
     */
    protected $_modelHelper;

    /**
     * Constructor
     *
     * @param Magento_PHPUnit_Helper_Model_SingletonInterface $modelHelper
     */
    public function __construct(
        Magento_PHPUnit_Helper_Model_SingletonInterface $modelHelper
    ) {
        $this->_modelHelper = $modelHelper;
    }

    /**
     * Returns model helper
     *
     * @return Magento_PHPUnit_Helper_Model_SingletonInterface
     */
    public function getModelHelper()
    {
        return $this->_modelHelper;
    }

    /**
     * Generates mock class name
     *
     * @param Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder
     * @return string
     */
    public function generateMockClassName(Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder)
    {
        return $this->getModelHelper()->getModelClass($mockBuilder->getModel());
    }

    /**
     * Makes final changes in mocks.
     * The method should be run in MockBuilder after building the mock (getMock() method).
     *
     * @param object $mock
     * @param Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder
     */
    public function afterGetMock($mock, Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder)
    {
        $this->getModelHelper()->registerSingleton($mockBuilder->getModel(), $mock);
    }
}
