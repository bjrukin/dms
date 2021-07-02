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
* Migration_Create_ser_service_policy_detail
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_ser_service_policy_detail extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('ser_service_policy_detail'))
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

                'policy_id'             => array('type' => 'int',       'constraint' => 256),
                'min_distance'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'max_distance'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'duration'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                
                ));

            $this->dbforge->create_table('ser_service_policy_detail', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_service_policy_detail');
    }
}