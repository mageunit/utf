<?php

/**
 * Local DB adapter.
 * Needed to implement interface methods.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Adapter extends Magento_PHPUnit_Db_Abstract implements Varien_Db_Adapter_Interface
{
    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function describeTable($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }
    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     * @return Varien_Db_Ddl_Table
     */
    public function newTable($tableName = null, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param Varien_Db_Ddl_Table $table
     * @return Zend_Db_Statement_Interface
     */
    public function createTable(Varien_Db_Ddl_Table $table)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function dropTable($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function truncateTable($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function isTableExists($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function showTableStatus($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $newTableName
     * @return Varien_Db_Ddl_Table
     */
    public function createTableByDdl($tableName, $newTableName)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $definition
     * @param unknown_type $flushData
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Pdo_Mysql
     */
    public function modifyColumnByDdl($tableName, $columnName, $definition, $flushData = false, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $oldTableName
     * @param unknown_type $newTableName
     * @param unknown_type $schemaName
     */
    public function renameTable($oldTableName, $newTableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $definition
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function addColumn($tableName, $columnName, $definition, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $oldColumnName
     * @param unknown_type $newColumnName
     * @param unknown_type $definition
     * @param unknown_type $flushData
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function changeColumn(
        $tableName, $oldColumnName, $newColumnName, $definition, $flushData = false, $schemaName = null
    ) {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $definition
     * @param unknown_type $flushData
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function modifyColumn($tableName, $columnName, $definition, $flushData = false, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $schemaName
     */
    public function dropColumn($tableName, $columnName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $schemaName
     */
    public function tableColumnExists($tableName, $columnName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $indexName
     * @param unknown_type $fields
     * @param unknown_type $indexType
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function addIndex($tableName, $indexName, $fields, $indexType = self::INDEX_TYPE_INDEX, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $keyName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function dropIndex($tableName, $keyName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function getIndexList($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $fkName
     * @param unknown_type $tableName
     * @param unknown_type $columnName
     * @param unknown_type $refTableName
     * @param unknown_type $refColumnName
     * @param unknown_type $onDelete
     * @param unknown_type $onUpdate
     * @param unknown_type $purge
     * @param unknown_type $schemaName
     * @param unknown_type $refSchemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function addForeignKey(
        $fkName,
        $tableName,
        $columnName,
        $refTableName,
        $refColumnName,
        $onDelete = self::FK_ACTION_CASCADE,
        $onUpdate = self::FK_ACTION_CASCADE,
        $purge = false,
        $schemaName = null,
        $refSchemaName = null
    ) {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $fkName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function dropForeignKey($tableName, $fkName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function getForeignKeys($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $table
     * @param array $data
     * @param array $fields
     */
    public function insertOnDuplicate($table, array $data, array $fields = array())
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $table
     * @param array $data
     */
    public function insertMultiple($table, array $data)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $table
     * @param array $columns
     * @param array $data
     */
    public function insertArray($table, array $columns, array $data)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $table
     * @param array $bind
     */
    public function insertForce($table, array $bind)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Inserts a table row with specified data.
     *
     * @param mixed $table The table to insert data into.
     * @param array $bind Column-value pairs.
     * @return int The number of affected rows.
     */
    public function insertIgnore($table, array $bind)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $sql
     * @return Varien_Db_Adapter_Interface
     */
    public function multiQuery($sql)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @param unknown_type $includeTime
     */
    public function formatDate($date, $includeTime = true)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @return Varien_Db_Adapter_Interface
     */
    public function startSetup()
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @return Varien_Db_Adapter_Interface
     */
    public function endSetup()
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $adapter
     * @return Varien_Db_Adapter_Interface
     */
    public function setCacheAdapter($adapter)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @return Varien_Db_Adapter_Interface
     */
    public function allowDdlCache()
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @return Varien_Db_Adapter_Interface
     */
    public function disallowDdlCache()
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function resetDdlCache($tableName = null, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableCacheKey
     * @param unknown_type $ddlType
     * @param unknown_type $data
     * @return Varien_Db_Adapter_Interface
     */
    public function saveDdlCache($tableCacheKey, $ddlType, $data)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableCacheKey
     * @param unknown_type $ddlType
     */
    public function loadDdlCache($tableCacheKey, $ddlType)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $fieldName
     * @param unknown_type $condition
     */
    public function prepareSqlCondition($fieldName, $condition)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param array $column
     * @param unknown_type $value
     */
    public function prepareColumnValue(array $column, $value)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $condition
     * @param unknown_type $true
     * @param unknown_type $false
     * @return Zend_Db_Expr
     */
    public function getCheckSql($condition, $true, $false)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $expression
     * @param unknown_type $value
     * @return Zend_Db_Expr
     */
    public function getIfNullSql($expression, $value = 0)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param array $data
     * @param unknown_type $separator
     * @return Zend_Db_Expr
     */
    public function getConcatSql(array $data, $separator = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $string
     * @return Zend_Db_Expr
     */
    public function getLengthSql($string)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param array $data
     * @return Zend_Db_Expr
     */
    public function getLeastSql(array $data)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param array $data
     * @return Zend_Db_Expr
     */
    public function getGreatestSql(array $data)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @param unknown_type $interval
     * @param unknown_type $unit
     * @return Zend_Db_Expr
     */
    public function getDateAddSql($date, $interval, $unit)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @param unknown_type $interval
     * @param unknown_type $unit
     * @return Zend_Db_Expr
     */
    public function getDateSubSql($date, $interval, $unit)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @param unknown_type $format
     * @return Zend_Db_Expr
     */
    public function getDateFormatSql($date, $format)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @return Zend_Db_Expr
     */
    public function getDatePartSql($date)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $date
     * @param unknown_type $unit
     * @return Zend_Db_Expr
     */
    public function getDateExtractSql($date, $unit)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Returns table name
     *
     * @param string $tableName
     * @return string
     */
    public function getTableName($tableName)
    {
        return $tableName;
    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $fields
     * @param unknown_type $indexType
     */
    public function getIndexName($tableName, $fields, $indexType = '')
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $priTableName
     * @param unknown_type $priColumnName
     * @param unknown_type $refTableName
     * @param unknown_type $refColumnName
     */
    public function getForeignKeyName($priTableName, $priColumnName, $refTableName, $refColumnName)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function disableTableKeys($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     * @return Varien_Db_Adapter_Interface
     */
    public function enableTableKeys($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param Varien_Db_Select $select
     * @param unknown_type $table
     * @param array $fields
     * @param unknown_type $mode
     */
    public function insertFromSelect(Varien_Db_Select $select, $table, array $fields = array(), $mode = false)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param Varien_Db_Select $select
     * @param unknown_type $table
     */
    public function updateFromSelect(Varien_Db_Select $select, $table)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param Varien_Db_Select $select
     * @param unknown_type $table
     */
    public function deleteFromSelect(Varien_Db_Select $select, $table)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableNames
     * @param unknown_type $schemaName
     */
    public function getTablesChecksum($tableNames, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     */
    public function supportStraightJoin()
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param Varien_Db_Select $select
     * @param unknown_type $field
     * @return Varien_Db_Adapter_Interface
     */
    public function orderRand(Varien_Db_Select $select, $field = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $sql
     */
    public function forUpdate($sql)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $tableName
     * @param unknown_type $schemaName
     */
    public function getPrimaryKeyName($tableName, $schemaName = null)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Enter description here ...
     *
     * @param unknown_type $value
     */
    public function decodeVarbinary($value)
    {
        // TODO Auto-generated method stub

    }

    /**
     * Prepare substring sql function
     *
     * @param Zend_Db_Expr|string $stringExpression quoted field name or SQL statement
     * @param int|string|Zend_Db_Expr $pos
     * @param int|string|Zend_Db_Expr|null $len
     * @return Zend_Db_Expr
     */
    public function getSubstringSql($stringExpression, $pos, $len = null)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Prepare standard deviation sql function
     *
     * @param Zend_Db_Expr|string $expressionField   quoted field name or SQL statement
     * @return Zend_Db_Expr
     */
    public function getStandardDeviationSql($expressionField)
    {
        // TODO Auto-generated method stub
    }

    /**
     * Returns date that fits into TYPE_DATETIME range and is suggested to act as default 'zero' value
     * for a column for current RDBMS. Deprecated and left for compatibility only.
     * In Magento at MySQL there was zero date used for datetime columns. However, zero date it is not supported across
     * different RDBMS. Thus now it is recommended to use same default value equal for all RDBMS - either NULL
     * or specific date supported by all RDBMS.
     *
     * @deprecated after 1.5.1.0
     * @return string
     */
    public function getSuggestedZeroDate()
    {
        // TODO Auto-generated method stub
    }

    /**
     * Get adapter transaction level state. Return 0 if all transactions are complete
     *
     * @return int
     */
    public function getTransactionLevel()
    {
        return 0;
    }

    /**
     * Create temporary table from DDL object
     *
     * @param Varien_Db_Ddl_Table $table
     * @throws Zend_Db_Exception
     * @return Zend_Db_Statement_Interface
     */
    public function createTemporaryTable(Varien_Db_Ddl_Table $table)
    {
        // TODO: Implement createTemporaryTable() method.
    }

    /**
     * Drop temporary table from database
     *
     * @param string $tableName
     * @param string $schemaName
     * @return boolean
     */
    public function dropTemporaryTable($tableName, $schemaName = null)
    {
        // TODO: Implement dropTemporaryTable() method.
    }

    /**
     * Rename several tables
     *
     * @param array $tablePairs array('oldName' => 'Name1', 'newName' => 'Name2')
     *
     * @return boolean
     * @throws Zend_Db_Exception
     */
    public function renameTablesBatch(array $tablePairs)
    {
        // TODO: Implement renameTablesBatch() method.
    }

    /**
     * Generate fragment of SQL, that check value against multiple condition cases
     * and return different result depends on them
     *
     * @param string $valueName Name of value to check
     * @param array $casesResults Cases and results
     * @param string $defaultValue value to use if value doesn't confirm to any cases
     *
     * @return Zend_Db_Expr
     */
    public function getCaseSql($valueName, $casesResults, $defaultValue = null)
    {
        // TODO: Implement getCaseSql() method.
    }

    /**
     * Get insert queries in array for insert by range with step parameter
     *
     * @param string $rangeField
     * @param Varien_Db_Select $select
     * @param int $stepCount
     * @return array
     */
    public function selectsByRange($rangeField, Varien_Db_Select $select, $stepCount = 100)
    {
        // TODO: Implement selectsByRange() method.
    }

    /**
     * Drop trigger
     *
     * @param string $triggerName
     * @return Varien_Db_Adapter_Interface
     */
    public function dropTrigger($triggerName)
    {
        // TODO: Implement dropTrigger() method.
    }

    /**
     * Convert date format to unix time
     *
     * @param string|Zend_Db_Expr $date
     * @return mixed
     */
    public function getUnixTimestamp($date)
    {
        // TODO: Implement getUnixTimestamp() method.
    }

    /**
     * Convert unix time to date format
     *
     * @param int|Zend_Db_Expr $timestamp
     * @return mixed
     */
    public function fromUnixtime($timestamp)
    {
        // TODO: Implement fromUnixtime() method.
    }

    /**
     * Change table auto increment value
     *
     * @param string $tableName
     * @param string $increment
     * @param null|string $schemaName
     * @return Zend_Db_Statement_Interface
     */
    public function changeTableAutoIncrement($tableName, $increment, $schemaName = null)
    {
        // TODO: Implement changeTableAutoIncrement() method.
    }

	/**
     * Create new table from provided select statement
     *
     * @param string $tableName
     * @param Zend_Db_Select $select
     * @param bool $temporary
     * @return mixed
     */
    public function createTableFromSelect($tableName, Zend_Db_Select $select, $temporary = false)
	{
        // TODO: Implement createTableFromSelect() method.
	}
}
