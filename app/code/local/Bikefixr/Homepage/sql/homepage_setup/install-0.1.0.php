<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('homepage')};
CREATE TABLE {$this->getTable('homepage')} (
  `homepage_id` int(11) unsigned NOT NULL auto_increment,
  `selectcategory` varchar(255) NOT NULL default '',
  `categoryicon` varchar(255) NOT NULL default '',
  `subcategory` varchar(255) NOT NULL default '',
  `brands` varchar(255) NOT NULL default '',
  `bannerimage` varchar(255) NOT NULL default '',
  `bannertext` text NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`homepage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 