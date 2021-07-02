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
class Migration_Create_spareparts_msil_order extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('spareparts_msil_order'))
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

                'part_code'             => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'part_name'             => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'quantity'              => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE),
                'mst_part_id'           => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE),
                'order_no'              => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'reached_date'          => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'reached_date_nepali'   => array('type' => 'varchar',   'constraint' => 255,    'null'     => TRUE),
                'in_stock'              => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE, 'default' =>  0)                
                ));

            $this->dbforge->create_table('spareparts_msil_order', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('spareparts_msil_order');
    }
}