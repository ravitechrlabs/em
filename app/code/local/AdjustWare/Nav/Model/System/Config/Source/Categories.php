<?php
/**
 * Layered Navigation Pro
 *
 * @category:    AdjustWare
 * @package:     AdjustWare_Nav
 * @version      2.6.1
 * @license:     lOeKpIO8WfhJjGJEKeiy8x6dx2Qzsqo8LrDiR2B3nm
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
class AdjustWare_Nav_Model_System_Config_Source_Categories extends Varien_Object
{

    private $_categories = array();

    public function toOptionArray()
    {
        $categories = Mage::getModel('catalog/category')->getCategories(1);
        $this->_categories[] = array('value' => '0', 'label' => 'None');
        $this->iterateCategories($categories);

        return $this->_categories;
    }

    public function iterateCategories($categories) {
        foreach($categories as $category) {
            $cat = Mage::getModel('catalog/category')->load($category->getId());
            $prefix = str_repeat('--', $cat->getLevel()-1);
            $this->_categories[] = array('value' => $cat->getId(), 'label' => $prefix.$cat->getName());
            if($category->hasChildren()) {
                $children = Mage::getModel('catalog/category')->getCategories($category->getId());
                $this->iterateCategories($children);
            }
        }
    }
}