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
* Migration_Create_ser_service_policy_vehicles
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_ser_outsidework_ledgers extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('ser_outsidework_ledgers'))
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

				'name'                  => array('type' => 'varchar',       'constraint' => 255),
				'address1'              => array('type' => 'varchar',       'constraint' => 255, 'null' => TRUE),
				'email'                 => array('type' => 'varchar',       'constraint' => 255,     'null' => TRUE),
				'phone_no'              => array('type' => 'int',       'constraint' => 15, 'null' => TRUE),
				'city'                  => array('type' => 'varchar',       'constraint' => 255, 'null' => TRUE),
				'area'                  => array('type' => 'varchar',       'constraint' => 255, 'null' => TRUE),
				'district_id'           => array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'zone_id'               => array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				
				));

			$this->dbforge->create_table('ser_outsidework_ledgers', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('ser_outsidework_ledgers');
	}
}