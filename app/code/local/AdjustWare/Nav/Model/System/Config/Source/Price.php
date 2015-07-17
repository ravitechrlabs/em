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
class AdjustWare_Nav_Model_System_Config_Source_Price extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();
        
        $options[] = array(
                'value'=> 'default',
                'label' => Mage::helper('adjnav')->__('Default')
        );
        $options[] = array(
                'value'=> 'slider',
                'label' => Mage::helper('adjnav')->__('Slider')
        );
        $options[] = array(
                'value'=> 'input',
                'label' => Mage::helper('adjnav')->__('Input')
        );
        
        return $options;
    }
}