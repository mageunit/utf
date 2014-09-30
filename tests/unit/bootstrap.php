<?php

//include_once('autoload.php'); //PHPUnit 4 support.
$_rootDir = dirname(__FILE__). DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR. '..';
require_once $_rootDir . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Mage.php';
set_include_path(
    get_include_path() . PATH_SEPARATOR .
    dirname(__FILE__). DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'framework' . PATH_SEPARATOR .
    $_rootDir . '/tests/unit/app/code/core' . PATH_SEPARATOR .
    $_rootDir . '/tests/unit/app/code/local'
);
chdir($_rootDir);



//need to initialize test App configuration in bootstrap
//because data providers in test cases are run before setUp() and even before setUpBeforeClass() methods in TestCase.
Magento_PHPUnit_Initializer_Factory::createInitializer('Magento_PHPUnit_Initializer_App')
    ->run();
