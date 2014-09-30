<?php

/**
 * Main TestCase class for Magento unit tests.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_Integration_TestCase extends Magento_PHPUnit_TestCase
{
    /**
     * Prepares initializers.
     * Is called in setUp method first. Can be overridden in testCases to add more initializers.
     */
    protected function prepareInitializers()
    {
        parent::prepareInitializers();
        Magento_PHPUnit_Initializer_Factory::getInitializer('Magento_PHPUnit_Initializer_App')
            ->setFixtures('');
        Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_Transaction');
    }

    /**
     * Returns DB connection object
     *
     * @return Mage_Core_Model_Resource_Abstract
     */
    protected function getConnection()
    {
        $transaction = Magento_PHPUnit_Initializer_Factory::getInitializer('Magento_PHPUnit_Initializer_Transaction');
        if ($transaction) {
            return $transaction->getConnection();
        }
        return Magento_PHPUnit_Config::getInstance()->getDefaultConnection();
    }
}
