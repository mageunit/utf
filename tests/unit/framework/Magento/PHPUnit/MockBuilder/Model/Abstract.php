<?php

/**
 * Abstract class for constructions (like Mage::getModel(), Mage::helper())
 * of creating model-like Magento objects
 * to create mock objects for them.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_MockBuilder_Model_Abstract extends Magento_PHPUnit_MockBuilder_Abstract
{
    /**
     * Model name
     *
     * @var string
     */
    protected $_model;

    /**
     * Prepared the strategy object for generating mocks in Magento
     *
     * @return Magento_PHPUnit_Core_MockGenerator_Model_Interface
     */
    abstract protected function _prepareMockGeneratorStrategy();

    /**
     * Constructor
     *
     * @param PHPUnit_Framework_TestCase $testCase
     * @param string $model
     */
    public function __construct(PHPUnit_Framework_TestCase $testCase, $model)
    {
        $this->testCase  = $testCase;
        $this->_model = $model;
        $this->className = $model;
        $this->_mockGeneratorStrategy = $this->_prepareMockGeneratorStrategy();
    }

    /**
     *
     *
     * @return Magento_PHPUnit_Core_MockGenerator_Model_Interface
     */
    protected function _getMockGeneratorStrategy()
    {
        return $this->_mockGeneratorStrategy;
    }

    /**
     * Returns model name
     *
     * @return string
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * Prepares builder's state or do some actions before calling $this->getMock()
     */
    protected function _prepareMock()
    {
        $mockClassName = $this->_getMockGeneratorStrategy()->generateMockClassName($this);
        $this->className = $mockClassName;
    }

    /**
     * Method which is called after getMock() method.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     */
    protected function _afterGetMock($mock)
    {
        $this->_getMockGeneratorStrategy()->afterGetMock($mock, $this);
    }
}
