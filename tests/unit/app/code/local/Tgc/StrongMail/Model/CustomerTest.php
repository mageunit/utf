<?php
require_once dirname(__FILE__) .'/../../../../../../bootstrap.php';
/**
 * Description
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
class Tgc_StrongMail_Model_CustomerTest extends Magento_PHPUnit_TestCase
{
    public function testSendPasswordResetConfirmationEmailSuccess()
    {
        $this->setStoreConfig(Mage_Customer_Model_Customer::XML_PATH_FORGOT_EMAIL_IDENTITY, 'admin@tgc.com');

        $customer = Mage::getModel('customer/customer');
        $customer->setStoreId(1);

        $emailSender = $this->getModelMockBuilder('tgc_strongMail/email_customer_resetPassword')
            ->setMethods(array('send'))
            ->getMock();

        $emailSender->expects($this->once())
            ->method('send')
            ->will($this->returnValue(null));

        $customer->sendPasswordResetConfirmationEmail();

        $this->assertEquals($customer, $emailSender->getCustomer());
        $this->assertEquals(1, $emailSender->getStoreId());

        return $this;
    }
}