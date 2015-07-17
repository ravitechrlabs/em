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
class AdjustWare_Icon_Model_Mysql4_Image extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('adjicon/image', 'image_id');
    }

    public function getOptionImagesSet($optionId, $productId)
    {
        $db = $this->_getReadAdapter();
        $sql = $db->select()
            ->from(array('i' => $this->getTable('adjicon/image')), array('i.image_id', 'i.file', 'i.label', 'i.base_image'))
            ->where('i.option_id = ?', $optionId)
            ->where('i.product_id = ?', $productId);

        // <<< Aitoc CPPcompatibility
        if(Mage::helper('adjicon')->isCPPEnabled()){
            $sql->joinLeft(array('ac' => $this->getTable('adjicon/cpp')),
                'i.image_id = ac.vya_image_id',
                array('ac.cpp_option_id'));
        }
        // >>>

        $result = $db->fetchAll($sql);

        return $result;
    }

    public function getOptionImageBase($optionId, $productId)
    {
        $db = $this->_getReadAdapter();
        $sql = $db->select()
            ->from(array('i' => $this->getTable('adjicon/image')), array('i.image_id', 'i.file'))
            ->where('i.option_id = ?', $optionId)
            ->where('i.product_id = ?', $productId)
            ->where('i.base_image = ?', '1');
        $result = $db->fetchRow($sql);

        return $result;
    }
}