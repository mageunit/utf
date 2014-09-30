<?php

/**
 * Interface for Local DB query processors.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
interface Magento_PHPUnit_Db_Query_Interface
{
    /**
     * Process SQL query and sets result into statement from Local Db Server
     *
     * @param Zend_Db_Statement_Interface $statement
     * @param Magento_PHPUnit_Db_FixtureConnection $connection
     * @param string|Zend_Db_Select $sql
     * @param array $bind
     */
    public function process($statement, $connection, $sql, $bind = array());

    /**
     * Checks if this query processor can process passed SQL query.
     *
     * @param string|Zend_Db_Select $sql
     * @return bool
     */
    public function test($sql);

    /**
     * Parses and sets fixture data with queries information to a container
     *
     * @param SimpleXMLElement $fixture
     */
    public function setFixtureData($fixture);
}
