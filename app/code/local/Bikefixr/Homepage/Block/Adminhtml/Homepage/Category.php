<?php
class Bikefixr_Homepage_Block_Adminhtml_Homepage_Category extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$value =  $row->getData($this->getColumn()->getIndex());
		return Mage::getSingleton('catalog/category')->load($value)->getName();
	}
}
?>