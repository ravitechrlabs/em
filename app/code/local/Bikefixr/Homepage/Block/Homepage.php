<?php
class Bikefixr_Homepage_Block_Homepage extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getHomepage()     
     { 
        if (!$this->hasData('homepage')) {
            $this->setData('homepage', Mage::registry('homepage'));
        }
        return $this->getData('homepage');
        
    }
}