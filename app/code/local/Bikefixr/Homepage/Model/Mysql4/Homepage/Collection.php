<?php

class Bikefixr_Homepage_Model_Mysql4_Homepage_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('homepage/homepage');
    }
}