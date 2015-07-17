<?php

class Bikefixr_CustomerService_Model_Object extends Mage_Core_Model_Abstract
{
	
	
	public function _construct()
    {
		
        parent::_construct();
        $this->_init('customerservice/object');
		
		
    }
	

    public function getChildren($parentId)
    {
	
	
				//$currentCategory = Mage::getModel('customerservice/object')->getCategoryId($this)->addFieldToFilter('customerservice_id', $parentId);
				//echo '<h1>' . $currentCategory . '</h1>';
				//die();
        return Mage::getModel('customerservice/object')->getCollection()->addFieldToFilter('customerservice_id', $parentId);
		
                  
					
    }
	
	
}

