<?php

/**
 * Test config object.
 * Contains some useful data for test framework.
 *
 * @category    Magento
 * @package     Magento_PHPUnit
 */
class Magento_PHPUnit_Config
{
    /**
     * Framework base path
     *
     * @var string
     */
    protected $_libBasePath;

    /**
     * Default etc dir
     *
     * @var string
     */
    protected $_defaultEtcDir;

    /**
     * Default fixture filepath
     *
     * @var string
     */
    protected $_defaultFixture;

    /**
     * Default database connection
     *
     * @var Mage_Core_Model_Resource_Abstract
     */
    protected $_defaultConnection;

    /**
     * Instance of the object
     *
     * @var Magento_PHPUnit_Config
     */
    static protected $_instance;

    /**
     * Creates and returns instance of config
     *
     * @return Magento_PHPUnit_Config
     */
    static public function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Gets unit testing framework base path
     *
     * @return string
     */
    public function getLibBasePath()
    {
        if (!$this->_libBasePath) {
            $this->_libBasePath = realpath(dirname(__FILE__) . DS . '..' . DS . '..');
        }
        return $this->_libBasePath;
    }

    /**
     * Returns default 'etc' dir
     *
     * @return string
     */
    public function getDefaultEtcDir()
    {
        if (is_null($this->_defaultEtcDir)) {
            $this->_defaultEtcDir = $this->getLibBasePath() . DS . '_etc';
        }
        return $this->_defaultEtcDir;
    }

    /**
     * Sets default 'etc' dir
     *
     * @param string $dir
     * @return Magento_PHPUnit_Config
     */
    public function setDefaultEtcDir($dir)
    {
        $this->_defaultEtcDir = $dir;
        return $this;
    }

    /**
     * Returns default xml fixture filepath
     *
     * @return string
     */
    public function getDefaultFixture()
    {
        if (is_null($this->_defaultFixture)) {
            $this->_defaultFixture = $this->getLibBasePath() . DS . '_fixtures' . DS . 'default.xml';
        }
        return $this->_defaultFixture;
    }

    /**
     * Sets default xml fixture filepath
     *
     * @param string $fixturePath
     * @return Magento_PHPUnit_Config
     */
    public function setDefaultFixture($fixturePath)
    {
        $this->_defaultFixture = $fixturePath;
        return $this;
    }

    /**
     * Returns default DB connection
     *
     * @return Mage_Core_Model_Resource_Abstract
     */
    public function getDefaultConnection()
    {
        if (is_null($this->_defaultConnection)) {
            $this->_defaultConnection = Mage::getModel('core/resource')
                ->getConnection(Mage_Core_Model_Resource::DEFAULT_WRITE_RESOURCE);
        }
        return $this->_defaultConnection;
    }

    /**
     * Sets default DB connection
     *
     * @param Mage_Core_Model_Resource_Abstract $connection
     * @return Magento_PHPUnit_Config
     */
    public function setDefaultConnection($connection)
    {
        $this->_defaultConnection = $connection;
        return $this;
    }
}
