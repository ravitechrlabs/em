<?php
class Bikefixr_CustomerService_Block_Csorders extends Mage_Core_Block_Template
{
	
	public function getOrderDetails($orderId)
		
		{
			$orderDetails = Mage::getModel('sales/order')->loadByIncrementId($orderId); 
			
			return $orderDetails;
		}
		
		public function getProducts($productId)
		
		{
			$products = Mage::getModel('catalog/product')->load($productId);
			
			return $products;
		}
		
		
		public function getOrders()
		
		{
			$orders = Mage::getModel('customerservice/customerservice')->loadord();
			
			return $orders;
			
		}
		
		public function getStatusColor($status)
		
		{
			if (strcasecmp($status, 'Complete') == 0)
			{
				 $class='status-green';
			} 
			
			else if(strcasecmp($status, 'Pending') == 0)
			{
				 $class = 'status-orange';
			}
			
			 else
			 { 
			 	$class='status-red';
			 } 
		
			return $class;
		}
		
	
}