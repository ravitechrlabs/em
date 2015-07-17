<?php





class HM_Faq_Model_Mysql4_Object_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    
    
    /**
     * Constructor
     *
     */
    public function _construct()
    {
		parent::_construct();
        $this->_init('hm_faq/object');
    }
	
	
	
	
}