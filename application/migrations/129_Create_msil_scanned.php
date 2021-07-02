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
* Migration_Create_spareparts_stock_transfer_lists
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_msil_scanned extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('dms_msil_scanned_order'))
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

				'part_name'       		=> array('type' => 'varchar',		'constraint' => 255, 	'null' => TRUE),
				'quantity'       		=> array('type' => 'int',		'constraint' => 32, 'null' => TRUE),
				'order_no'       		=> array('type' => 'varchar',		'constraint' => 255, 	'null' => TRUE),
				'part_code'       		=> array('type' => 'varchar',		'constraint' => 255, 	'null' => TRUE),
				'location'       		=> array('type' => 'varchar',		'constraint' => 255, 	'null' => TRUE),
				'invoice_no'       		=> array('type' => 'varchar',		'constraint' => 255, 	'null' => TRUE),
				'binning_date_en'       => array('type' => 'date',	'null' => TRUE),
				'binning_date_np'       => array('type' => 'date',	'null' => TRUE),
				'box_quantity'       	=> array('type' => 'int',		'constraint' => 32, 	'null' => TRUE),
				'scanner_device_id'     => array('type' => 'int',		'constraint' => 32, 	'null' => TRUE),
				'scanner_name_id'       => array('type' => 'int',		'constraint' => 32, 	'null' => TRUE),
			
				
				));


			$this->dbforge->create_table('dms_msil_scanned_order', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('dms_msil_scanned_order');
	}
}