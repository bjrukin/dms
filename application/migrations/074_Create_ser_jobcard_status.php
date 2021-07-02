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
* Migration_Create_ser_jobcard_status
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_ser_jobcard_status extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('ser_jobcard_status'))
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

                'jobcard_group'         => array('type' => 'int',       'constraint' => 256),
                'status'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'reason'                => array('type' => 'varchar',   'constraint' => 256,     'null' => TRUE,),
                ));

            $this->dbforge->create_table('ser_jobcard_status', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_jobcard_status');
    }
}