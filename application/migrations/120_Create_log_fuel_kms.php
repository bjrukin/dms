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
* Migration_Create_log_fuel_kms
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_log_fuel_kms extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('log_fuel_kms'))
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

				'vehicle_id'       		=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'fuel'  				=> array('type' => 'varchar',   'constraint' => 255, 'null' => TRUE),
				'kms'  					=> array('type' => 'varchar',   'constraint' => 255, 'null' => TRUE),
				'date'  				=> array('type' => 'date'),
				'date_np'  				=> array('type' => 'varchar',   'constraint' => 255, 'null' => TRUE),
				'location'  				=> array('type' => 'varchar',   'constraint' => 255, 'null' => TRUE),
				));

			$this->dbforge->create_table('log_fuel_kms', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('log_fuel_kms');
	}
}