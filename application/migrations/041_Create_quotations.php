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
class Migration_Create_quotations extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_quotations'))
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
                
                'quotation_date_en'     => array('type' => 'date',      'null'       => TRUE),
                'quotation_date_np'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                
                'quote_price'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'quote_unit'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),

                ));

            $this->dbforge->create_table('dms_quotations', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_quotations');
    }
}