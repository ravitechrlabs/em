<?php
class Bikefixr_CustomerService_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    				
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	
	public function fetchRecentAction()
    {	
	
		$this->loadLayout();
			$free= $this->getRequest()->getParams();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('customerservice/recent');
		Mage::register('ordnumber', $free["ordnum"]);
		$this->renderLayout();
		 
    }
	
	
	public function fetchSearchAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('customerservice/search');
		$this->renderLayout();
		 
    }
	
	
	public function fetchCsemailAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('feedback/orderassistance');
		$this->renderLayout();
		 
    }
	
	
		public function fetchOtheremailAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('feedback/customerassistance');
		$this->renderLayout();
		 
    }
	
public function fetchCsordersAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('customerservice/csorders');
		$this->renderLayout();
		 
    }
	
	
public function fetchFreeAction()
{
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
	$free= $this->getRequest()->getParams();
	
		$block=$this->getLayout()->getBlockSingleton('customerservice/free');
		Mage::register('ordnum', $free["ordnum"]);
		Mage::register('csemail', $free["csemail"]);
		$this->renderLayout();
	
		
}


public function fetchCsloginAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('customerservice/cslogin');
		$this->renderLayout();
		 
    }

public function CancelorderAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('feedback/cancelorder');
		$this->renderLayout();
		 
    }
	

public function ReturnorderAction()
    {	
	
		$this->loadLayout();
		/*$this->getLayout()->getBlockSingleton('customerservice/csemail');*/
		$this->getLayout()->getBlock('feedback/returnorder');
		$this->renderLayout();
		 
    }
	

	
}


