<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('komplizierte_crud/image'))
    ->addColumn('image_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Image ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
    ), 'Image Title')
    ->addColumn('image_path', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
    ), 'Image Path')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
    ), 'Image Description')
    ->setComment('Komplizierte CRUD table');

$installer->getConnection()->createTable($table);

$installer->endSetup();