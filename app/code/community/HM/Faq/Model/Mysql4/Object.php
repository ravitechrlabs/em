<?php

class HM_Faq_Model_Mysql4_Object extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('hm_faq/object', 'url_id');
    }
}