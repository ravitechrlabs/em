<?php
class Bikefixr_Homepage_Block_Adminhtml_Homepage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_homepage';
    $this->_blockGroup = 'homepage';
    $this->_headerText = Mage::helper('homepage')->__('Block Manager');
    $this->_addButtonLabel = Mage::helper('homepage')->__('Add Block');
    parent::__construct();
  }
}