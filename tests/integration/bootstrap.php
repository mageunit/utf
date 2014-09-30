<?php

$_rootDir = dirname(__FILE__). DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR. '..';
require_once $_rootDir . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Mage.php';

set_include_path(
    get_include_path() . PATH_SEPARATOR .
    dirname(__FILE__). DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'framework' . PATH_SEPARATOR .
    $_rootDir . '/tests/integration/app/code/core' . PATH_SEPARATOR .
    $_rootDir . '/tests/integration/app/code/local'
);
chdir($_rootDir);

//need to set own 'etc' dir for integration tests.
Magento_PHPUnit_Config::getInstance()->setDefaultEtcDir(
    dirname(__FILE__). DIRECTORY_SEPARATOR . '_etc'
);
//need to set no fixtures for integration tests
Magento_PHPUnit_Config::getInstance()->setDefaultFixture('');

//upload dump, if needed
Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_DbDump')
    ->run();

//need to initialize test App configuration in bootstrap
//because data providers in test cases are run before setUp() and even before setUpBeforeClass() methods in TestCase.
Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_App')
    ->run();
