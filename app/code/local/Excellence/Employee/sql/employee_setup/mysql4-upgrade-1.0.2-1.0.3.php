<?php
/**
 * FAQ accordion for Magento

 */

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS `{$this->getTable('employee_category_buttons')}`;
CREATE TABLE {$this->getTable('employee_category_buttons')} (
  `buttons_id` INT(10) UNSIGNED NOT NULL,
  `buttons1_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`buttons_id`,`buttons1_id`)
) ENGINE=InnoDB COMMENT='HELL Yeah';


");

$installer->endSetup();
