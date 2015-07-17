<?php

class Ravi_Example_Block_Adminhtml_Example_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('example_form', array('legend'=>Mage::helper('example')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('example')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('example')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('example')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('example')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('example')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('example')->__('Content'),
          'title'     => Mage::helper('example')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getExampleData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getExampleData());
          Mage::getSingleton('adminhtml/session')->setExampleData(null);
      } elseif ( Mage::registry('example_data') ) {
          $form->setValues(Mage::registry('example_data')->getData());
      }
      return parent::_prepareForm();
  }
}