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
* Migration_Create_Customer_test_drives
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_Customer_test_drives extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_customer_test_drives'))
        {
            // Setup Keys 
            $this->dbforge->add_key('id', TRUE);

            $this->dbforge->add_field(array(
                'id'                        => array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
                'created_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'updated_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'deleted_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'created_at'                => array('type' => 'timestamp', 'default'    => null),
                'updated_at'                => array('type' => 'timestamp', 'default'    => null),
                'deleted_at'                => array('type' => 'timestamp', 'default'    => null),

                'customer_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'td_date_en'                => array('type' => 'date',      'null'       => TRUE),
                'td_date_np'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'td_time'                   => array('type' => 'time',      'default'    => null),
                
                'executive_id'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'vehicle_id'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'variant_id'                => array('type' =>  'int',      'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'mileage_start'             => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'mileage_end'               => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'duration'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                
                'td_location'               => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                ));

            $this->dbforge->create_table('dms_customer_test_drives', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_customer_test_drives');
    }
}