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
* Migration_Create_employees
*
* Extends the CI_Migration class
* 
*/
class Migration_Create_employees extends CI_Migration {

    function up() 
    {       

        if ( ! $this->db->table_exists('dms_employees'))
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

                'dealer_id'             => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'has_login'             => array('type' => 'bool',      'null'       => TRUE),
                'user_id'               => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                
                'first_name'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'middle_name'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'last_name'             => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'dob_en'                => array('type' => 'date',      'null'       => TRUE),
                'dob_np'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'gender'                => array('type' => 'smallint',  'null'       => TRUE),
                'marital_status'        => array('type' => 'smallint',  'null'       => TRUE),
                'permanent_district_id' => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'permanent_mun_vdc_id'  => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'permanent_ward'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'permanent_address_1'   => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'permanent_address_2'   => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'temporary_district_id' => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'temporary_mun_vdc_id'  => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'temporary_ward'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'temporary_address_1'   => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'temporary_address_2'   => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'home'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'work'                  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'mobile'                => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'work_email'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'personal_email'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'photo'                 => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'nationality'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'citizenship_no'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'citizenship_issued_on' => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'citizenship_issued_by' => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'license'               => array('type' => 'bool',      'null'       => TRUE),
                'license_type'          => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'license_no'            => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'license_issued_on'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'license_issued_by'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'license_expiry'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'passport'              => array('type' => 'bool',      'null'       => TRUE),
                'passport_type'         => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'passport_no'           => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'passport_issued_on'    => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'passport_issued_by'    => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'passport_expiry'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),

                'education_id'          => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'designation_id'        => array('type' => 'int',       'constraint' => 11,     'null' => TRUE,     'unsigned' => TRUE),
                'interview_date_en'     => array('type' => 'date',      'null'       => TRUE),
                'interview_date_np'     => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'probation_period'      => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'joining_date_en'       => array('type' => 'date',      'null'       => TRUE),
                'joining_date_np'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'confirmation_date_en'  => array('type' => 'date',      'null'       => TRUE),
                'confirmation_date_np'  => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'leaving_date_en'       => array('type' => 'date',      'null'       => TRUE),
                'leaving_date_np'       => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'leaving_reason'        => array('type' => 'varchar',   'constraint' => 255,    'null' => TRUE),
                'employee_type'         => array('type' =>  'int',       'constraint'=> 11,     'default' => 0),
            ));

            $this->dbforge->create_table('dms_employees', TRUE);
        }
    }

    function down() 
    {
        $this->dbforge->drop_table('dms_employees');
    }
}