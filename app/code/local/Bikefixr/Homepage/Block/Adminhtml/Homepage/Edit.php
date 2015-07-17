<?php

class Bikefixr_Homepage_Block_Adminhtml_Homepage_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'homepage';
        $this->_controller = 'adminhtml_homepage';
        
        $this->_updateButton('save', 'label', Mage::helper('homepage')->__('Save Block'));
        $this->_updateButton('delete', 'label', Mage::helper('homepage')->__('Delete Block'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('homepage_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'homepage_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'homepage_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('homepage_data') && Mage::registry('homepage_data')->getId() ) {
            return Mage::helper('homepage')->__("Edit Block '%s'", $this->htmlEscape(Mage::registry('homepage_data')->getTitle()));
        } else {
            return Mage::helper('homepage')->__('Add Block');
        }
    }
}