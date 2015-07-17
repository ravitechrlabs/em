<?php

class Bikefixr_CustomerService_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function toOptionArray($addEmpty =true)
    {
        $options = array();
		$options[0] =  '- Please Select -';
		
		$faqcatcollection = Mage::getModel('hm_faq/category')->getCollection();
		$faqcatcollection->setPageSize(5);
        $faqcatcollection->setCurPage(2);
        foreach($faqcatcollection as $faqcategory){
            $options[$faqcategory['category_id']]=  $faqcategory['category_name'];
        }
        return $options;
    }
}