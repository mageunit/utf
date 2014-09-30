<?php

/**
 * TestCase for controllers
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_Integration_ControllerTestCase extends Magento_PHPUnit_Integration_TestCase
{
    protected $_mageRunCode; //'1' like storeId. Null is default
    protected $_mageRunType; // like 'store'. Null is default
    protected $_mageRunOptions; // like array('etc_dir' => ...). Null is default

    /**
     * Prepares initializers.
     * Is called in setUp method first. Can be overridden in testCases to add more initializers.
     */
    protected function prepareInitializers()
    {
        parent::prepareInitializers();
        Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_HeadersAlreadySent')
            ->setThrowException(false);
    }

    /**
     * Dispatch controler action
     *
     * @param string $action
     * @param string|null $controller
     * @param string|null $module
     * @param string|null $params
     * @param bool $isAdminAction
     *
     * @return string
     */
    protected function dispatch(
        $action, $controller = null, $module = null, array $params = null, $isAdminAction = false)
    {
        ob_start();
        try {
            $request = $this->getRequest();

            if (!is_null($params)) {
                $request->setParams($params);
            }

            if (!is_null($controller)) {
                $request->setControllerName($controller);

                // Module should only be reset if controller has been specified
                if (!is_null($module)) {
                    $request->setModuleName($module);
                }
            }

            // hack to avoid redirect to base_url and exit statement
            $request->setPost('redirect_hack', '1');

            //Mock some objects for dispatch admin actions
            if ($isAdminAction) {
                $user = Mage::getModel('admin/user')->setId(1);
                $adminSessionMock = $this->getSingletonMockBuilder('admin/session')
                    ->setMethods(array('isLoggedIn', 'getUser'))
                    ->getMock();
                $adminSessionMock->expects($this->any())
                    ->method('isLoggedIn')
                    ->will($this->returnValue(true));
                $adminSessionMock->expects($this->any())
                    ->method('getUser')
                    ->will($this->returnValue($user));

                $adminUrlMock = $this->getSingletonMockBuilder('adminhtml/url')
                    ->setMethods(array('useSecretKey'))
                    ->getMock();
                $adminSessionMock->expects($this->any())
                    ->method('useSecretKey')
                    ->will($this->returnValue(false));
            }

            $request->setActionName($action)->setDispatched(false);

            $appInitializer = Magento_PHPUnit_Initializer_Factory::createInitializer(
                'Magento_PHPUnit_Initializer_App', false
            );
            $appInitializer->setRunCode($this->_mageRunCode)
                ->setRunType($this->_mageRunType)
                ->setRunOptions($this->_mageRunOptions)
                ->initDefault();
            Mage::app()->run(array(
                'scope_code' => $appInitializer->getRunCode(),
                'scope_type' => $appInitializer->getRunType(),
                'options'    => $appInitializer->getRunOptions()
            ));

            return ob_get_clean();
        } catch (Exception $e) {
            ob_get_clean();
            throw $e;
        }
    }

    /**
     * Get request object
     *
     * @return Mage_Core_Controller_Request_Http
     */
    protected function getRequest()
    {
        return Mage::app()->getRequest();
    }

    /**
     * Get response object
     *
     * @return Mage_Core_Controller_Response_Http
     */
    protected function getResponse()
    {
        return Mage::app()->getResponse();
    }
}
