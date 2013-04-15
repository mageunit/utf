<?php

/**
 * DbAdapter mock object creator for constructions such as
 * $this->_getReadAdapter(), $this->_getWriteAdapter() or $this->_getConnection('core_read'),
 * which are called in Resource models.
 * It can be useful for creating mocks for adapter methods such as 'query', 'delete', 'insert', 'fetchAll', etc.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_MockBuilder_DbAdapter extends Magento_PHPUnit_MockBuilder_Abstract
{
    /**
     * Connection name
     *
     * @var string
     */
    protected $_connectionName;

    /**
     * Constructor
     *
     * @param PHPUnit_Framework_TestCase $testCase
     * @param string $connectionName Example: 'core_read'
     */
    public function __construct(PHPUnit_Framework_TestCase $testCase, $connectionName)
    {
        $this->testCase  = $testCase;
        $this->_connectionName = $connectionName;
        $this->className = $this->_getConnectionHelper()->getConnectionClassName($connectionName);
        $this->setConstructorArgs(array($this->_getConnectionHelper()->getConnectionConfig($connectionName)));
    }

    /**
     * Returns connection's name. Only getter.
     * For another connection please create another builder.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return $this->_connectionName;
    }

    /**
     * Returns PHPUnit connection's helper.
     *
     * @return Magento_PHPUnit_Helper_Connection
     */
    protected function _getConnectionHelper()
    {
        return Magento_PHPUnit_Helper_Factory::getHelper('connection');
    }

    /**
     * Method which is called after getMock() method.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     */
    protected function _afterGetMock($mock)
    {
        $this->_setMockToConfig($mock);
    }

    /**
     * Sets mock object to Config connection array.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     */
    protected function _setMockToConfig($mock)
    {
        $this->_getConnectionHelper()->setConnection($this->getConnectionName(), $mock);
    }
}
