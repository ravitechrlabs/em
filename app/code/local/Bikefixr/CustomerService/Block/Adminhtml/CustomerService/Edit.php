<?php

class Bikefixr_CustomerService_Block_Adminhtml_CustomerService_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'customerservice';
        $this->_controller = 'adminhtml_customerservice';
        
        $this->_updateButton('save', 'label', Mage::helper('customerservice')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('customerservice')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('customerservice_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'customerservice_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'customerservice_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('customerservice_data') && Mage::registry('customerservice_data')->getId() ) {
            return Mage::helper('customerservice')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('customerservice_data')->getTitle()));
        } else {
            return Mage::helper('customerservice')->__('Add Item');
        }
    }
}