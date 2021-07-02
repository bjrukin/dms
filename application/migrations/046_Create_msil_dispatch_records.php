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
class Migration_Create_dispatch_records extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('msil_dispatch_records'))
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

                'vehicle_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'variant_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'color_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'dispatch_date'         => array('type' => 'date',      'null'       => TRUE),                
                'month'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'year'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'ait_reference_no'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'invoice_no'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'invoice_date'         => array('type' => 'date',      'null'       => TRUE),                
                'transit'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE, 'default' => 1),
                'barcode'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'engine_no'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'chass_no'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'order_no'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'indian_stock_yard'         => array('type' => 'date',      'null'       => TRUE),                
                'indian_custom'         => array('type' => 'date',      'null'       => TRUE),                
                'nepal_custom'         => array('type' => 'date',      'null'       => TRUE),                                
                ));

            $this->dbforge->create_table('msil_dispatch_records', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('msil_dispatch_records');
    }
}