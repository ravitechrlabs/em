<?php
/**
 * FAQ accordion for Magento

 */

/**
 * FAQ accordion for Magento
 *
 * Website: www.hiremagento.com 
 * Email: hiremagento@gmail.com
 */
class HM_Faq_Block_Adminhtml_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Constructs current object
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('faq_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('hm_faq')->__('Category Information'));
    }
    
    /**
     * Prepares the page layout
     * 
     * Adds the tabs to the left tab menu.
     * 
     * @return HM_Faq_Block_Adminhtml_Category_Edit_Tabs
     */
    protected function _prepareLayout()
    {
        $return = parent::_prepareLayout();
		
			

        $this->addTab(
            'main_section', 
            array(
                'label' => Mage::helper('hm_faq')->__('General information'),
                'title' => Mage::helper('hm_faq')->__('General information'),
                'content' => $this->getLayout()->createBlock('hm_faq/adminhtml_category_edit_tab_form')->toHtml(),
                'active' => true,
				
            )
        );
         //-------------------------Added by Ravi----------------------------
			$this->addTab('buttons', array(
			'label' => Mage::helper('hm_faq')->__('Add buttons'),
			'title' => Mage::helper('hm_faq')->__('Add buttons'),
                'content' => $this->getLayout()->createBlock('hm_faq/adminhtml_category_edit_tab_general')->toHtml()
                
				
				)
			);
			
		
		//---------------------------------------------
        return $return;
    }
}
