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
* Migration_Create_ser_jobcard_status
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_sales_discount_limit extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('sales_discount_limit'))
		{
			// Setup Keys 
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field(array(
				'id'				=> array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
				'created_by'		=> array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'updated_by'		=> array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'deleted_by'		=> array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
				'created_at'		=> array('type' => 'timestamp', 'default'    => null),
				'updated_at'		=> array('type' => 'timestamp', 'default'    => null),
				'deleted_at'		=> array('type' => 'timestamp', 'default'    => null),

				'vehicle_id'		=> array('type' => 'int',       'constraint' => 11,	'unsigned' => TRUE),
				'variant_id'		=> array('type' => 'int',       'constraint' => 11, 'unsigned' => TRUE),
				'staff_limit'		=> array('type' => 'int',   'constraint' => 11,     'null' => TRUE,),
				'incharge_limit'	=> array('type' => 'int',   'constraint' => 11,     'null' => TRUE,),
				'manager_limit'		=> array('type' => 'int',   'constraint' => 11,     'null' => TRUE,),
				));

			$this->dbforge->create_table('sales_discount_limit', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('sales_discount_limit');
	}
}