<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('customerservice')};
CREATE TABLE {$this->getTable('customerservice')} (
  `customerservice_id` int(11) unsigned NOT NULL auto_increment,
  `cscategory` varchar(255) NOT NULL default '',  
  `cstab` smallint(6) NOT NULL default '0',
  `status` smallint(6) NOT NULL default '0',
  `parentfaqcat` int(11) unsigned NOT NULL default '0', 
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`customerservice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS `{$this->getTable('customerservice_children')}`;
CREATE TABLE {$this->getTable('customerservice_children')} (
  `children_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customerservice_id` int(11) UNSIGNED NOT NULL,
  `child_title` varchar(255) NOT NULL default '',
  `faq_category` int(11) NOT NULL default 0,
  `sort_order` int(11) NOT NULL default 0,
  PRIMARY KEY (`children_id`),
 CONSTRAINT `FK_CUSTOMERSERVICE_CHILDREN_CUSTOMERSERVICE` FOREIGN KEY (`customerservice_id`) REFERENCES `{$this->getTable('customerservice')}` (`customerservice_id`) ON UPDATE CASCADE ON DELETE CASCADE
 
 
) ENGINE=InnoDB COMMENT = 'Customerservice children Table ';

    ");

$installer->endSetup(); 