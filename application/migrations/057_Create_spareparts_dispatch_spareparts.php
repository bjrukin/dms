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
class Migration_Create_spareparts_dispatch_spareparts extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('spareparts_dispatch_spareparts'))
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

                'order_id'              => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE),
                'dispatched_quantity'   => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE),
                'dispatched_date'       => array('type' => 'date',  'unsigned' => TRUE,    'null' => TRUE,),
                'dispatched_date_nepali'       => array('type' => 'date',  'unsigned' => TRUE,    'null' => TRUE,),
                'proforma_invoice_id'   => array('type' => 'int',   'constraint' => 11,    'null' => TRUE,    'unsigned' => TRUE)


                ));

            $this->dbforge->create_table('spareparts_dispatch_spareparts', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('spareparts_dispatch_spareparts');
    }
}