<?php
/**
 * FAQ accordion for Magento

 */

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('employee_category_button')}`;
CREATE TABLE {$this->getTable('employee_category_button')} (
  `button_id` INT(10) UNSIGNED NOT NULL,
  `button1_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`button_id`,`button1_id`)
) ENGINE=InnoDB;


");

$installer->endSetup();
