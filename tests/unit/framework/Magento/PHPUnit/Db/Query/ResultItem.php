<?php

/**
 * Class which contains one query data.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Query_ResultItem
{
    /**
     * Error message, which was taken from '<error>' tag
     *
     * @var string
     */
    protected $_errorMessage;

    /**
     * Query result data
     *
     * @var mixed
     */
    protected $_result;

    /**
     * Sets error message for query (if we want to emulate wrong query)
     *
     * @param string $message
     * @return Magento_PHPUnit_Db_Query_ResultItem
     */
    public function setErrorMessage($message)
    {
        $this->_errorMessage = $message;
        return $this;
    }

    /**
     * Returns error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * Sets query result
     *
     * @param mixed $result
     * @return Magento_PHPUnit_Db_Query_ResultItem
     */
    public function setResult($result)
    {
        $this->_result = $result;
        return $this;
    }

    /**
     * Returns query result
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->_result;
    }
}
