<?php

/**
 * TestCase for controllers
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_ControllerTestCase extends Magento_PHPUnit_TestCase
{
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
