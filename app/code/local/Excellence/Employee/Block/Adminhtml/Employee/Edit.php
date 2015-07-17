<?php

class Excellence_Employee_Block_Adminhtml_Employee_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'employee';
        $this->_controller = 'adminhtml_employee';
        
        $this->_updateButton('save', 'label', Mage::helper('employee')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('employee')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('employee_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'employee_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'employee_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('employee_data') && Mage::registry('employee_data')->getId() ) {
            return Mage::helper('employee')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('employee_data')->getTitle()));
        } else {
            return Mage::helper('employee')->__('Add Item');
        }
    }
}