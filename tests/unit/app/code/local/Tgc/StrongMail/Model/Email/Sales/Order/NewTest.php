<?php
require_once dirname(__FILE__) .'/../../../../../../../../../bootstrap.php';
/**
 * Description
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
class Tgc_StrongMail_Model_Email_Sales_Order_NewTest  extends Tgc_StrongMail_Model_Email_TestCaseAbstract
{
    public function testSendSuccessForRegisteredCustomer()
    {
        $this->_createMailerFactoryMock();

        $newMailer = new Tgc_StrongMail_Model_Email_Sales_Order_New(array(
            'mailer_factory' => $this->_mailerFactory
        ));

        $order = Mage::getModel('sales/order');

        $order->setStoreId(1);
        $order->setIncrementId('10000001');
        $order->setCustomerIsGuest(0);
        $order->setCustomerEmail('john@example.com');
        $order->setCustomerFirstname('John');
        $order->setCustomerLastname('Doe');

        $this->setStoreConfig(Tgc_StrongMail_Model_Email_Sales_Order_New::XML_PATH_MAILING_NAME, 'order_new_registered');

        $newMailer->setOrder($order);

        $newMailer->send();

        //asserts
        $this->assertEquals(
            array(
                'ORDER_INCREMENT_ID' => '10000001',
                'FIRSTNAME' => 'John'
            ),
            $this->_mailer->getAdditionalParams()
        );
        $this->assertEquals('order_new_registered', $this->_mailer->getTransactionalMailingName());
        $this->assertCount(1, $this->_mailer->getEmailInfo());
        /* @var $emailInfo Mage_Core_Model_Email_Info */
        $emailInfo = $this->_mailer->getEmailInfo();
        $emailInfo = $emailInfo[0];
        $this->assertEquals(array('john@example.com'), $emailInfo->getToEmails());
    }
}