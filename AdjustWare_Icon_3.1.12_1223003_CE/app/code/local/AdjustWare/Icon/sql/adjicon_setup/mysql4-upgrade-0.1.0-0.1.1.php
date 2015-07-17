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
$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE `{$this->getTable('adjicon/attribute')}` 
ADD `show_images` TINYINT( 1 ) NOT NULL AFTER `pos` ,
ADD `columns_num` TINYINT( 1 ) NOT NULL AFTER `show_images` ,
ADD `hide_qty`    TINYINT( 1 ) NOT NULL AFTER `columns_num` ,
ADD `sort_by`     TINYINT( 1 ) NOT NULL AFTER `hide_qty` ;

");

$installer->endSetup();