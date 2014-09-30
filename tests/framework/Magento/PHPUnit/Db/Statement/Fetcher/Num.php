<?php

/**
 * Statement fetcher. Works with FETCH_NUM fetch setting.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Db_Statement_Fetcher_Num implements Magento_PHPUnit_Db_Statement_Fetcher_Interface
{
    /**
     * Returns formatted result row.
     *
     * @param array|bool $row
     * @return array|string|bool
     */
    public function fetch($row)
    {
        if (is_array($row)) {
            return array_values($row);
        }
        return $row;
    }
}
