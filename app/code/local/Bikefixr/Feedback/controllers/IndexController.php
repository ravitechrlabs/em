<?php
class Bikefixr_Feedback_IndexController extends Mage_Core_Controller_Front_Action
{

    public function OrderAssistanceAction()
    {
    	//Get current layout state
        $this->loadLayout();   
 
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'bikefixr.feedback',
            array(
                'template' => 'feedback/orderassistance.phtml'
            )
        );
 
        $this->getLayout()->getBlock('content')->append($block);
        //$this->getLayout()->getBlock('right')->insert($block, 'catalog.compare.sidebar', true);
 
        $this->_initLayoutMessages('core/session');
 
        $this->renderLayout();
		 $block1 = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'bikefixr.feedback',
            array(
                'template' => 'feedback/orderassistance.phtml'
            )
        );
    }
	
	public function CustomerAssistanceAction()
	{
		$block1 = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'bikefixr.feedback',
            array(
                'template' => 'feedback/customerassistance.phtml'
            )
        );
		  $this->loadLayout(); 
		$this->getLayout()->getBlock('content')->append($block1);
		  $this->renderLayout();
	}
	public function CancelOrderAction()
	{
		$block1 = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'bikefixr.feedback',
            array(
                'template' => 'feedback/cancelorder.phtml'
            )
        );
		  $this->loadLayout(); 
		$this->getLayout()->getBlock('content')->append($block1);
		  $this->renderLayout();
	}
	public function ReturnOrderAction()
	{
		$block1 = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'bikefixr.feedback',
            array(
                'template' => 'feedback/returnorder.phtml'
            )
        );
		  $this->loadLayout(); 
		$this->getLayout()->getBlock('content')->append($block1);
		  $this->renderLayout();
	}
 
    public function sendemailOrderAssistanceAction()
    {//email-us what seems to be issue tab
			$adminmail=Mage::getStoreConfig('trans_email/ident_support/email');
        //Fetch submited params
		//admin email
        $params = $this->getRequest()->getParams();
        $adminemail = new Zend_Mail();
        $adminemail->setBodyText("Notification of issue regarding ".$params['issue']." for the ".$params['orderno']." containing the following item ".$params['itemname']."."." Kindly do the Needful."."\n\n\n  Message : \n\t\t".$params['user-msg']."\n\n Customer Details: \n".$params['username']." ".$params['email']);
        $adminemail->setFrom($params['email']);
        $adminemail->addTo($adminmail);
        $adminemail->setSubject("Notification of issue regarding ".$params['issue']." for the ".$params['orderno']." containing the following item ".$params['itemname'].".");
		//notification mail for user
		$usermail= new Zend_Mail();
		$usermail->setBodyText("Hello ".$params['username']." Your issue for the order number ".$params['orderno']." containing the following item ".$params['itemname']." has been taken."."\n Will be processed within 24 hours.\n\nPlease note: this e-mail was sent from a notification-only address that cannot accept incoming e-mail. Please do not reply to this message.");
        $usermail->setFrom($adminmail);
        $usermail->addTo($params['email']);
        $usermail->setSubject("Your issue regarding ".$params['issue']." for the ".$params['orderno']." containing the following item ".$params['itemname']." has been taken.");
		
        try {
			
            $adminemail->send();
			$usermail->send();
			echo	'<div class="success-msg">Message Sent!!</div>'; 	
			//throw new Exception('Division by zero.');
        }        
        catch(Exception $ex) {
			echo	'<div class="fail-msg">Could not send the message. Please try again!!</div>'; 	
           // Mage::getSingleton('core/session')->addError('Unable to send email. Kindly try after sometime.');
        }
 
        //Redirect back to index action of (this) bikefixr-feedback controller
	

       // $this->_redirect('customerservice/');
		
    }
	public function sendemailCustomerAssistanceAction()
	
    {//email-us  customer assistance tab
		$adminmail=Mage::getStoreConfig('trans_email/ident_support/email');
        //Fetch submited params
		//admin email
        $params = $this->getRequest()->getParams();
        $adminemail = new Zend_Mail();
        $adminemail->setBodyText("Notification of issue regarding ".$params['issue']." Kindly do the Needful."."\n\n\n  Message : \n\t\t".$params['user-msg']."\n\n Customer Details: \n".$params['username']." ".$params['email']);
        $adminemail->setFrom($params['email']);
        $adminemail->addTo($adminmail);
        $adminemail->setSubject("Notification of issue regarding ".$params['issue'].".");
		//notification mail for user
		$usermail= new Zend_Mail();
		$usermail->setBodyText("Hello ".$params['username']."/n Your issue ".$params['issue']." Will be processed within 24 hours.\n\nPlease note: this e-mail was sent from a notification-only address that cannot accept incoming e-mail. Please do not reply to this message.");
        $usermail->setFrom($adminmail);
        $usermail->addTo($params['email']);
        $usermail->setSubject("Your issue regarding ".$params['issue']." has been noted.");
		
        try {
            $adminemail->send();
			$usermail->send();
			echo '<div class="success-msg">Message Sent!!</div>'; 	
        }        
        catch(Exception $ex) {
            
			echo '<div class="fail-msg">Could not send the message. Please try again!!</div>'; 	
			//Mage::getSingleton('core/session')->addError('Unable to send email. Kindly try after sometime.');
 
        }
 
        //Redirect back to index action of (this) bikefixr-feedback controller
       // $this->_redirect('customerservice/');
    }
	public function sendemailCancelOrderAction()
	
    {//cancelorder
			
        //Fetch submited params
		//admin email
		$adminmail=Mage::getStoreConfig('trans_email/ident_support/email');
        $params = $this->getRequest()->getParams();
        $adminemail = new Zend_Mail();
        $adminemail->setBodyText("Since ".$params['reason']." for the order number ".$params['orderno']." containing the following item \n".$params['itemname']." Kindly Cancel My Order"."\n\n\n  Message : \n\t\t".$params['user-msg']."\n\n Customer Details: \n".$params['username']." ".$params['email']);
        $adminemail->setFrom($params['email']);
        $adminemail->addTo($adminmail);
        $adminemail->setSubject("I want to Cancel My Order since,".$params['reason']." for the order number ".$params['orderno']);
		
		//notification mail for user
		$usermail= new Zend_Mail();
		$usermail->setBodyText("Hello ".$params['username']."/n Your Cancel-Order Request for the order number ".$params['orderno']." containing the following item ".$params['itemname']." has been taken."."\n Will be cancelled within 24 hours.\n\nPlease note: this e-mail was sent from a notification-only address that cannot accept incoming e-mail. Please do not reply to this message.");
        $usermail->setFrom($adminmail);
        $usermail->addTo($params['email']);
        $usermail->setSubject("Your Cancel Order Request has been taken for the order number,".$params['orderno']." containing the following item ".$params['itemname']);
		
		 try {
			 $adminemail->send();
			$usermail->send();
			echo '<div class="success-msg">Message Sent!! Your order will be cancelled within next 24 hours</div>';
        }        
        catch(Exception $ex) {
            //Mage::getSingleton('core/session')->addError('Unable to send email. Kindly try after sometime.');
 			echo	'<div class="fail-msg">Could not send the message. Please try again!!</div>'; 	
        }
		
        
 
        //Redirect back to index action of (this) bikefixr-feedback controller
        //$this->_redirect('customerservice/');
    }
	public function sendemailReturnOrderAction()
	
    {//return order
		//Fetch submited params
		//admin email 
		$adminmail=Mage::getStoreConfig('trans_email/ident_support/email');
        $params = $this->getRequest()->getParams();
        $adminemail = new Zend_Mail();
        $adminemail->setBodyText("Since ".$params['reason']." for the order number ".$params['orderno']." containing the following item \n".$params['itemname']." I want to Return My Order"."\n\n\n  Message : \n\t\t".$params['user-msg']."\n\n Customer Details: \n".$params['username'].$params['email']);
        $adminemail->setFrom($params['email']);
        $adminemail->addTo($adminmail);
        $adminemail->setSubject("I want to Return My Order since,".$params['reason']." for the order number ".$params['orderno']);
		
		//notification mail for user
		$usermail= new Zend_Mail();
		$usermail->setBodyText("Hello ".$params['username']."/n Your Return-Order Request for the order number ".$params['orderno']." containing the following item ".$params['itemname']." has been taken."."\n Will be processed within 24 hours.\n\nPlease note: this e-mail was sent from a notification-only address that cannot accept incoming e-mail. Please do not reply to this message.");
        $usermail->setFrom($adminmail);
        $usermail->addTo($params['email']);
        $usermail->setSubject("Your Return Order Request has been taken for the order number,".$params['orderno']." containing the following item ".$params['itemname']);
		
		 try {
			 $adminemail->send();
			$usermail->send();
			echo '<div class="success-msg">Message Sent!! You will be contacted within 24 hours.</div>';
        }        
        catch(Exception $ex) {
            //Mage::getSingleton('core/session')->addError('Unable to send email. Kindly try after sometime.');
 			echo	'<div class="fail-msg">Could not send the message. Please try again!!</div>'; 
        }

        //Redirect back to index action of (this) bikefixr-feedback controller
        //$this->_redirect('customerservice/');
    }
	
	
}
 
?>