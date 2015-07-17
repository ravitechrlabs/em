<?php

class Ravi_Example_Block_Adminhtml_Example_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'example';
        $this->_controller = 'adminhtml_example';
        
        $this->_updateButton('save', 'label', Mage::helper('example')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('example')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('example_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'example_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'example_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('example_data') && Mage::registry('example_data')->getId() ) {
            return Mage::helper('example')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('example_data')->getTitle()));
        } else {
            return Mage::helper('example')->__('Add Item');
        }
    }
}