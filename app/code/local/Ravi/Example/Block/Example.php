<?php
class Ravi_Example_Block_Example extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getExample()     
     { 
        if (!$this->hasData('example')) {
            $this->setData('example', Mage::registry('example'));
        }
        return $this->getData('example');
        
    }
}