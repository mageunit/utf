<?php

/**
 * Script which helps to export data from tables in your database to fixture XML.
 * Just need to do some changes in the code and run it:
 *  - your database connection data
 *  - tables to export or SELECT queries
 *  - path to result XML file.
 */

$_rootDir = dirname(__FILE__). DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR. '..'. DIRECTORY_SEPARATOR. '..'. DIRECTORY_SEPARATOR. '..';
require_once $_rootDir . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Mage.php';
set_include_path( get_include_path() . PATH_SEPARATOR . dirname(__FILE__). DIRECTORY_SEPARATOR . '..');
chdir($_rootDir);

$db = Zend_Db::factory('pdo_mysql', array(
    'username' => 'root',
    'password' => '',
    'dbname' => 'trunk',
    'host' => 'localhost'
));
$db->query('SET CHARACTER SET utf8');
$db->query('SET NAMES utf8');

$exporter = Magento_PHPUnit_Db_FixtureConnection::getInstance();
$exporter->exportToXml(
    $db,
    array('core_store', 'core_store_group', 'core_website'),
    array(),
    dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_fixtures' . DIRECTORY_SEPARATOR . 'export.xml'
);
