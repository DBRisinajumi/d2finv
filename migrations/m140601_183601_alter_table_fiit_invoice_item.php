<?php

class m140601_183601_alter_table_fiit_invoice_item extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            ALTER TABLE `fiit_invoice_item` CHANGE `fiit_quantity` `fiit_quantity` DOUBLE NULL;
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->execute("
            ALTER TABLE `fiit_invoice_item` CHANGE `fiit_quantity` `fiit_quantity` DOUBLE NOT NULL;
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
