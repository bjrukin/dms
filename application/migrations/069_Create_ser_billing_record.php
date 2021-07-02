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
class Migration_Create_ser_billing_record extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('ser_billing_record'))
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

                'jobcard_group'         => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'default' => 0),
                'vehicle_id'            => array('type' => 'int',       'constraint' => 11,     'unsigned' => TRUE, 'default' => 0),//from mst vehicle
                'payment_type'          => array('type' => 'varchar',    'constraint' => 11),
                'cash'                  => array('type' => 'varchar',    'constraint' => 256,    'null' => TRUE),
                'credit'                => array('type' => 'varchar',    'constraint' => 256,    'null' => TRUE),
                'customer_credit_id'    => array('type' => 'varchar',    'constraint' => 256,    'null' => TRUE),
                'card'                  => array('type' => 'varchar',    'constraint' => 256,    'null' => TRUE),

                'cash_discount'         => array('type' => 'float',      'constraint' => 32),//cash discount amount

                ));

            $this->dbforge->create_table('ser_billing_record', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('ser_billing_record');
    }
}