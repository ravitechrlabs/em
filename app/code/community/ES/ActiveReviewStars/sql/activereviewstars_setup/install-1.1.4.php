<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
	->newTable($installer->getTable('ActiveReviewStars/es-reviews'))
	->addColumn('es_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
	'identity' => true,
	'unsigned' => true,
	'nullable' => false,
	'primary' => true,
	), 'Comment ID' )
	->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
	'unsigned' => true,
	'nullable' => false,
	), 'Real Order ID')
	->addColumn('comment', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
	), 'Comment')
	->addForeignKey(
	$installer->getFkName(
		'checkoutcomments/comments_table',
		'order_id',
		'sales/order',
		'entity_id'
	
	),
	'order_id', $installer->getTable('sales/order'), 'entity_id', 
	Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Checkout Comments');
	
	
$installer->getConnection()->createTable($table);
$installer->endSetup();