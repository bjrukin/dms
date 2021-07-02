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
class Migration_Create_ser_outside_work extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('ser_outside_work'))
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

                'job_id'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,),
                'jobcard_group'     => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,),
                'workshop_id'       => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE,),
                'amount'            => array('type' => 'float',     'constraint' => 11,     'unsigned' => TRUE,   'null' => TRUE),
                'taxes'             => array('type' => 'float',     'constraint' => 11,     'unsigned' => TRUE,   'null' => TRUE),
                'discount'          => array('type' => 'float',     'constraint' => 11,     'unsigned' => TRUE,   'null' => TRUE),
                'remarks'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'splr_invoice_no'   => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                'send_date'         => array('type' => 'date',      'null' => TRUE      ),
                'arrived_date'      => array('type' => 'date',      'null' => TRUE      ),
                'mechanics_id'      => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'null' => TRUE),
                ));

            $this->dbforge->create_table('ser_outside_work', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_outside_work');
    }
}