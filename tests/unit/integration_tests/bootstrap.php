<?php

$_rootDir = dirname(__FILE__). DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR. '..'. DIRECTORY_SEPARATOR. '..';
require_once $_rootDir . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Mage.php';

$stubsDir = dirname(__FILE__). DIRECTORY_SEPARATOR .
    '..' . DIRECTORY_SEPARATOR .
    'framework' . DIRECTORY_SEPARATOR .
    '_stubs';

set_include_path(
    $stubsDir . PATH_SEPARATOR .
    get_include_path() . PATH_SEPARATOR .
    dirname(__FILE__). DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'framework'
);
chdir($_rootDir);

//need to set own 'etc' dir for integration tests.
Magento_PHPUnit_Config::getInstance()->setDefaultEtcDir(
    $_rootDir . DIRECTORY_SEPARATOR .
    'app' . DIRECTORY_SEPARATOR .
    'etc'
);
//need to set no fixtures for intrgtation tests
Magento_PHPUnit_Config::getInstance()->setDefaultFixture('');

//need to initialize test App configuration in bootstrap
//because data providers in test cases are run before setUp() and even before setUpBeforeClass() methods in TestCase.
Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_App')
    ->run();
