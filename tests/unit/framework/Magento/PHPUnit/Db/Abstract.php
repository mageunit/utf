<?php

/**
 * Local DB abstract adapter.
 * Needed to implement abstract methods from parent abstract class.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
abstract class Magento_PHPUnit_Db_Abstract extends Zend_Db_Adapter_Abstract
{
    /**
     * Default class name for a DB statement.
     *
     * @var string
     */
    protected $_defaultStmtClass = 'Magento_PHPUnit_Db_Statement';

    /**
     * Temporary Stub. Empty method.
     *
     * @param string $tableName
     * @param string|null $schemaName
     */
    public function describeTable($tableName, $schemaName = null)
    {

    }

    /**
     * Temporary Stub. Empty method.
     */
    public function listTables()
    {
        // TODO Auto-generated method stub
    }

    /**
     * Initializes connection instance.
     */
    protected function _connect()
    {
        $this->_connection = Magento_PHPUnit_Db_FixtureConnection::getInstance();
    }

    /**
     * Is adapter connected.
     *
     * @return bool
     */
    public function isConnected()
    {
        return !is_null($this->_connection);
    }

    /**
     * Closes connection.
     */
    public function closeConnection()
    {
        $this->_connection->reset();
        $this->_connection = null;
    }

    /**
     * Prepares statement
     *
     * @param mixed $sql
     * @return Zend_Db_Statement
     */
    public function prepare($sql)
    {
        $class = $this->getStatementClass();
        return new $class($this, $sql);
    }

    /**
     * Runs SQL query. Implemented only for SELECT queries
     *
     * @param mixed $sql
     * @param array $bind temporary isn't used
     * @return Zend_Db_Statement
     * @todo Implement for other queries like INSERT or DELETE, etc.
     */
    public function query($sql, $bind = array())
    {
        $this->_connect();
        $statement = $this->prepare($sql);
        $this->getConnection()->query($statement, $sql, $bind);
        return $statement;
    }

    /**
     * Creates and returns a new Zend_Db_Select object for this adapter.
     *
     * @return Varien_Db_Select
     */
    public function select()
    {
        return new Varien_Db_Select($this);
    }

    /**
     * Temporary Stub. Empty method.
     *
     * @param string|null $tableName
     * @param string|null $primaryKey
     */
    public function lastInsertId($tableName = null, $primaryKey = null)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Temporary Stub. Empty method.
     */
    protected function _beginTransaction()
    {
        // TODO Auto-generated method stub
    }

    /**
     * Temporary Stub. Empty method.
     */
    protected function _commit()
    {
        // TODO Auto-generated method stub
    }

    /**
     * Temporary Stub. Empty method.
     */
    protected function _rollBack()
    {
        // TODO Auto-generated method stub
    }

    /**
     * Temporary Stub. Empty method.
     *
     * @param string $mode
     */
    public function setFetchMode($mode)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Limit method. Adds limit string like "LIMIT 5 OFFSET 2".
     *
     * @param string $sql
     * @param int $count
     * @param int $offset
     * @return string
     */
    public function limit($sql, $count, $offset = 0)
    {
        $count = intval($count);
        if ($count <= 0) {
            /** @see Zend_Db_Adapter_Exception */
            throw new Zend_Db_Adapter_Exception("LIMIT argument count=$count is not valid");
        }

        $offset = intval($offset);
        if ($offset < 0) {
            /** @see Zend_Db_Adapter_Exception */
            throw new Zend_Db_Adapter_Exception("LIMIT argument offset=$offset is not valid");
        }

        $sql .= " LIMIT $count";
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

        return $sql;
    }

    /**
     * Temporary Stub. Empty method.
     *
     * @param string $type
     */
    public function supportsParameters($type)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Returns server version
     *
     * @return string
     */
    public function getServerVersion()
    {
        // TODO Auto-generated method stub
        return '2.0';
    }
}
