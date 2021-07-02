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
* Migration_Create_crm_vehicle_edit
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_crm_vehicle_edit extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('crm_vehicle_edit'))
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

				'customer_id'       	=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'prev_vehicle'       	=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'prev_variant'       	=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'prev_color'       		=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'new_vehicle'       	=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'new_variant'       	=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'new_color'       		=> array('type' => 'int',       'constraint' => 11, 'null' => TRUE),
				'date'  				=> array('type' => 'date'),
				'date_np'  				=> array('type' => 'varchar',   'constraint' => 255, 'null' => TRUE),
				));

			$this->dbforge->create_table('crm_vehicle_edit', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('crm_vehicle_edit');
	}
}