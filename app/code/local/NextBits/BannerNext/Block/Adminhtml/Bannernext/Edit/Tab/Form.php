<?php
class NextBits_BannerNext_Block_Adminhtml_Bannernext_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$model = Mage::registry('bannernext_data');	
		
		if($model->getStores())
		{		
			//$_model->setPageId(Mage::helper('core')->jsonDecode($_model->getPageId()));
			$model->setStores(explode(',',$model->getStores()));
		}
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('bannernext_form', array('legend'=>Mage::helper('bannernext')->__('General Information')));
		
		$fieldset->addField('title', 'text', array(
			'label'     => Mage::helper('bannernext')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,
			'name'      => 'title',
		));
		
		 $fieldset->addField('position', 'select', array(
            'label'     => Mage::helper('bannernext')->__('Position'),
            'name'      => 'position',
            'values'    => Mage::getSingleton('bannernext/config_source_position')->toOptionArray(),
            'value'     => $model->getPosition()
        ));
		
		$fieldset->addField('height', 'text', array(
			'label'     => Mage::helper('bannernext')->__('Height'),
			'required'  => false,
			'name'      => 'height',
			'class'     =>'validate-number',
			'note'   =>'E.g you want to height 100px then need to only 100 into textbox'
		));
		
		$fieldset->addField('width', 'text', array(
			'label'     => Mage::helper('bannernext')->__('Width'),
			'required'  => false,
			'name'      => 'width',
			'class'     =>'validate-number',
			'note'   =>'E.g you want to width 100px then need to only 100 into textbox'
		));
		
		 if (!Mage::app()->isSingleStoreMode()) {
			$field = $fieldset->addField('stores', 'multiselect', array(
				'name'      => 'stores[]',
				'label'     => Mage::helper('cms')->__('Store View'),
				'title'     => Mage::helper('cms')->__('Store View'),
				'required'  => true,			
				'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
				 'value'     => $model->getStores()
				//'value'     => array('0'=>'1','1'=>'2'),	
			));
			$renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
			$field->setRenderer($renderer);
		}
		else {
			$fieldset->addField('stores', 'hidden', array(
				'name'      => 'stores[]',
				'value'     => Mage::app()->getStore(true)->getId()
			));
			$model->setStoreId(Mage::app()->getStore(true)->getId());
		} 
		
	
		
		$fieldset->addField('status', 'select', array(
			'label'     => Mage::helper('bannernext')->__('Is Active'),
			'name'      => 'status',
			'values'    => array(
				array(
				'value'     => 1,
				'label'     => Mage::helper('bannernext')->__('Yes'),
				),
				array(
				'value'     => 2,
				'label'     => Mage::helper('bannernext')->__('No'),
				),
			),
		));
		
		$fieldset->addField('advanced_settings', 'textarea', array(
			'label'     => Mage::helper('bannernext')->__('Advanced Settings'),
			'required'  => false,
			'name'      => 'advanced_settings',
			'note'   	=> "Default : {numbers_align: 'right',animation:'fade',interval: 1000,dots: true,navigation: false}"
		)); 
		
		if (Mage::getSingleton('adminhtml/session')->getBannerNextData())
		{
			$form->setValues(Mage::getSingleton('adminhtml/session')->getBannerNextData());
			Mage::getSingleton('adminhtml/session')->setBannerNextData(null);
		} elseif ( Mage::registry('bannernext_data') ) {
			$form->setValues(Mage::registry('bannernext_data')->getData());
		}
		return parent::_prepareForm();
	}
}