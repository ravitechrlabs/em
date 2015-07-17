<?php

class HM_Faq_Model_Object extends Mage_Core_Model_Abstract
{
	
	
	public function _construct()
    {
		
        parent::_construct();
        $this->_init('hm_faq/object');
		
		
    }
	

    public function getUrls($parentId)
    {
	
	
			//	$currentCategory = Mage::getModel('hm_faq/category')->getCategoryId($this)->addFieldToFilter('category_id', $this->getCategoryId());
        return Mage::getModel('hm_faq/object')->getCollection()->addFieldToFilter('category_id', $parentId);
                  
					
    }
	
	
}

