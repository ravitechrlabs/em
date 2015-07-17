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
class AdjustWare_Nav_Block_SeoHead extends Mage_Core_Block_Template
{
    
    public function _toHtml()
    {
        if(!Mage::getStoreConfig('design/adjnav/rel_prev_next'))
        {
            return;
        }
        
        $actionName = $this->getAction()->getFullActionName();
        if ($actionName == 'catalog_category_view') // Category Page
        {
            $category = Mage::registry('current_category');
            $prodCol = $category->getProductCollection()->addAttributeToFilter('status', 1)->addAttributeToFilter('visibility', array('in' => array(Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG, Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)));
            $tool = $this->getLayout()->createBlock('page/html_pager')->setLimit($this->getLayout()->createBlock('catalog/product_list_toolbar')->getLimit())->setCollection($prodCol);
            $linkPrev = false;
            $linkNext = false;
            if ($tool->getCollection()->getSelectCountSql()) {
                if ($tool->getLastPageNum() > 1) {
                    if (!$tool->isFirstPage()) {
                        $linkPrev = true;
                        if ($tool->getCurrentPage() == 2) {
                            $url = explode('?', $tool->getPreviousPageUrl());
                            $prevUrl = @$url[0];
                        }
                        else {
                            $prevUrl = $tool->getPreviousPageUrl();
                        }
                    }
                    if (!$tool->isLastPage()) {
                        $linkNext = true;
                        $nextUrl = $tool->getNextPageUrl();
                    }
                }
            }    
            
        }
        
        $html = '';
        
        if ($linkPrev)
        {
            $html .= '<link rel="prev" href="'.$prevUrl.'" />';
        }
        
        if ($linkNext)
        {
            $html .= '<link rel="next" href="'.$nextUrl.'" />';
        }
        
        return $html;
        
    }
    
}