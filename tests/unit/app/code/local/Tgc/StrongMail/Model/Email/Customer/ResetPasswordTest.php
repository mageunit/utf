<?php
require_once dirname(__FILE__) .'/../../../../../../../../bootstrap.php';
/**
 * Description
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
class Tgc_StrongMail_Model_Email_Customer_ResetPasswordTest extends Tgc_StrongMail_Model_Email_TestCaseAbstract
{
    public function testSendSuccess()
    {
        $this->_createMailerFactoryMock();

        $this->setStoreConfig(Tgc_StrongMail_Model_Email_Customer_ResetPassword::XML_PATH_MAILING_NAME_RESET_PASSWORD, 'password_reset');

        $resetPasswordMailer = new Tgc_StrongMail_Model_Email_Customer_ResetPassword(array(
            'mailer_factory' => $this->_mailerFactory
        ));

        $customer = $this->getModelMockBuilder('customer/customer')
            ->setMethods(array('getName'))
            ->getMock();
        $customer->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('John Doe'));
        $customer->setData(array(
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com'
        ));

        $resetPasswordMailer->setCustomer($customer);
        $resetPasswordMailer->setStoreId(1);

        $resetPasswordMailer->send();

        $this->assertEquals('password_reset', $this->_mailer->getTransactionalMailingName());
        $this->assertCount(1, $this->_mailer->getEmailInfo());
        /* @var $emailInfo Mage_Core_Model_Email_Info */
        $emailInfo = $this->_mailer->getEmailInfo();
        $emailInfo = $emailInfo[0];
        $this->assertEquals(array('john@example.com'), $emailInfo->getToEmails());
        $this->assertEmpty($emailInfo->getBccEmails());
    }
}