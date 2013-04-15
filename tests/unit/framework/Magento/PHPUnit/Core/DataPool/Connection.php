<?php

/**
 * Simple class for pool of data.
 * Key-value data.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Core_DataPool_Connection
{
    /**
     * Connection data
     *
     * @var array array(key => value)
     */
    protected $_data = array();

    /**
     * Value getter by key.
     *
     * @param string $key
     * @return mixed
     */
    public function getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : false;
    }

    /**
     * Value setter for key
     *
     * @param string $key
     * @param mixed $value
     * @return Magento_PHPUnit_Core_DataPool_Connection
     */
    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }
}
