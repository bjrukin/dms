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
* Migration_Create_spareparts_countersales
*
* Extends the CI_Migration class
* 
*/

class Migration_Create_spareparts_countersales extends CI_Migration {

	function up() 
	{       

		if ( ! $this->db->table_exists('spareparts_stockyard_countersales'))
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

				'issue_date'       		=> array('type' => 'date', 		'null' => TRUE),
				'credit_account'        => array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'price_option'       	=> array('type' => 'varchar',	'constraint' => 255, 	'null' => TRUE),
				'vor'     				=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'countersale_no'    	=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				'counter_sales_id'		=> array('type' => 'int',		'constraint' => 11, 	'null' => TRUE),
				'total_for_parts'     	=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'dealer_total_for_parts'=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'cash_discount_percent' => array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'cash_discount_amt'     => array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'vat'      				=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'vat_parts'      		=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'net_total'      		=> array('type' => 'decimal',		'constraint' => '10,2', 	'null' => TRUE,),
				'stockyard_id'      	=> array('type' => 'int',		'constraint' => 11,		'null' => TRUE ),
				'is_billed'      		=> array('type' => 'int',		'constraint' => 11,		'null' => TRUE ),
				'invoice_no'      		=> array('type' => 'int',		'constraint' => 11,		'null' => TRUE ),
				));

			$this->dbforge->create_table('spareparts_stockyard_countersales', TRUE);
		}
	}

	function down() 
	{
		$this->dbforge->drop_table('spareparts_stockyard_countersales');
	}
}