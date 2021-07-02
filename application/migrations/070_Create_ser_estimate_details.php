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
* Migration_Create_quotations
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_ser_estimate_details extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('ser_estimate_details'))
		{
			// Setup Keys 
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field(array(
				'id'              => array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
				'created_by'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'updated_by'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'deleted_by'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'created_at'      => array('type' => 'timestamp', 'default'    => null),
				'updated_at'      => array('type' => 'timestamp', 'default'    => null),
				'deleted_at'      => array('type' => 'timestamp', 'default'    => null),

				'vehicle_reg_no'    => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,),
				'part_id'			=> array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,),
				'price'				=> array('type' => 'float',     'unsigned' => TRUE, 'null' => TRUE),
				'quantity'			=> array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,   'null' => TRUE),
				'discount'			=> array('type' => 'float',     'unsigned' => TRUE,   'null' => TRUE),
				'labour'			=> array('type' => 'float',     'unsigned' => TRUE,   'null' => TRUE),
				'job_id'			=> array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
				'status'			=> array('type' => 'varchar',   'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
				'estimate_group'	=> array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
				));

			$this->dbforge->create_table('ser_estimate_details', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('ser_estimate_details');
	}
}