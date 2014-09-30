<?php

/**
 * Local database server with fixtures data.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_FixtureConnection
{
    /**
     * Default value for loadFromTable flag
     *
     * @var bool
     */
    const DEFAULT_LOAD_FROM_TABLE = false;

    /**
     * Tables data taken from fixture
     *
     * @var array array('table1' => array(array('field' => value, ...), array('field' => value, ...), ...), 'table2' => ...)
     */
    protected $_tables = array();

    /**
     * Select-queries data taken from fixture
     *
     * @var array array of queryKey => queryObject
     */
    protected $_queryModels = array();

    /**
     * Should we load data from table or from select array.
     *
     * @var bool
     */
    protected $_loadFromTable = self::DEFAULT_LOAD_FROM_TABLE;

    /**
     * Instance of server
     *
     * @var Magento_PHPUnit_Db_FixtureConnection
     */
    static protected $_instance;

    /**
     * Creates and returns instance of the object
     *
     * @return Magento_PHPUnit_Db_FixtureConnection
     */
    static public function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Protected constructor of singleton
     */
    protected function __construct()
    {
        $this->reset();
    }

    /**
     * Cannot clone singleton
     */
    protected function __clone()
    {
    }

    /**
     * Reset data in singleton
     */
    public function reset()
    {
        $this->_tables = array();
        $this->_queryModels = Magento_PHPUnit_Db_Query_Factory::getAllQueryModels();
        $this->_loadFromTable = self::DEFAULT_LOAD_FROM_TABLE;
    }

    /**
     * Returns if the server should load data from table or query
     *
     * @return bool
     */
    public function getLoadFromTable()
    {
        return $this->_loadFromTable;
    }

    /**
     * Sets flag if the server should load data from table or query
     *
     * @param bool $loadFromTable
     * @return Magento_PHPUnit_Db_FixtureConnection
     */
    public function setLoadFromTable($loadFromTable)
    {
        $this->_loadFromTable = $loadFromTable;
        return $this;
    }

    /**
     * Load fixtures from paths to _tables and _selects array
     *
     * @param array|string $paths
     * @return Magento_PHPUnit_Db_FixtureConnection
     */
    public function loadFixtures($paths)
    {
        if (!is_array($paths)) {
            $paths = array($paths);
        }
        foreach ($paths as $path) {
            if ($path) {
                $fixture = $this->_getFixture($path);
                //load tables data from XML
                if ($fixture->tables) {
                    foreach ($fixture->tables->children() as $tableNode) {
                        if (!isset($this->_tables[$tableNode->getName()])) {
                            $this->_tables[$tableNode->getName()] = array();
                        }
                        if ($tableNode->rows) {
                            foreach ($tableNode->rows->children() as $rowNode) {
                                $row = array();
                                foreach ($rowNode->children() as $fieldNode) {
                                    $row[$fieldNode->getName()] = (string)$fieldNode;
                                }
                                $this->_tables[$tableNode->getName()][] = $row;
                            }
                        }
                    }
                }

                foreach ($this->_queryModels as $query) {
                    $query->setFixtureData($fixture);
                }
            }
        }
        return $this;
    }

    /**
     * Loads fixture from XML file path
     *
     * @param string $fullpath
     * @throws Magento_PHPUnit_Db_Exception
     * @return SimpleXMLElement
     */
    protected function _getFixture($fullpath)
    {
        if (!file_exists($fullpath)) {
            throw new Magento_PHPUnit_Db_Exception('Fixture file does not exists');
        }
        if (!is_readable($fullpath)) {
            throw new Magento_PHPUnit_Db_Exception('Fixture file does not readable');
        }

        return simplexml_load_file($fullpath);
    }

    /**
     * Selects right query model, which can operate the query.
     *
     * @param string|Zend_Db_Select $sql
     * @return mixed
     */
    protected function _getQueryModel($sql)
    {
        foreach ($this->_queryModels as $queryModel) {
            if ($queryModel->test($sql)) {
                return $queryModel;
            }
        }
        throw new Magento_PHPUnit_Db_Exception("Query model does not exist for query: ".((string)$sql));
    }

    /**
     * Base method for server operations like 'select', 'delete', etc.
     * Sets result to $statement object
     *
     * @param Zend_Db_Statement_Interface $statement
     * @param string|Zend_Db_Select $sql
     * @param array $bind
     */
    public function query($statement, $sql, $bind = array())
    {
        $this->_getQueryModel($sql)->process($statement, $this, $sql, $bind);
    }

    /**
     * Gets data from only table name
     *
     * @param string $table
     * @return array
     */
    public function selectFromTable($table)
    {
        return isset($this->_tables[$table]) ? $this->_tables[$table] : array();
    }

    /**
     * Helper method to export data to XML from tables, queries.
     *
     * @param Zend_Db_Adapter_Abstract $adapter
     * @param array|string $tables
     * @param array|string $selects
     * @param string $toFile
     * @throws Exception
     */
    public function exportToXml(Zend_Db_Adapter_Abstract $adapter, $tables, $selects, $toFile)
    {
        if (!is_array($tables)) {
            $tables = array($tables);
        }
        if (!is_array($selects)) {
            $selects = array($selects);
        }
        $xml = new SimpleXMLElement('<dataset></dataset>');
        //export tables data
        $xmlTables = $xml->addChild('tables');
        foreach ($tables as $table) {
            $select = $adapter->select()
                ->from($table);

            $res = $adapter->query($select);
            $rowsNode = $xmlTables->addChild($table)
                ->addChild('rows');
            while ($row = $res->fetch()) {
                $rowNode = $rowsNode->addChild('row');
                foreach ($row as $field => $value) {
                    $rowNode->addChild($field, $value);
                }
            }
        }

        //export SELECT queries data
        $xmlSelects = $xml->addChild('selects');
        foreach ($selects as $select) {
            $res = $adapter->query($select);
            $selectNode = $xmlSelects->addChild('select');
            $selectNode->addChild('query', (string)$select);
            $rowsNode = $selectNode->addChild('rows');
            while ($row = $res->fetch()) {
                $rowNode = $rowsNode->addChild('row');
                foreach ($row as $field => $value) {
                    $rowNode->addChild($field, $value);
                }
            }
        }
        if ($xml->asXML($toFile) === false) {
            throw new Exception('Cannot export tables to fixture file');
        }
    }
}
