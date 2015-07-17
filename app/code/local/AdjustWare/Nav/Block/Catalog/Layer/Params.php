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
class AdjustWare_Nav_Block_Catalog_Layer_Params extends AdjustWare_Nav_Block_Catalog_Layer_View
{
    public function getStateInfo()
    {
       return parent::getStateInfo();
    }

    protected function _prepareLayout()
    {
        return $this;
    }
	
	protected function _beforeToHtml()
    {
        return $this;
    }
}