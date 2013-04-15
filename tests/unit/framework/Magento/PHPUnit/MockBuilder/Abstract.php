<?php

/**
 * Abstract class for mock object creators
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_MockBuilder_Abstract extends PHPUnit_Framework_MockObject_MockBuilder
{
    /**
     * Array of prepared functions which MockBuilder will automatically mock.
     *
     * @var array
     */
    protected $_simpleMethodReturnValues = array();

    /**
     * Own mock object property
     *
     * @var PHPUnit_Framework_MockObject_MockObject|object|null
     */
    protected $_ownMock = null;

    /**
     * Creates a mock object using a fluent interface.
     *
     * @return PHPUnit_Framework_MockObject_MockObject|object
     */
    public function getMock()
    {
        return $this->_getMockTemplateMethod();
    }

    /**
     * Creates a mock object for an abstract class using a fluent interface.
     *
     * @return PHPUnit_Framework_MockObject_MockObject|object
     */
    public function getMockForAbstractClass()
    {
        return $this->_getMockTemplateMethod(true);
    }

    /**
     * Sets own mock object to mock builder.
     * Can be used if you want to set your own fictive object and use it as 'mock' object (stub object).
     *
     * @param object $mock Your own preset mock object
     * @return Magento_PHPUnit_MockBuilder_Abstract
     */
    public function setOwnMock($mock)
    {
        $this->_ownMock = $mock;
        return $this;
    }

    /**
     * Returns your own mock object if you have set it using setOwnMock()
     *
     * @return object|null
     */
    public function getOwnMock()
    {
        return $this->_ownMock;
    }

    /**
     * Sets own methods in key-value pairs
     *
     * @param array $methods Methods array. Example of array with various items:
     *   array('getId' => '1', 'getName:once' => 'alex', 'load:5' => '*this*', 'save', 'createData')
     *   Elements in this array mean:
     *    'getId' => '1'  -  method 'getId()' in the mock object will always return value '1' and it can be called 'any' times
     *    'getName:once' => 'alex'  -  expects to be called only once and will return 'alex' value
     *    'load:5' => '*this*'  -  expects to be called 5 times and will return current mock object
     *    'save' and 'createData' will not be automatically prepared for mock object and should be described in a test manually.
     * @return Magento_PHPUnit_MockBuilder_Abstract
     */
    public function setMethods($methods)
    {
        if (!$methods) {
            return parent::setMethods($methods);
        }
        $this->_simpleMethodReturnValues = array();
        $resultMethods = array();
        foreach ($methods as $method => $value) {
            if (is_int($method) || ctype_digit($method)) {
                $resultMethods[] = $value;
            } else {
                $methodParts = explode(':', $method);
                $this->_simpleMethodReturnValues[$method] = $value;
                $resultMethods[] = $methodParts[0];
            }
        }
        return parent::setMethods($resultMethods);
    }

    /**
     * Creates a mock object. Template method for both abstract and non-abstract classes.
     *
     * @param bool $forAbstract
     * @return PHPUnit_Framework_MockObject_MockObject|object
     */
    protected function _getMockTemplateMethod($forAbstract = false)
    {
        $this->_prepareMock();

        if (is_null($this->_ownMock)) {
            $mock = ($forAbstract ? parent::getMockForAbstractClass() : parent::getMock());
        } else {
            $mock = $this->_ownMock;
        }

        $this->_afterGetMock($mock);

        $this->_setSimpleMockMethods($mock);

        return $mock;
    }

    /**
     * Prepares simple methods stubs for mock object.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     */
    protected function _setSimpleMockMethods($mock)
    {
        //works only for PHPUnit_Framework_MockObject_MockObject mocks.
        if ($mock instanceof PHPUnit_Framework_MockObject_MockObject) {
            foreach ($this->_simpleMethodReturnValues as $method => $value) {

                //prepare method
                $methodParts = explode(':', $method);
                if (isset($methodParts[1])) {
                    if (is_int($methodParts[1]) || ctype_digit($methodParts[1])) {
                        /* @var $mock PHPUnit_Framework_MockObject_MockObject */
                        $invoker = $mock->expects(PHPUnit_Framework_TestCase::exactly($methodParts[1]));
                    } else {
                        $invoker = $mock->expects(call_user_func(array('PHPUnit_Framework_TestCase', $methodParts[1])));
                    }
                } else {
                    $invoker = $mock->expects(call_user_func(array('PHPUnit_Framework_TestCase', 'any')));
                }

                //prepare value
                if ($value == '*this*') {
                    $value = $mock;
                }

                //invoke
                $invoker->method($methodParts[0])
                    ->will(PHPUnit_Framework_TestCase::returnValue($value));
            }
        }
    }

    /**
     * Method which is called before getMock() method.
     */
    protected function _prepareMock()
    {
    }

    /**
     * Method which is called after getMock() method.
     *
     * @param PHPUnit_Framework_MockObject_MockObject|object $mock
     */
    protected function _afterGetMock($mock)
    {
    }
}
