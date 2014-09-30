<?php
/**
 * add to company custom data base currency. Use only for sys comapnies
 * define for all sys companies base currency as EUR
 */

class m140930_151001_init_cccf extends CDbMigration
{

	/**
	 * Creates initial version of the table
	 */
	public function up()
	{
		$this->execute("
            
            insert into `cccf_custom_fields` 
            (`varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`, `test5`, `test6`) 
            values('base_fcrn_id','Base currency','INT','0','0','0','','','',NULL,'','',NULL,'0','0','0','0');
            
            ALTER TABLE `cccd_custom_data`   
              ADD COLUMN `base_fcrn_id` TINYINT NULL  COMMENT 'Sys company base currency' AFTER `cccd_ccmp_id`;
              
            UPDATE cccd_custom_data 
                INNER JOIN ccxg_company_x_group 
                    ON cccd_custom_data.cccd_ccmp_id = ccxg_ccmp_id 
            SET base_fcrn_id = 1 
            WHERE ccxg_ccgr_id = 1;

        ");
	}

	/**
	 * Drops the table
	 */
	public function down()
	{
        
        $this->execute("
        DELETE FROM `cccf_custom_fields` WHERE `varname` = 'base_fcrn_id'            
        ALTER TABLE `cccd_custom_data`   
            DROP COLUMN `base_fcrn_id`;
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
