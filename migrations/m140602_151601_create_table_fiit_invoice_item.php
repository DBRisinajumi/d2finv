<?php

class m140602_151601_create_table_fiit_invoice_item extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE IF NOT EXISTS `fiit_invoice_item` (
              `fiit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `fiit_finv_id` int(10) unsigned NOT NULL,
              `fiit_desc` text,
              `fiit_debet_facn_code` char(20) CHARACTER SET ascii DEFAULT NULL,
              `fiit_credit_facn_code` char(20) CHARACTER SET ascii DEFAULT NULL,
              `fiit_fprc_id` smallint(5) unsigned DEFAULT NULL,
              `fiit_quantity` decimal(10,4) DEFAULT NULL,
              `fiit_fqnt_id` tinyint(3) unsigned DEFAULT NULL,
              `fiit_price` decimal(10,4) DEFAULT NULL,
              `fiit_amt` decimal(10,2) DEFAULT NULL,
              `fiit_vat` decimal(10,2) DEFAULT NULL,
              `fiit_total` decimal(10,2) DEFAULT NULL,
              `fiit_fvat_id` tinyint(3) unsigned DEFAULT NULL,
              PRIMARY KEY (`fiit_id`),
              KEY `fiit_finv_id` (`fiit_finv_id`),
              KEY `fiit_cqnt_id` (`fiit_fqnt_id`),
              KEY `fiit_credit_facn_code` (`fiit_credit_facn_code`(4)),
              KEY `fiit_debet_facn_code` (`fiit_debet_facn_code`(4),`fiit_id`,`fiit_quantity`),
              KEY `fiit_fvat_id` (`fiit_fvat_id`),
              KEY `fiit_fprc_id` (`fiit_fprc_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

            ALTER TABLE `fiit_invoice_item`
              ADD CONSTRAINT `fiit_invoice_item_ibfk_1` FOREIGN KEY (`fiit_finv_id`) REFERENCES `finv_invoice` (`finv_id`),
              ADD CONSTRAINT `fiit_invoice_item_ibfk_2` FOREIGN KEY (`fiit_fprc_id`) REFERENCES `fprc_product_category` (`fprc_id`),
              ADD CONSTRAINT `fiit_invoice_item_ibfk_3` FOREIGN KEY (`fiit_fqnt_id`) REFERENCES `fqnt_quantity` (`fqnt_id`),
              ADD CONSTRAINT `fiit_invoice_item_ibfk_4` FOREIGN KEY (`fiit_fvat_id`) REFERENCES `fvat_vat` (`fvat_id`);
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->dropTable('fiit_invoice_item');
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
