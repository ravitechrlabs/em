<?php

class Bikefixr_Homepage_Block_Adminhtml_Homepage_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset('homepage_form', array('legend'=>Mage::helper('homepage')->__('Block Information')));
			
		$fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('homepage')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('homepage')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('homepage')->__('Disabled'),
              	),
         	 ),
      	));
			
		$selectcategory = $fieldset->addField('category_id', 'select', array(
          'label'     => Mage::helper('homepage')->__('Select a category'),
          'class'     => 'required-entry validate-select',
          'required'  => true,
          'name'      => 'category_id',
		  'values'	  => Mage::helper('homepage')->toOptionArray(),	
		  'onchange'  => 'getsubcategory(this)',	    
		));
		
		$fieldset->addField('categoryicon', 'image', array(
          'label'     => Mage::helper('homepage')->__('Choose icon'),
          'required'  => true,
		  'class'	=> 'validate-icon',
          'name'      => 'categoryicon',
		  'after_element_html' => '<p class="nm"><small> Please use 144 x 114 images</p>',
		));
		
	  
		$fieldset->addField('subcategory', 'multiselect', array(
          'name' 	=> 'subcategory',
          'label' 	=> Mage::helper('homepage')->__('Select the subcategories'),
          'title' 	=> Mage::helper('homepage')->__('Subcategories'),
          'required'=> true,
		  'class'   => 'validate-multiselect-sub',
		  'after_element_html' => '<p class="nm"><small> Maximum 6 Sub-Categories can be selected </small></p>',
		  'values' 	=> array(),
		));
		
		 $fieldset->addField('brands', 'multiselect', array(
          'name' 	=> 'brands',
          'label'	=> Mage::helper('homepage')->__('Select the brands'),
          'title' 	=> Mage::helper('homepage')->__('Brands'),
          'required'=> false,
		  'class'   => 'validate-multiselect-brands',
		  'after_element_html' => '<p class="nm"><small> Maximum 9 Brands can be selected </small></p>',
          'values' 	=> array(),
		));		

		$selectcategory->setAfterElementHtml("<script type=\"text/javascript\">
            function getsubcategory(selectElement){
				if(selectElement.value > 0){
					var reloadurl = '". $this->getUrl('homepage/adminhtml_homepage/subcategory') . "categoryid/' + selectElement.value;
					new Ajax.Request(reloadurl, {
						method: 'get',
						onLoading: function (subcategoryform) {
							$('subcategory').update('Searching...');
							$('brands').update('Searching...');
						},
						onComplete: function(subcategoryform) {
							var data = subcategoryform.responseText.evalJSON();
							if(data != ''){
								$('subcategory').update(data.sub_category);
								$('brands').update(data.brand);
							}else{
								alert('There are no Sub-Categories and Brands in the selected category.');
							}
						}
					});
				}
            }
        </script>");
		
		$fieldset->addField('bannerimage', 'image', array(
          'label'     => Mage::helper('homepage')->__('Choose an image for banner'),
          'required'  => false,
          'name'      => 'bannerimage',
	 	 ));
		 
		 $fieldset->addField('bannertext', 'text', array(
		 'label'     => Mage::helper('homepage')->__('Type a text to showw in the banner'),
          'required'  => false,
          'name'      => 'bannertext',	
		  'class'	=> 'validate-bannertext',
		  'after_element_html' => '<p class="nm"><small>' . ' Maximum 13 characters (including spaces) ' . '</small></p>',	
		  ));

		  
		 $checkbox = $fieldset->addField('isbanner','checkbox', array(
		  'label'	=> Mage::helper('homepage')->__('Do you want a banner after the current block?'),
		  'required'	=> false,
		  'name'	=> 'isbanner',
		  'checked'	=> false,
		  'value'	=> '0',
		  'onclick' => 'this.value = this.checked ? 1 : 0;getbanner(this);',
		  ));
		  $fieldset->addField('blockbanner', 'image', array(
          'label'     => Mage::helper('homepage')->__('Choose an image for after block banner'),
          'required'  => false,
          'name'      => 'blockbanner',
		  'disabled'	=> 'true',
		 
	 	 ));
		  
		  
		  $checkbox->setAfterElementHtml("<script type=\"text/javascript\">
		  function getbanner(hell){
			  		  var blockbanner = document.getElementById('blockbanner');

			  if(hell.checked == true){
		  blockbanner.disabled = false;
		  alert(hell.value);
		  }
		  else {blockbanner.disabled = true; alert(hell.value);}
		  }
		  </script>
		  ");
     
      if ( Mage::getSingleton('adminhtml/session')->getHomepageData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getHomepageData());
          Mage::getSingleton('adminhtml/session')->setHomepageData(null);
      } elseif ( Mage::registry('homepage_data') ) {
          $form->setValues(Mage::registry('homepage_data')->getData());
      }
      return parent::_prepareForm();
  }
}
?>

<script>
 if(Validation)
    {
        Validation.addAllThese([
           
            ['validate-multiselect-sub', 'Please select 6 subcategories', {maxLength:6, minLength:6}  ] ,
			['validate-multiselect-brands', 'Please select 9 brands', {maxLength:9, minLength:9}  ],
			['validate-bannertext', 'Please type in only 13 chracters', {maxLength:13}  ],
			['validate-icon', 'Please type in only 13 chracters', function(v){
				var width = getImageWidth();
				var height = getImageHeight();
				if(width>144 && width<144)
				{return v.test();}
				} ],
			
			
			
			
			    

        ]);
    }
	
	
	var _URL = window.URL;

</script>