<?php

/**
 * TestSuite main class
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_TestSuite extends PHPUnit_Framework_TestSuite
{
    /**
     * The pattern for TestCase files
     *
     * @var string
     */
    protected static $_caseFileMask = '*Test.php';

    /**
     * Find TestCases by path and add to Base TestSuite
     *
     * @param PHPUnit_Framework_TestSuite $suite
     * @param string $path
     */
    protected static function _findTests(PHPUnit_Framework_TestSuite $suite, $path)
    {
        // check exists TestSuite
        $path = rtrim($path, DS) . DS;

        // processing current directories
        $dirs = glob($path . '*', GLOB_ONLYDIR);
        foreach ($dirs as $dirPath) {
            self::_findTests($suite, $dirPath);
        }

        // find and add test cases
        $cases = glob($path . self::$_caseFileMask);
        $suite->addTestFiles($cases);
    }

    /**
     * Initialize application
     */
    public static function runApp()
    {
        // emulate session_start process
        if (!isset($_SESSION) || !is_array($_SESSION)) {
            $_SESSION = array();
        }
    }
}
