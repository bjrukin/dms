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
class Migration_Create_dispatch_dealer extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('log_dispatch_dealer'))
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
                'stock_yard_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'driver_name'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'driver_address'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'driver_contact'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'driver_liscense_no'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'dealer_id'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'received_status'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'image_name'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'dispatched_date'         => array('type' => 'date',      'null'       => TRUE),                
                'dealer_order_id'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                ));

            $this->dbforge->create_table('log_dispatch_dealer', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('log_dispatch_dealer');
    }
}