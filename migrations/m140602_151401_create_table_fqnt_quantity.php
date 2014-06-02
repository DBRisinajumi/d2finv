<?php

class m140602_151401_create_table_fqnt_quantity extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE IF NOT EXISTS `fqnt_quantity` (
              `fqnt_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
              `fqnt_code` varchar(10) DEFAULT NULL,
              `fqnt_name` varchar(50) NOT NULL,
              PRIMARY KEY (`fqnt_id`),
              UNIQUE KEY `cqnt_name` (`fqnt_name`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->dropTable('fqnt_quantity');
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
