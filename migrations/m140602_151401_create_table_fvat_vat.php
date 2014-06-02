<?php

class m140602_151401_create_table_fvat_vat extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE IF NOT EXISTS `fvat_vat` (
              `fvat_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `fvat_rate` decimal(4,2) DEFAULT NULL,
              `fvat_label` char(10) DEFAULT NULL,
              `fvat_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
              `fvat_hide` enum('true','false') NOT NULL DEFAULT 'false',
              PRIMARY KEY (`fvat_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->dropTable('fvat_vat');
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
