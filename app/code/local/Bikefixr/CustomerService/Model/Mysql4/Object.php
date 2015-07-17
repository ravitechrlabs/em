<?php

class Bikefixr_CustomerService_Model_Mysql4_Object extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('customerservice/object', 'children_id');
    }
}