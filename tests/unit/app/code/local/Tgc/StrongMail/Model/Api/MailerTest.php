<?php
require_once dirname(__FILE__) .'/../../../../../../../bootstrap.php';
/**
 * Description
 *
 * @author      Guidance Magento Team <magento@guidance.com>
 * @category    Tgc
 * @package     Tgc_StrongMail
 * @copyright   Copyright (c) 2013 Guidance Solutions (http://www.guidance.com)
 */
class Tgc_StrongMail_Model_Api_MailerTest extends Magento_PHPUnit_TestCase
{
    /**
     * @param string $mailingName
     * @param string $willReturnMailingId
     * @param bool $shouldTxnSendBeProcessed
     * @param string $expectedException
     * @dataProvider mailingIds
     */
    public function testSend($mailingName, $willReturnMailingId, $shouldTxnSendBeProcessed, $expectedException)
    {
        $emailInfo = Mage::getModel('core/email_info');
        $emailInfo->addTo('john@example.com', 'John Doe');

        $apiProcessor = $this->getMock('Tgc_StrongMail_Model_Api_Mailer_ProcessorInterface', array('getMailingId', 'txnSend'));
        $apiProcessor->expects($expectedException ? $this->any() : $this->atLeastOnce())
            ->method('getMailingId')
            ->with($this->equalTo($mailingName))
            ->will($this->returnValue($willReturnMailingId));
        $method = $apiProcessor->expects($shouldTxnSendBeProcessed ? $this->once() : $this->never())
            ->method('txnSend');
        if ($shouldTxnSendBeProcessed) {
            $method->with(
                $this->equalTo($emailInfo),
                $this->equalTo($willReturnMailingId),
                $this->anything()
            );
        }
        $method->will($this->returnValue(null));

        $mailer = new Tgc_StrongMail_Model_Api_Mailer(array(
            'processor' => $apiProcessor
        ));

        $mailer->addEmailInfo($emailInfo);
        $mailer->setTransactionalMailingName($mailingName);

        if ($expectedException) {
            $this->setExpectedException($expectedException);
        }

        $mailer->send();
    }

    public function mailingIds()
    {
        return array(
            array('order_new_guest', '111111', true, false),
            array(null, false, false, 'DomainException'),
            array('', false, false, 'DomainException'),
        );
    }
}