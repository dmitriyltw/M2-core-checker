<?php
/**
 * A Magento 2 module named Ltw/MagentoChecker
 * Copyright © Ltw - 2019. All rights reserved.
 *
 * This file included in Ltw/MagentoChecker is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */
namespace Ltw\MagentoChecker\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Ltw\MagentoChecker\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('ltw_magentochecker_default')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('ltw_magentochecker_default')
            )
                ->addColumn(
                    'file_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'File Id'
                )
                ->addColumn(
                    'file_path',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'File path'
                )
                ->addColumn(
                    'file_hash',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'File hash'
                )
                ->setComment('Ltw table for storing default hashes and file paths');
            $installer->getConnection()->createTable($table);
        }

        if (!$installer->tableExists('ltw_magentochecker_tmp')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('ltw_magentochecker_tmp')
            )
                ->addColumn(
                    'file_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary' => true,
                        'unsigned' => true,
                    ],
                    'File Id'
                )
                ->addColumn(
                    'file_path',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'File path'
                )
                ->addColumn(
                    'file_hash',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'File hash'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    10,
                    ['nullable => false'],
                    'File status (processed or pending)'
                )
                ->setComment('Ltw table for storing temporary hashes and file paths');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}