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
class Migration_Create_job_cards extends CI_Migration {

    function up() 
    {       
        if ( ! $this->db->table_exists('ser_job_cards'))
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

                'vehicle_id'            => array('type' => 'int',       'null' => TRUE),//from msil dispatch table
                'job_id'                => array('type' => 'int'),
                'jobcard_group'         => array('type' => 'int',       'null' => TRUE),
                'description'           => array('type' => 'text',      'null' => TRUE),
                'before_image'          => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'after_image'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'material_required'     => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'floor_supervisor_id'   => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'mechanics_id'          => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'gear_box_no'           => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'service_type'          => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'kms'                   => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'fuel'                  => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'party_id'              => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'key_no'                => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'delivery_date'         => array('type' => 'int',       'constraint' => 255,    'null' => TRUE),
                'complete'              => array('type' => 'int',       'null' =>TRUE),
                'cost'                  => array('type' => 'int',       'null' => TRUE),
                'paid'                  => array('type' => 'int',       'null' =>TRUE),
                'accessories'           => array('type' => 'varchar',   'constraint' => 255,    'null' =>TRUE),
                'discount_amount'                  => array('type' => 'int',       'null' =>TRUE),
                'discount_percentage'                  => array('type' => 'int',       'null' =>TRUE),
                ));
            $this->dbforge->create_table('ser_job_cards', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_job_cards');
    }
}