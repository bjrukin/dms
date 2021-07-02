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
* Migration_Create_spareparts_countersale_parts
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_spareparts_countersale_parts extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('spareparts_stockyard_countersale_parts'))
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

				'sparepart_id'       	=> array('type' => 'int', 		'constraint' => 11, 	'null' => TRUE),
				'quantity'       		=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				'total'       			=> array('type' => 'decimal',	'constraint' => '10,2', 'null' => TRUE),
				'dealer_price'     		=> array('type' => 'decimal',	'constraint' => '10,2', 'null' => TRUE),
				'dealer_price_total'    => array('type' => 'decimal',	'constraint' => '10,2', 'null' => TRUE),
				'countersale_id'    	=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				));

			$this->dbforge->create_table('spareparts_stockyard_countersale_parts', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('spareparts_stockyard_countersale_parts');
	}
}