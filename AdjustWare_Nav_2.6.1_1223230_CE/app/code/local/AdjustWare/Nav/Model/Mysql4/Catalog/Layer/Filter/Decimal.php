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
class AdjustWare_Nav_Model_Mysql4_Catalog_Layer_Filter_Decimal extends Mage_Catalog_Model_Resource_Eav_Mysql4_Layer_Filter_Decimal
{
    public function applyPriceRange($filter)
    {
        return $this;
    }
}