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
class Migration_Create_vehicle_sale extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('sales_vehicle_process'))
        {
            // Setup Keys 
            $this->dbforge->add_key('id', TRUE);

            $this->dbforge->add_field(array(
                'id'                        => array('type' => 'int',       'constraint' => 11,     'auto_increment' => TRUE),
                'created_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'updated_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'deleted_by'                => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'created_at'                => array('type' => 'timestamp', 'default'    => null),
                'updated_at'                => array('type' => 'timestamp', 'default'    => null),
                'deleted_at'                => array('type' => 'timestamp', 'default'    => null),

                'customer_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'booked_date'               => array('type' => 'date',      'null'       => TRUE),                                      
                'booking_receipt_no'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'booking_amount'            => array('type' => 'float',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'booking_receipt_image'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'quotation_issue_date'      => array('type' => 'date',      'null'       => TRUE),
                'quotation_image'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'vehicle_details_image'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),                      

                'do_received_date'          => array('type' => 'date',      'null'       => TRUE),
                'do_image'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),                      

                'downpayment_date'          => array('type' => 'date',      'null'       => TRUE),
                'downpayment_receipt_no'    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'downpayment_amount'        => array('type' => 'float',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'downpayment_receipt_image' => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'fullpayment_date'          => array('type' => 'date',      'null'       => TRUE),
                'fullpayment_receipt_no'    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'fullpayment_amount'        => array('type' => 'float',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'fullpayment_receipt_image' => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'vehicle_delivery_date'     => array('type' => 'date',      'null'       => TRUE),      
                'deliverysheet_image'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'creditnote_image'          => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'bluebook_received_date'    => array('type' => 'date',      'null'       => TRUE),
                'bluebook_image'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'insurance_no'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'insurance_date'            => array('type' => 'date',      'null'       => TRUE),                      

                'vat_bill_no'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'vat_bill_created_date'     => array('type' => 'date',   'null' => TRUE),
                'vat_bill_image'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'msil_dispatch_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'discount_amount'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE)
                
                ));

            $this->dbforge->create_table('sales_vehicle_process', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('sales_vehicle_process');
    }
}