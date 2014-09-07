<?php

class m140907_204301_alter_finv extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            ALTER TABLE `finv_invoice`   
              DROP COLUMN `finv_series_number`, 
              CHANGE `finv_number` `finv_number` VARCHAR(30) CHARSET utf8 COLLATE utf8_general_ci NOT NULL;

        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
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
