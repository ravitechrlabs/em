<?php

class Bikefixr_CustomerService_Model_Mysql4_CustomerService_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customerservice/customerservice');
    }
}