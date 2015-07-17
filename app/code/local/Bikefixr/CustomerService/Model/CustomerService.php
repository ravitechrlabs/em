<?php

class Bikefixr_CustomerService_Model_CustomerService extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customerservice/customerservice');
    }
	
	
	
	public function loadord($ordernum,$csemail)
	{
		if(isset($ordernum) && !(isset($csemail)))
		{
			
		$order = Mage::getResourceModel('sales/order_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
         	->addFieldToFilter('increment_id',$ordernum)
            ->setOrder('created_at', 'desc');
			
		return $order;
	}
	
	else if(isset($ordernum) && isset($csemail)){
		
		$order = Mage::getResourceModel('sales/order_collection')
           	 ->addFieldToSelect('*')
			->addFieldToFilter('customer_email',$csemail);
			
			
			$size = $order->getSize();
		
			if($size==0)
			{
				echo '<div class="cs-failed-search">
				Are you sure you entered the email you gave when ordering ? Click the button below to try again.
				</div>';
				return $order;
			}
			
			else
			{
				$order->addFieldToFilter('increment_id',$ordernum);
				
				$cnt = count($order);
			
				if($cnt==0)
				{
					echo '<div class="cs-failed-search">
				Could not find your order. Please click the button below and try again
				</div>';
				}
				return $order;
			}
		
	
		}
	
	else
		{ 
						
			$order = Mage::getResourceModel('sales/order_collection')
			->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->addFieldToSelect('*')
            ->setOrder('created_at', 'desc');	
			return $order;	
			
			}
	}

	
	
}