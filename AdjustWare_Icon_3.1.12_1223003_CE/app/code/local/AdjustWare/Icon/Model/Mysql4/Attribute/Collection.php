<?php
/**
 * Visualize Your Attributes - Color Swatch
 *
 * @category:    AdjustWare
 * @package:     AdjustWare_Icon
 * @version      3.1.12
 * @license:     yyaCGr5K8ZCaMT0MZQn3kyZBpI7JDXhVgQrqRg87lG
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
class AdjustWare_Icon_Model_Mysql4_Attribute_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('adjicon/attribute');
    }
    
    public function addTitles()
    {
        $this->getSelect()->joinInner(array('a'=> $this->getTable('eav/attribute')), 
            'main_table.attribute_id=a.attribute_id', 
            array('a.frontend_label'));
            
        return $this;
    }

    public function addUsedInProductListing()
    {
        $this->getSelect()->joinInner(array('a'=> $this->getTable('catalog/eav_attribute')),
            'main_table.attribute_id=a.attribute_id',
            array('a.used_in_product_listing'));

        return $this;
    }
}