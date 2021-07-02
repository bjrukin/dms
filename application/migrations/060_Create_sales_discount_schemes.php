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
class Migration_Create_sales_discount_schemes extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('sales_discount_schemes'))
        {
            // Setup Keys 
            $this->dbforge->add_key('id', TRUE);

            $this->dbforge->add_field(array(
                'id'                  => array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
                'created_by'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'updated_by'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'deleted_by'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'created_at'          => array('type' => 'timestamp', 'default'    => null),
                'updated_at'          => array('type' => 'timestamp', 'default'    => null),
                'deleted_at'          => array('type' => 'timestamp', 'default'    => null),

                'customer_id'        => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'actual_price'        => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'discount_request'    => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'dealer_id'           => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'vehicle_id'          => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'variant_id'          => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),
                'color_id'            => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE),

                'approval'            => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE),
                'approved_by'         => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE),
                'approved_date'       => array('type' => 'date', 'unsigned' => TRUE, 'null' => TRUE),
                'reduced_discount'    => array('type' => 'int', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE),

                // 'employee_inquiry_date'             => array('type' => 'date', 'unsigned' => TRUE, 'null' => TRUE,),
                // 'employee_inquiry_date_nepali'         => array('type' => 'varchar', 'constraint' => 255, 'unsigned' => TRUE, 'null' => TRUE,),

                // 'teamleader_modified_date'          => array('type' => 'date', 'unsigned' => TRUE, 'null' => TRUE,),
                // 'teamleader_modified_date_nepali'   => array('type' => 'varchar', 'constraint' => 255, 'unsigned' => TRUE, 'null' => TRUE,),

                // 'sales_head_modified_date'          => array('type' => 'date', 'unsigned' => TRUE, 'null' => TRUE,),
                // 'sales_head_modified_date_nepali'   => array('type' => 'varchar', 'constraint' => 255, 'unsigned' => TRUE, 'null' => TRUE,),


                ));

            $this->dbforge->create_table('sales_discount_schemes', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('sales_discount_schemes');
    }
}