<?php

class m140601_205301_alter_table_finv_invoice extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            ALTER TABLE `finv_invoice`
                CHANGE `finv_issuer_ccmp_id` `finv_sys_ccmp_id` INT( 10 ) UNSIGNED NOT NULL,
                CHANGE `finv_payer_ccmp_id` `finv_ccmp_id` INT( 10 ) UNSIGNED NOT NULL;
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->execute("
            ALTER TABLE `finv_invoice`
                CHANGE `finv_sys_ccmp_id` `finv_issuer_ccmp_id` INT( 10 ) UNSIGNED NOT NULL,
                CHANGE `finv_ccmp_id` `finv_payer_ccmp_id` INT( 10 ) UNSIGNED NOT NULL;
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
