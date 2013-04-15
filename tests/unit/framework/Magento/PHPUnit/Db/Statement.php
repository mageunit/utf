<?php

/**
 * Statement for local database adapter
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Statement extends Zend_Db_Statement
{
    /**
     * Result array
     *
     * @var array
     */
    protected $_result = array();

    /**
     * Rows count in result
     *
     * @var int
     */
    protected $_rowCount = 0;

    /**
     * Empty method. We don't need it for this statement
     */
    public function closeCursor()
    {
    }

    /**
     * Empty method. We don't need it for this statement
     */
    public function columnCount()
    {
    }

    /**
     * Empty method. We don't need it for this statement
     */
    public function errorCode()
    {
    }

    /**
     * Empty method. We don't need it for this statement
     */
    public function errorInfo()
    {
    }

    /**
     * Returns next data from result array.
     *
     * @param int|null $style one of Zend_Db::FETCH_* constants
     * @param null $cursor isn't used
     * @param null $offset isn't used
     * @return array of field-value pairs
     */
    public function fetch($style = null, $cursor = null, $offset = null)
    {
        $value = current($this->_result);
        next($this->_result);
        return Magento_PHPUnit_Db_Statement_Fetcher_Factory::getFetcher($style)->fetch($value);
    }

    /**
     * Sets result array from local server (from Magento_PHPUnit_Db_FixtureConnection)
     *
     * @param array $result
     */
    public function setResult($result)
    {
        $this->_result = $result;
        if (is_array($this->_result)) {
            $this->_rowCount = count($result);
            reset($this->_result);
        } elseif (is_numeric($result) || is_null($result)) {
            $this->_rowCount = $result;
        }
    }

    /**
     * Empty method. We don't need it for this statement
     */
    public function nextRowset()
    {
    }

    /**
     * Returns row count in result
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->_rowCount;
    }

    /**
     * Execute method's stub.
     *
     * @param array $params
     * @return array
     */
    protected function _execute($params)
    {
        return array();
    }
}
