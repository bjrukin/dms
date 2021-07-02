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
class Migration_Create_mst_spareparts_dealer extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('mst_spareparts_dealer'))
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
                'credit_policy'         => array('type'=> 'integer',   'null'       => TRUE)
                ));

            $this->dbforge->create_table('mst_spareparts_dealer', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('mst_spareparts_dealer');
    }
}