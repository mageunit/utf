<?php

/**
 * Statement for local database adapter
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
interface Magento_PHPUnit_Db_Statement_Fetcher_Interface
{
    /**
     * Returns formatted result row or input row (in case if $row is null or false).
     *
     * @param array|bool $row
     * @return array|string|bool
     */
    public function fetch($row);
}
