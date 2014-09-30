<?php
/**
 * DB Dumper interface
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
interface Magento_PHPUnit_Initializer_DbDump_Interface
{
    /**
     * Uploads dump to the database. Dump should contain Drop Database and Create Database constructions.
     *
     * @param SimpleXMLElement $connectionNode
     * @param string $sourceDumpPath path to the dump source file
     */
    public function uploadDump(SimpleXMLElement $connectionNode, $sourceDumpPath);

    /**
     * Created the dump from current database.
     *
     * @param SimpleXMLElement $connectionNode
     * @param string $destinationDumpPath path to the dump destination file
     */
    public function dumpDatabase(SimpleXMLElement $connectionNode, $destinationDumpPath);
}