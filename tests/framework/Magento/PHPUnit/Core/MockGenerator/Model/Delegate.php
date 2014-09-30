<?php

/**
 * Mock generator strategy, which creates model mocks through a proxy object.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_MockGenerator_Model_Delegate
    extends PHPUnit_Framework_MockObject_Generator
    implements Magento_PHPUnit_Core_MockGenerator_Model_Interface
{
    /**
     * Data pool code object key for keeping generated delegates.
     *
     * @var string
     */
    protected $_delegatesDataPoolCode;

    /**
     * Model helper.
     *
     * @var Magento_PHPUnit_Helper_Model_Model
     */
    protected $_modelHelper;

    /**
     * Global counter of generated delegates. Needs tom make classes names unique between tests.
     *
     * @var int
     */
    protected static $_delegateCount = 0;

    /**
     * Constructor
     *
     * @param string $delegatesDataPoolCode
     * @param Magento_PHPUnit_Helper_Model_Model $modelHelper
     */
    public function __construct(
        $delegatesDataPoolCode,
        Magento_PHPUnit_Helper_Model_Model $modelHelper
    ) {
        $this->_delegatesDataPoolCode = $delegatesDataPoolCode;
        $this->_modelHelper = $modelHelper;
    }

    /**
     * Returns data pool object, which contains delegates.
     *
     * @return Magento_PHPUnit_Core_DataPool_Delegate
     */
    public function getDelegatesDataPool()
    {
        return Magento_PHPUnit_Core_DataPool_Factory::getPoolObject(
            $this->_delegatesDataPoolCode
        );
    }

    /**
     * Returns model helper.
     *
     * @return Magento_PHPUnit_Helper_Model_Model
     */
    public function getModelHelper()
    {
        return $this->_modelHelper;
    }

    /**
     * Method which generates proxy mock class name and rewrites the model by this class in Magento config.
     *
     * @param Magento_PHPUnit_MockBuilder_Model_Model $mockBuilder
     * @return string
     */
    public function generateMockClassName(Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder)
    {
        $modelName = $mockBuilder->getModel();
        $delegateClassName = $this->getDelegatesDataPool()->getDelegateClassName($modelName);

        if (!$delegateClassName) {
            //create new delegate
            $delegateClassName = $this->_createDelegate($modelName);
            $this->getDelegatesDataPool()->setDelegateClassName($modelName, $delegateClassName);
        }

        //rewrite the model by the delegate class
        $this->getModelHelper()->rewriteModelByClass($modelName, $delegateClassName);

        return $this->getModelHelper()->getModelClass($modelName);
    }

    /**
     * The method should be run in MockBuilder after building the mock (getMock() method).
     * Adds mock object to the pool of mocks.
     *
     * @param object $mock
     * @param Magento_PHPUnit_MockBuilder_Model_Model $mockBuilder
     */
    public function afterGetMock($mock, Magento_PHPUnit_MockBuilder_Model_Abstract $mockBuilder)
    {
        $this->getDelegatesDataPool()
            ->addMockObject($mock, $mockBuilder->getModel(), $mockBuilder->getAsSingleton());
    }

    /**
     * Initializes delegate class code and put it into memory.
     *
     * @param string $model
     * @return string delegate class name
     */
    protected function _createDelegate($model)
    {
        $modelClass = $this->getModelHelper()->getModelClass($model);
        $delegateClassName = $this->_generateDelegateClassName($modelClass);
        if (!class_exists($delegateClassName, false)) {
            $delegateClassCode =
            "class {$delegateClassName} extends {$modelClass}
            {
                protected \$____mock____rtfsoi21wkw;
                public function __construct(\$args = array())
                {
                    \$this->____mock____rtfsoi21wkw =
                        Magento_PHPUnit_Core_DataPool_Factory::getPoolObject('{$this->_delegatesDataPoolCode}')
                        ->getMockObject('{$model}', \$args);
                }
                public function __call(\$method, \$args)
                {
                    return call_user_func_array(array(\$this->____mock____rtfsoi21wkw, \$method), \$args);
                }";
            $modelClassInfo = new ReflectionClass($modelClass);
            foreach ($modelClassInfo->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                if (!$method->isConstructor() &&
                    !$method->isStatic() &&
                    !$method->isAbstract() &&
                    !$method->isDestructor() &&
                    !$method->isFinal() &&
                    $method->getName() != '__call'
                ) {
                    $delegateClassCode .=
                    "public function {$method->getName()}(".
                        $this->getMethodParameters($method).
                    ") {
                        \$args = func_get_args();
                        return call_user_func_array(array(\$this->____mock____rtfsoi21wkw, '{$method->getName()}'), \$args);
                    }";
                }
            }
            $delegateClassCode .= "}";

            eval($delegateClassCode);
        }
        return $delegateClassName;
    }

    /**
     * Returns new delegate class name
     *
     * @param string $modelClass
     * @return string
     */
    protected function _generateDelegateClassName($modelClass)
    {
        return "MockDelegate_{$modelClass}_".(self::$_delegateCount++);
    }
}
