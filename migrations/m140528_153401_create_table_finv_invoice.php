<?php

class m140528_153401_create_table_finv_invoice extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            CREATE TABLE IF NOT EXISTS `finv_invoice` (
              `finv_id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
              `finv_series_number` varchar(10) DEFAULT NULL,
              `finv_number` varchar(20) NOT NULL,
              `finv_issuer_ccmp_id` int(10) unsigned NOT NULL,
              `finv_payer_ccmp_id` int(10) unsigned NOT NULL,
              `finv_reg_date` date NOT NULL,
              `finv_date` date NOT NULL DEFAULT '0000-00-00',
              `finv_budget_date` date DEFAULT '0000-00-00',
              `finv_due_date` date DEFAULT '0000-00-00',
              `finv_notes` text,
              `finv_fcrn_id` tinyint(10) unsigned NOT NULL,
              `finv_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_vat` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_total` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_basic_fcrn_id` tinyint(10) unsigned NOT NULL,
              `finv_basic_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_basic_vat` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_basic_total` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_basic_payment_before` decimal(10,2) NOT NULL DEFAULT '0.00',
              `finv_stst_id` tinyint(10) unsigned DEFAULT NULL,
              `finv_paid` enum('is paid','not paid','partly paid') DEFAULT 'not paid',
              `finv_ref` enum('BPRD') DEFAULT NULL,
              `finv_ref_id` int(10) unsigned DEFAULT NULL,
              PRIMARY KEY (`finv_id`),
              KEY `finv_fcrn_id` (`finv_fcrn_id`),
              KEY `finv_number` (`finv_number`(4)),
              KEY `finv_basic_fcrn_id` (`finv_basic_fcrn_id`),
              KEY `finv_payer_ccmp_id` (`finv_payer_ccmp_id`),
              KEY `finv_issuer_ccmp_id` (`finv_issuer_ccmp_id`),
              KEY `finv_stst_id` (`finv_stst_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


            ALTER TABLE `finv_invoice`
              ADD CONSTRAINT `finv_invoice_ibfk_1` FOREIGN KEY (`finv_issuer_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`),
              ADD CONSTRAINT `finv_invoice_ibfk_2` FOREIGN KEY (`finv_payer_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`),
              ADD CONSTRAINT `finv_invoice_ibfk_3` FOREIGN KEY (`finv_fcrn_id`) REFERENCES `fcrn_currency` (`fcrn_id`),
              ADD CONSTRAINT `finv_invoice_ibfk_4` FOREIGN KEY (`finv_basic_fcrn_id`) REFERENCES `fcrn_currency` (`fcrn_id`),
              ADD CONSTRAINT `finv_invoice_ibfk_5` FOREIGN KEY (`finv_stst_id`) REFERENCES `stst_state` (`stst_id`);
        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
		$this->dropTable('finv_invoice');
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
