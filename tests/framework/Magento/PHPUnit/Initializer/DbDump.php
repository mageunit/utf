<?php
/**
 * Initializer for Integration tests: uploads the DB from dump
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Initializer_DbDump extends Magento_PHPUnit_Initializer_Abstract
{
    protected $_connectionName = 'default_setup';

    private static $_wasExecuted = false;

    /**
     * Runs initialization process.
     */
    public function run()
    {
        if ($this->_canExecute()) {
            $config = simplexml_load_file(
                Magento_PHPUnit_Config::getInstance()
                ->getDefaultEtcDir() . DIRECTORY_SEPARATOR . 'local.xml'
            );

            $connectionNode = $config->global->resources->default_setup->connection;
            $dumper = Magento_PHPUnit_Initializer_DbDump_Factory::getDumperByModel((string)$connectionNode->model);
            $dumper->dumpDatabase($connectionNode, $this->_getDumpPath() . '_old');
            $dumper->uploadDump($connectionNode, $this->_getDumpPath());

            $this->_saveDumpMd5();

            self::$_wasExecuted = true;
        }
    }

    /**
     * Rollback all changes after the test is ended (on tearDown)
     */
    public function reset()
    {
    }

    /**
     * Returns main dump path
     *
     * @return string
     */
    protected function _getDumpPath()
    {
        return Magento_PHPUnit_Config::getInstance()->getDatabaseDumpPath();
    }

    /**
     * Can the DB dump be uploaded or not
     *
     * @return bool
     */
    protected function _canExecute()
    {
        if (self::$_wasExecuted) {
            return false;
        }

        $md5file = Magento_PHPUnit_Config::getInstance()->getDatabaseMd5File();
        if (!file_exists($md5file)) {
            return true;
        }

        $newMd5Value = md5_file($this->_getDumpPath());
        $oldMd5Value = trim(file_get_contents($md5file));
        if ($newMd5Value != $oldMd5Value) {
            return true;
        }

        return false;
    }

    /**
     * Saves MD5 of current dump into a specific file.
     */
    protected function _saveDumpMd5()
    {
        $md5file = Magento_PHPUnit_Config::getInstance()->getDatabaseMd5File();
        $md5fileDir = dirname($md5file);
        if (!file_exists($md5fileDir)) {
            @mkdir($md5fileDir, 0775, true);
        }
        file_put_contents($md5file, md5_file($this->_getDumpPath()));
    }
}