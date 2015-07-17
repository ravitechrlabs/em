<?php
/**
 * FAQ accordion for Magento

 */

$installer = $this;

$installer->startSetup();

$installer->run("


-- DROP TABLE IF EXISTS `{$this->getTable('faq_category_urls')}`;
CREATE TABLE {$this->getTable('faq_category_urls')} (
  `url_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `url_label` varchar(255) NOT NULL default '',
  `url_link` varchar(255) NOT NULL default '',
  `sort_order` int(11) NOT NULL default 0,
  PRIMARY KEY (`url_id`),
 CONSTRAINT `FK_FAQ_CATEGORY_URLS_CATEGORY` FOREIGN KEY (`category_id`) REFERENCES `{$this->getTable('hm_faq/category')}` (`category_id`) ON UPDATE CASCADE ON DELETE CASCADE
 
 
) ENGINE=InnoDB COMMENT = 'FAQ Buttons Table ';

");

$installer->endSetup();
