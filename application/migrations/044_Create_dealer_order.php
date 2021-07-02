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
class Migration_Create_dealer_order extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('log_dealer_order'))
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

                'date_of_order'         => array('type' => 'date',      'null'       => TRUE),                
                'delivery_date'         => array('type' => 'date',      'null'       => TRUE),                
                'delivery_lead_time'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'date_of_retail'         => array('type' => 'date',      'null'       => TRUE),                
                'retail_lead_time'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'payment_status'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE, 'default' => 0),
                'vehicle_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'variant_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'color_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),                
                'received_date'         => array('type' => 'date',      'null'       => TRUE),                
                'challan_return_image'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'vehicle_main_id'         => array('type' => 'date',      'null'       => TRUE),                
                'payment_method'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'associated_value_payment'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'quantity'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'order_id'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                ));

            $this->dbforge->create_table('log_dealer_order', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('log_dealer_order');
    }
}