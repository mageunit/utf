<?php
/**
 * Description
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
abstract class Tgc_StrongMail_Model_Email_TestCaseAbstract extends Magento_PHPUnit_TestCase
{
    protected $_mailer;
    protected $_mailerFactory;

    protected function setUp()
    {
        parent::setUp();

        $this->_mailer = null;
        $this->_mailerFactory = null;
    }

    protected function _createMailerFactoryMock()
    {
        $this->_mailer = $this->getMockBuilder('Tgc_StrongMail_Model_Api_Mailer')
            ->disableOriginalConstructor()
            ->setMethods(array('send'))
            ->getMock();
        $this->_mailer->expects($this->once())
            ->method('send')
            ->will($this->returnValue(null));

        $this->_mailerFactory = $this->getMock('Tgc_StrongMail_Model_Api_Mailer_Factory_Interface');

        $this->_mailerFactory->expects($this->any())
            ->method('create')
            ->will($this->returnValue($this->_mailer));
    }
}