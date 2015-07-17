<?php
class Bikefixr_CustomerService_Block_Adminhtml_CustomerService extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_customerservice';
    $this->_blockGroup = 'customerservice';
    $this->_headerText = Mage::helper('customerservice')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('customerservice')->__('Add Item');
    parent::__construct();
  }
}