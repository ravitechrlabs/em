<?php

class Bikefixr_CustomerService_Block_Adminhtml_Customerservice_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('customerservice_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('customerservice')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('customerservice')->__('Item Information'),
          'title'     => Mage::helper('customerservice')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('customerservice/adminhtml_customerservice_edit_tab_form')->toHtml(),
      ));
	  
	 $this->addTab('children', array(
			'label' => Mage::helper('customerservice')->__('Add Children'),
			'title' => Mage::helper('customerservice')->__('Add Children'),
                'content' => $this->getLayout()->createBlock('customerservice/adminhtml_customerservice_edit_tab_general')->toHtml(),
                
				
				)
			);
     
      return parent::_beforeToHtml();
  }
}