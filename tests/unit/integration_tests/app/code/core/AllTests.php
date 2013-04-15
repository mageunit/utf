<?php

require_once dirname(__FILE__).'/../../../bootstrap.php';

/**
 * Test runner for available UnitTests in current folder
 */
class Core_AllTests extends Magento_PHPUnit_TestSuite
{
    /**
     * Suite name
     *
     * @var string
     */
    public static $suitName = "Core Code Pool Tests";

    /**
     * Find TestCases by path and add to Base TestSuite
     *
     * If found TestSuite in path, add TestSuite only
     *
     */
    public static function suite()
    {
        self::runApp();
        $suite = new self(self::$suitName);
        self::_findTests($suite, dirname(__FILE__));

        return $suite;
    }
}
