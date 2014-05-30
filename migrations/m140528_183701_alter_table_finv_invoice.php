<?php

class m140528_183701_alter_table_finv_invoice extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            ALTER TABLE `finv_invoice` ADD `finv_type` ENUM('in', 'out') NOT NULL DEFAULT 'out';
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->execute("
            ALTER TABLE `finv_invoice` DROP `finv_type`;
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
