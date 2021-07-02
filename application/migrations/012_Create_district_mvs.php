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
* Migration_Create_district_mvs
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_district_mvs extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('mst_district_mvs'))
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
                
                'code'                  => array('type' => 'varchar',   'constraint' => 10,     'null'     => TRUE),
                'name'                  => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'parent_id'             => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'type'                  => array('type' => 'varchar',   'constraint' => 25,     'unsigned' => TRUE, 'default' => NULL),
                'boundary_coordinates'  => array('type' => 'text',      'default'    => NULL,   'null'     => TRUE),
                
                ));

            $this->dbforge->create_table('mst_district_mvs', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('mst_district_mvs');
    }
}