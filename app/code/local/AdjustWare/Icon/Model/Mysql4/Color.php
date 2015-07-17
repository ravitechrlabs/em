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
class AdjustWare_Icon_Model_Mysql4_Color extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('adjicon/color', 'color_id');
    }
}