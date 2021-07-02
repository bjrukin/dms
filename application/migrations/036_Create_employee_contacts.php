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
* Migration_Create_employee_contacts
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_employee_contacts extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_employee_contacts'))
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

                'employee_id'           => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'default' => NULL),
                'name'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'relation_id'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'home'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'work'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'mobile'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                ));

            $this->dbforge->create_table('dms_employee_contacts', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_employee_contacts');
    }
}