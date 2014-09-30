<?php
/**
 * MySQL dumper
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Initializer_DbDump_Mysql implements Magento_PHPUnit_Initializer_DbDump_Interface
{
    /**
     * Creates DB dump
     *
     * @param SimpleXMLElement $connectionNode
     * @param string $destinationDumpPath
     */
    public function dumpDatabase(SimpleXMLElement $connectionNode, $destinationDumpPath)
    {
        $destinationDumpDir = dirname($destinationDumpPath);
        if (!file_exists($destinationDumpDir)) {
            @mkdir($destinationDumpDir, 0775, true);
        }

        system('mysqldump --add-drop-database --single-transaction -h ' . escapeshellarg((string)$connectionNode->host) .
            ' -u ' . escapeshellarg((string)$connectionNode->username) .
            ' --password=' . escapeshellarg((string)$connectionNode->password) .
            ' -B ' . escapeshellarg((string)$connectionNode->dbname) .
            ' > ' . escapeshellarg($destinationDumpPath)
        );
        //replace "definer"
        $dumpText = file_get_contents($destinationDumpPath);
        file_put_contents($destinationDumpPath, preg_replace('/DEFINER[ ]*=[ ]*[^*]*\*/is', '*', $dumpText));
    }

    /**
     * Uploads dump to the DB
     *
     * @param SimpleXMLElement $connectionNode
     * @param string $sourceDumpPath
     */
    public function uploadDump(SimpleXMLElement $connectionNode, $sourceDumpPath)
    {
        system('mysql -h ' . escapeshellarg((string)$connectionNode->host) .
            ' -u ' . escapeshellarg((string)$connectionNode->username) .
            ' --password=' . escapeshellarg((string)$connectionNode->password) .
            ' ' . escapeshellarg((string)$connectionNode->dbname) .
            ' < ' . escapeshellarg($sourceDumpPath)
        );
    }
}
