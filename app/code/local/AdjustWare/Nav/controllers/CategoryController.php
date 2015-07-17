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
class AdjustWare_Nav_CategoryController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        // init category
        $categoryId = (int) $this->getRequest()->getParam('id', false);
        if (!$categoryId) {
            $this->_forward('noRoute'); 
            return;
        }

        $category = Mage::getModel('catalog/category')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($categoryId);
        Mage::register('current_category', $category);         
        
        
        $this->getLayout()->createBlock('adjnav/catalog_layer_view');        
        $this->loadLayout();
        $this->renderLayout();
    }
}