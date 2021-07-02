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
* Migration_Create_spareparts_stock_transfers
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_spareparts_stock_transfers extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('spareparts_stock_transfers'))
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

				'stock_from'       		=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				'stock_to'       		=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				'dispatch_date_en'      => array('type' => 'date',		'null' => TRUE),
				'dispatch_date_np'      => array('type' => 'varchar',	'constraint' => 265, 	'null' => TRUE),
				'accepted_date_en'      => array('type' => 'date',		'null' => TRUE),
				'accepted_date_np'      => array('type' => 'varchar',	'constraint' => 265, 	'null' => TRUE),
				'status'      			=> array('type' => 'varchar',	'constraint' => 265, 	'null' => TRUE),
				));

			$this->dbforge->create_table('spareparts_stock_transfers', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('spareparts_stock_transfers');
	}
}