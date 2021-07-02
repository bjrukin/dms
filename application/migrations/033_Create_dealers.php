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
* Migration_Create_dealers
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_dealers extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_dealers'))
        {
            // Setup Keys 
            $this->dbforge->add_key('id', TRUE);

            $this->dbforge->add_field(array(
                'id'                    => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'auto_increment' => TRUE),
                'created_by'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'updated_by'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'deleted_by'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'created_at'            => array('type' => 'timestamp', 'default'    => null),
                'updated_at'            => array('type' => 'timestamp', 'default'    => null),
                'deleted_at'            => array('type' => 'timestamp', 'default'    => null),

                'name'                  => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'incharge_id'           => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'district_id'           => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'mun_vdc_id'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'city_place_id'         => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'address_1'             => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'address_2'             => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'phone_1'               => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'phone_2'               => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'email'                 => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'fax'                   => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'latitude'              => array('type' => 'varchar',   'constraint' => 255,    'default'  => null),
                'longitude'             => array('type' => 'varchar',   'constraint' => 255,    'default'  => null),
                'remarks'               => array('type' => 'text',      'null'       => TRUE),

                ));

            $this->dbforge->create_table('dms_dealers', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_dealers');
    }
}