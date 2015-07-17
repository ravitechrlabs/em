<?php

class Bikefixr_CustomerService_Model_Mysql4_CustomerService extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the customerservice_id refers to the key field in your database table.
        $this->_init('customerservice/customerservice', 'customerservice_id');
    }
}