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
* Migration_Create_Customer_followups
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_Customer_followups extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_customer_followups'))
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

                'customer_id'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'executive_id'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'followup_date_en'      => array('type' => 'date',      'null'       => TRUE),
                'followup_date_np'      => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'followup_mode'         => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'followup_status'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'followup_notes'        => array('type' => 'text',      'null'       => TRUE),
                'next_followup'         => array('type' => 'bool',      'null'       => TRUE),
                'next_followup_date_en' => array('type' => 'date',      'null'       => TRUE),
                'next_followup_date_np' => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),



                ));

            $this->dbforge->create_table('dms_customer_followups', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_customer_followups');
    }
}