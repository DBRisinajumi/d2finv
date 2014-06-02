<?php

class m140603_004701_add_authitem extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            INSERT INTO `authitem` VALUES('D2finv.FiitInvoiceItem.*', 0, 'Edit invoice items', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2finv.FiitInvoiceItem.View', 0, 'View invoice items', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2finv.FinvInvoice.*', 0, 'Edit invoice records', NULL, 'N;');
            INSERT INTO `authitem` VALUES('D2finv.FinvInvoice.View', 0, 'View invoice records', NULL, 'N;');
            
            INSERT INTO `authitem` VALUES('InvoiceEdit', 2, 'Edit invoice records', NULL, 'N;');
            INSERT INTO `authitem` VALUES('InvoiceView', 2, 'View invoice records', NULL, 'N;');
            
            INSERT INTO `authitemchild` VALUES('InvoiceEdit', 'D2finv.FiitInvoiceItem.*');
            INSERT INTO `authitemchild` VALUES('InvoiceView', 'D2finv.FiitInvoiceItem.View');
            INSERT INTO `authitemchild` VALUES('InvoiceEdit', 'D2finv.FinvInvoice.*');
            INSERT INTO `authitemchild` VALUES('InvoiceView', 'D2finv.FinvInvoice.View');
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->execute("
            DELETE FROM `authitemchild` WHERE `parent` = 'InvoiceView' AND `child` = 'D2finv.FinvInvoice.View';
            DELETE FROM `authitemchild` WHERE `parent` = 'InvoiceEdit' AND `child` = 'D2finv.FinvInvoice.*';
            DELETE FROM `authitemchild` WHERE `parent` = 'InvoiceView' AND `child` = 'D2finv.FiitInvoiceItem.View';
            DELETE FROM `authitemchild` WHERE `parent` = 'InvoiceEdit' AND `child` = 'D2finv.FiitInvoiceItem.*';
            
            DELETE FROM `authitem` WHERE `name` = 'InvoiceEdit';
            DELETE FROM `authitem` WHERE `name` = 'InvoiceView';
            
            DELETE FROM `authitem` WHERE `name` = 'D2finv.FiitInvoiceItem.*';
            DELETE FROM `authitem` WHERE `name` = 'D2finv.FiitInvoiceItem.View';
            DELETE FROM `authitem` WHERE `name` = 'D2finv.FinvInvoice.*';
            DELETE FROM `authitem` WHERE `name` = 'D2finv.FinvInvoice.View';
        ");
	}

	/**
	 * Creates initial version of the table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
	public function safeUp()
	{
		$this->up();
	}

	/**
	 * Drops the table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
	public function safeDown()
	{
		$this->down();
	}
}
