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
class AdjustWare_Icon_Block_Adminhtml_Icon extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_icon';
        $this->_headerText = Mage::helper('adjicon')->__('Visualize Your Attributes');
        $this->_addButtonLabel = Mage::helper('adjicon')->__('Fill Out');
        $this->_blockGroup = 'adjicon';
    }

}