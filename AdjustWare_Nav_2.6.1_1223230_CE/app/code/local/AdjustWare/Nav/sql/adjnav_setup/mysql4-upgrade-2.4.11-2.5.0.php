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
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run('

ALTER TABLE `'.$this->getTable('catalog_eav_attribute').'`
    ADD (
        `adjnav_block_type` varchar(40) DEFAULT \'sidebar\',
        `adjnav_display_type` varchar(40) DEFAULT \'default\'
    );
');

$installer->endSetup();