<?php

/**
 * Statement fetcher. Works with FETCH_ROW fetch setting.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Statement_Fetcher_Assoc implements Magento_PHPUnit_Db_Statement_Fetcher_Interface
{
    /**
     * Returns formatted result row.
     *
     * @param array|bool $row
     * @return array|string|bool
     */
    public function fetch($row)
    {
        return $row;
    }
}
