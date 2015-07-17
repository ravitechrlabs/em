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
class AdjustWare_Nav_Model_System_Config_Source_Filtering extends Varien_Object
{
    public function toOptionArray()
    {
        $options = array();   
        
        
        $options[] = array(
                'value'=> 'OR',
                'label' => Mage::helper('adjnav')->__('OR'),
        );

	$options[] = array(
                'value'=> 'AND',
                'label' => Mage::helper('adjnav')->__('AND'),
        );

        return $options;
    }
}