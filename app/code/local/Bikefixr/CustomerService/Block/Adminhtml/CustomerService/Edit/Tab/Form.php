<?php

class Bikefixr_CustomerService_Block_Adminhtml_CustomerService_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
	  $form->setHtmlIdPrefix('cs_');
     
      $fieldset = $form->addFieldset('customerservice_form', array('legend'=>Mage::helper('customerservice')->__('Item information')));
	  
$model = Mage::registry('customerservice_data');
	   if ($model->getCustomerserviceId()) {
            $fieldset->addField('customerservice_id', 'hidden', array (
                    'name' => 'customerservice_id',
            ));
        }
     
      $fieldset->addField('cscategory', 'text', array(
          'label'     => Mage::helper('customerservice')->__('Category'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'cscategory',
      ));

	  
	  $fieldset->addField('cstab', 'select', array(
          'label'     => Mage::helper('customerservice')->__('Which Tab do you want this under?'),
          'name'      => 'cstab',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('customerservice')->__('Order Related Queries'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('customerservice')->__('Any Other Queries'),
              ),
          ),
      ));
   
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('customerservice')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('customerservice')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('customerservice')->__('Disabled'),
              ),
          ),
      ));
	  
	  
	  
	  
	  
	  
	  
	 $fieldset->addField('parentfaqcat', 'select', array(
          'label'     => Mage::helper('customerservice')->__('Select a Parent FAQ category'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'parentfaqcat',
		  'values'	  => Mage::helper('customerservice')->toOptionArray(),	
		  	    
		));
	  
	  /*
	     $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('customerservice')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('customerservice')->__('Content'),
          'title'     => Mage::helper('customerservice')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));*/
     
     /* if ( Mage::getSingleton('adminhtml/session')->getCustomerServiceData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCustomerServiceData());
          Mage::getSingleton('adminhtml/session')->setCustomerServiceData(null);
      } elseif ( Mage::registry('customerservice_data') ) {
          $form->setValues(Mage::registry('customerservice_data')->getData());
      }*/
      
	   $form->setValues($model->getData());
        $this->setForm($form);
		return parent::_prepareForm();
  }
}