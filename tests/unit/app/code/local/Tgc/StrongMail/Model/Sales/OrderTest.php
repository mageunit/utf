<?php
require_once dirname(__FILE__) .'/../../../../../../../bootstrap.php';
/**
 * new order mail test
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
class Tgc_StrongMail_Model_Sales_OrderTest extends Magento_PHPUnit_TestCase
{
    /**
     * @var Magento_PHPUnit_MockBuilder_Model_Model
     */
    protected $_emailSender;
    /**
     * @var Magento_PHPUnit_MockBuilder_Model_Model
     */
    protected $_order;

    protected function setUp()
    {
        parent::setUp();

        $this->_emailSender = $this->getModelMockBuilder('tgc_strongMail/email_sales_order_new')
            ->setMethods(array('send'))
            ->getMock();

         //"new" is not used, because we need to test if the order model have been rewritten by some other module incorrectly or not
        $this->_order = $this->getModelMockBuilder('sales/order')
            ->setMethods(array('load', '_getResource', 'getId'))
            ->getMock();

        $this->setStoreConfig(Mage_Sales_Model_Order::XML_PATH_EMAIL_ENABLED, 1);
    }

    public function testSendNewOrderEmailSuccess()
    {
        //email sender mock

        $this->_emailSender->expects($this->once())
            ->method('send')
            ->will($this->returnValue(null));

        $order = $this->_order;

        $resource = $this->getResourceModelMockBuilder('sales/order')
            ->setMethods(array('saveAttribute'))
            ->getMock();
        $resource->expects($this->atLeastOnce())
            ->method('saveAttribute')
            ->with($this->equalTo($order), $this->equalTo('email_sent'))
            ->will($this->returnSelf());

        $order->expects($this->atLeastOnce())
            ->method('load')
            ->will($this->returnSelf());
        $order->expects($this->any())
            ->method('_getResource')
            ->will($this->returnValue($resource));
        $order->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(100));

        $order->setStoreId(1);
        $order->setData('email_sent', 0);
        $order->sendNewOrderEmail();

        //assert
        $this->assertEquals($order, $this->_emailSender->getOrder());
    }

    public function testSendNewOrderEmailAlreadySent()
    {
        //test, if the order model have been rewritten by some other module incorrectly
        $order = $this->_order;

        $this->_emailSender->expects($this->never())
            ->method('send')
            ->will($this->returnValue(null));

        $order->expects($this->atLeastOnce())
            ->method('load')
            ->will($this->returnSelf());
        $order->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(100));

        $order->setStoreId(1);
        $order->setData('email_sent', 1);
        $order->sendNewOrderEmail();
    }

    public function testSendNewOrderEmailNotificationIsDisabled()
    {
        $this->setStoreConfig(Mage_Sales_Model_Order::XML_PATH_EMAIL_ENABLED, 0);

        //test, if the order model have been rewritten by some other module incorrectly
        $order = $this->_order;

        $this->_emailSender->expects($this->never())
            ->method('send')
            ->will($this->returnValue(null));

        $order->setStoreId(1);
        $order->setData('email_sent', 0);
        $order->sendNewOrderEmail();
    }
}