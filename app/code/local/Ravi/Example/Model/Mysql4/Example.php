<?php

class Ravi_Example_Model_Mysql4_Example extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the example_id refers to the key field in your database table.
        $this->_init('example/example', 'example_id');
    }
}