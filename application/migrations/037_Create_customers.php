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
* Migration_Create_Customers
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_Customers extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_customers'))
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

                'inquiry_no'            => array('type' => 'varchar',   'constraint' => 32,     'default' => NULL,  'unsigned' => TRUE, ),
                'inquiry_kind'          => array('type' => 'varchar',   'constraint' => 32,     'default' => NULL,  'unsigned' => TRUE, ),
                
                'fiscal_year_id'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                
                'inquiry_date_en'       => array('type' => 'date',      'null'       => TRUE),
                'inquiry_date_np'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                
                'customer_type_id'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                
                'first_name'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'middle_name'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'last_name'             => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'gender'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'marital_status'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'family_size'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'dob_en'                => array('type' => 'date',      'null'       => TRUE),
                'dob_np'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'anniversary_en'        => array('type' => 'date',      'null'       => TRUE),
                'anniversary_np'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'district_id'           => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'mun_vdc_id'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                
                'address_1'             => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'address_2'             => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'email'                 => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'home_1'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'home_2'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'work_1'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'work_2'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'mobile_1'              => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'mobile_2'              => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'pref_communication'    => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'occupation_id'         => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'education_id'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'dealer_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'executive_id'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'payment_mode_id'       => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'source_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'status_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'contact_1_name'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'contact_1_mobile'      => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'contact_1_relation_id' => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'contact_2_name'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'contact_2_mobile'      => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'contact_2_relation_id' => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'remarks'               => array('type' => 'text',      'null' => TRUE),

                'vehicle_id'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'variant_id'            => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'color_id'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'walkin_source_id'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'event_id'              => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'institution_id'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),

                'exchange_car_make'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'exchange_car_model'    => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'exchange_car_year'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'exchange_car_kms'      => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'exchange_car_value'    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'exchange_car_bonus'    => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),
                'exchange_total_offer'  => array('type' => 'int',       'constraint' => 11,     'null' => TRUE),

                'bank_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'bank_branch'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'bank_staff'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'bank_contact'          => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

               ));

            $this->dbforge->create_table('dms_customers', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_customers');
    }
}