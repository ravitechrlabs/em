<?php


class Bikefixr_CustomerService_Block_Adminhtml_CustomerService_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		
        $form = new Varien_Data_Form();
		$this->setForm($form);
		$form->setHtmlIdPrefix('customerservice_children_');
        $fieldset = $form->addFieldset('customerservice_form', array('legend'=>Mage::helper('customerservice')->__('Children')));

        //[...]       

        $childrenField = $fieldset->addField('children', 'text', array(
            'name'      => 'children',
            'label'     => Mage::helper('customerservice')->__('Children'),
            'required'  => false,
        ));


	
    $childrenField = $form->getElement('children');
	
	
   $childrenField->setRenderer(
   	
        $this->getLayout()->createBlock('customerservice/adminhtml_customerservice_edit_renderer_children')
    );

	        


   // [...]
    return parent::_prepareForm();
    }
	

}

