<?php

class m140528_153401_create_table_fprc_product_category extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE IF NOT EXISTS `fprc_product_category` (
              `fprc_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
              `fprc_code` char(10) NOT NULL,
              `fprc_name` varchar(100) NOT NULL,
              PRIMARY KEY (`fprc_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->dropTable('fprc_product_category');
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
