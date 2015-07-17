<?php
class Ravi_Example_Block_Adminhtml_Example extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_example';
    $this->_blockGroup = 'example';
    $this->_headerText = Mage::helper('example')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('example')->__('Add Item');
    parent::__construct();
  }
}