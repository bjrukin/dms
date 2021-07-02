<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* PROJECT
*
* @package         PROJECT
* @author          <AUTHOR_NAME>
* @copyright       Copyright (c) 2016
*/

// ---------------------------------------------------------------------------

/**
* Migration_Create_spareparts_daily_credits
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_spareparts_daily_credits extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('spareparts_daily_credits'))
		{
			// Setup Keys 
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field(array(
				'id'                    => array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
				'created_by'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'updated_by'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'deleted_by'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'created_at'            => array('type' => 'timestamp', 'default'    => null),
				'updated_at'            => array('type' => 'timestamp', 'default'    => null),
				'deleted_at'            => array('type' => 'timestamp', 'default'    => null),

				'dealer_id'       		=> array('type' => 'int', 		'constraint' => 11, 	'null' => TRUE),
				'date_en'       		=> array('type' => 'date',		'null' => TRUE),
				'date_np'       		=> array('type' => 'varchar',	'constraint' => 50, 	'null' => TRUE),
				'credit_amount'     	=> array('type' => 'decimal',	'constraint' => '10,2', 'null' => TRUE),
				
				));

			$this->dbforge->create_table('spareparts_daily_credits', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('spareparts_daily_credits');
	}
}