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
class Migration_Create_stock_records extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('log_stock_records'))
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
               
                'dispatched_date'         => array('type' => 'date',      'null'       => TRUE),                
                'reached_date'         => array('type' => 'date',      'null'       => TRUE),                
                ));

            $this->dbforge->create_table('log_stock_records', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('log_stock_records');
    }
}