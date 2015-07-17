<?php
class Bikefixr_CustomerService_Block_CustomerService extends Mage_Core_Block_Template
{
	
		
	public function getCscollection()
	{
	 $collection = Mage::getModel('customerservice/customerservice')->getCollection();
                //$collection->setPageSize(5);
                //$collection->setCurPage(2);
                $size = $collection->getSize();
                $cnt = count($collection);	
				return $collection;
	}
	
	
	
	public function getChildcollection($csid){
		
		$children = Mage::getModel('customerservice/object')->getCollection();
		$children->addFieldToFilter('customerservice_id',$csid);
		$children->setOrder('sort_order', 'ASC');
		//$children->setPageSize(5);
        //$children->setCurPage(2);
        $size = $children->getSize();
		return $children;
		
	}
	
	
	
	public function getFaqcollection($faqcatid)
	{
		$faqcollection = Mage::getSingleton('hm_faq/faq')->getCollection();
		$faqcollection->addCategoryFilter($faqcatid);
		
		return $faqcollection;
	}
	
	public function getOrders()
	{
		$order = Mage::getResourceModel('sales/order_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->addFieldToFilter('state', array('in' => Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates()))
            ->setOrder('created_at', 'desc');
			
		return $order;
				
	}
	
	
	
}