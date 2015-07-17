<?php


class HM_Faq_Block_Adminhtml_Category_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
		$this->setForm($form);
		//$form->setHtmlIdPrefix('faq_buttons_');
        $fieldset = $form->addFieldset('faq_form', array('legend'=>Mage::helper('hm_faq')->__('General')));

        //[...]       

        $urlsField = $fieldset->addField('urls', 'text', array(
            'name'      => 'urls',
            'label'     => Mage::helper('hm_faq')->__('Urls'),
            'required'  => false,
        ));


	
    $urlsField = $form->getElement('urls');
	
	
   $urlsField->setRenderer(
   	
        $this->getLayout()->createBlock('hm_faq/adminhtml_category_edit_renderer_urls')
    );

	        


   // [...]
    return parent::_prepareForm();
    }
	

}