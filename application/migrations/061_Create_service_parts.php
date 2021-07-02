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
* Migration_Create_service_parts
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_service_parts extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('ser_parts'))
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

                'vehicle_id'     	    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'jobcard_group'         => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'part_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'price'     		    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'quantity'              => array('type' => 'int',   	'constraint' => 11,     'null' => TRUE,		 'unsigned' => TRUE),
                'used'     		        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'discount_percentage'   => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'labour'     		    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'cash_discount'         => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'bill_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'status'                => array('type' => 'varchar',       'constraint' => 256,     'null' => TRUE),
                'request_status'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'recived_status'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                ));

            $this->dbforge->create_table('ser_parts', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_parts');
    }
}