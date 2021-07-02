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
 * Migrate
 *
 * Extends the MX_Controller class
 * 
 */

class Migrate extends MX_Controller
{

    public function __construct() {

        parent::__construct();
        $this->load->library('migration');
    }

    public function index()
    {
        print "Migration Started\r\nExecuting......";
        if ($this->migration->latest() === FALSE)
        {
            show_error($this->migration->error_string());
        } 
    }

    public function downgrade($version = 0)
    {
        if ($this->migration->version($version) === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function seed() {
        $this->load->library('auth/Aauth', 'mail');
        $this->load->config('project');
        $this->load->config('mail');

        // EMAIL CONFIG
        $email_config = $this->config->item('mail');
        $this->email->initialize($email_config);

        $this->aauth->create_perm('Control Panel', 'Control Panel');
        $this->aauth->create_perm('System', 'System');
        $this->aauth->create_perm('Users', 'Users');
        $this->aauth->create_perm('Groups', 'Groups');
        $this->aauth->create_perm('Permissions', 'Permissions');

        $this->db->query('ALTER SEQUENCE aauth_permissions_id_seq RESTART WITH 101');

        $this->aauth->create_perm('Master Data',        'Master Data');
        $this->aauth->create_perm('Masters',            'Masters');
        $this->aauth->create_perm('City Places',        'City Places');
        $this->aauth->create_perm('Fiscal Years',       'Fiscal Years');
        $this->aauth->create_perm('Vehicles',           'Vehicles');
        $this->aauth->create_perm('CRM',                'CRM');
        $this->aauth->create_perm('Dealers',            'Dealers');
        $this->aauth->create_perm('Events',             'Events');
        $this->aauth->create_perm('Employees',          'Employees');
        $this->aauth->create_perm('Employee Detail',    'Employee Detail');
        $this->aauth->create_perm('Customers',          'Customers');
        $this->aauth->create_perm('Customer Detail',    'Customer Detail');
        $this->aauth->create_perm('Schedules',          'Schedules');
        $this->aauth->create_perm('CRM Reports',         'CRM Reports');

        $this->aauth->create_perm('Dealer Selection',   'Dealer Selection');
        $this->aauth->create_perm('Executive Selection','Executive Selection');

        //$this->aauth->create_perm('Dealer Selection','Executive Selection');

        $this->aauth->create_group(1,   'Member',               'Member Default Access Group');
        $this->aauth->create_group(100, 'Administrator',        'Administrator Access Group');
        $this->aauth->create_group(200, 'Management',           'Management');
        $this->aauth->create_group(300, 'Retail Finance',       'Retail Finance');
        $this->aauth->create_group(400, 'Dealer Incharge',      'Dealer Incharge');
        $this->aauth->create_group(500, 'Showroom Incharge',    'Showroom Incharge');
        $this->aauth->create_group(600, 'Sales Executive',      'Sales Executive');
        

        $this->db->query('ALTER SEQUENCE aauth_groups_id_seq RESTART WITH 1001');    

        //Add Permission to Member Group
        $this->aauth->allow_group('Member', 'Control Panel');
        $this->aauth->allow_group('Member', 'Employees');
        $this->aauth->allow_group('Member', 'Employee Detail');
        $this->aauth->allow_group('Member', 'CRM');
        $this->aauth->allow_group('Member', 'Customers');
        $this->aauth->allow_group('Member', 'Customer Detail');
        $this->aauth->allow_group('Member', 'Schedules');

        //Administrator
        $this->aauth->allow_group('Administrator',     'Master Data');
        $this->aauth->allow_group('Administrator',     'Masters');
        $this->aauth->allow_group('Administrator',     'City Places');
        $this->aauth->allow_group('Administrator',     'Fiscal Years');
        $this->aauth->allow_group('Administrator',     'Vehicles');
        $this->aauth->allow_group('Administrator',     'CRM');
        $this->aauth->allow_group('Administrator',     'Dealers');
        $this->aauth->allow_group('Administrator',     'Events');
        $this->aauth->allow_group('Administrator',     'Employees');
        $this->aauth->allow_group('Administrator',     'Employee Detail');
        $this->aauth->allow_group('Administrator',     'Customers');
        $this->aauth->allow_group('Administrator',     'Customer Detail');
        $this->aauth->allow_group('Administrator',     'Schedules');
        $this->aauth->allow_group('Administrator',     'CRM Reports');
        $this->aauth->allow_group('Administrator',     'Dealer Selection');
        $this->aauth->allow_group('Administrator',     'Executive Selection');
        
        //Management
        $this->aauth->allow_group('Management',     'Master Data');
        $this->aauth->allow_group('Management',     'Masters');
        $this->aauth->allow_group('Management',     'City Places');
        $this->aauth->allow_group('Management',     'Fiscal Years');
        $this->aauth->allow_group('Management',     'Vehicles');
        $this->aauth->allow_group('Management',     'CRM');
        $this->aauth->allow_group('Management',     'Dealers');
        $this->aauth->allow_group('Management',     'Events');
        $this->aauth->allow_group('Management',     'Employees');
        $this->aauth->allow_group('Management',     'Employee Detail');
        $this->aauth->allow_group('Management',     'Customers');
        $this->aauth->allow_group('Management',     'Customer Detail');
        $this->aauth->allow_group('Management',     'Schedules');
        $this->aauth->allow_group('Management',     'CRM Reports');
        $this->aauth->allow_group('Management',     'Dealer Selection');
        $this->aauth->allow_group('Management',     'Executive Selection');

        //Retail Finance Incharge
        $this->aauth->allow_group('Retail Finance',    'CRM Reports');
        $this->aauth->allow_group('Retail Finance',    'Dealer Selection');
        $this->aauth->allow_group('Retail Finance',    'Executive Selection');

        //Dealer Incharge
        $this->aauth->allow_group('Dealer Incharge',    'CRM Reports');
        $this->aauth->allow_group('Dealer Incharge',    'Dealer Selection');
        $this->aauth->allow_group('Dealer Incharge',    'Executive Selection');

        //Showroom Incharge
        $this->aauth->allow_group('Showroom Incharge',  'CRM Reports');
        $this->aauth->allow_group('Showroom Incharge',  'Executive Selection');

        //Sales Executive
        //$this->aauth->allow_group('Sales Executive', 'Control Panel');

        
        //Create Super Administrator User
        $user_id = $this->aauth->create_user('shrestharubim@gmail.com', 'p@$$w0rd', 'superadmin', 'Super Administrator');
        $this->aauth->add_member($user_id, 'Administrator');

        $user_id = $this->aauth->create_user('admin@no.com', DEFAULT_PASSWORD, 'admin', 'Administrator');
        $this->aauth->add_member($user_id, 'Administrator');

        // $user_id = $this->aauth->create_user('manager@nomail.com', DEFAULT_PASSWORD, 'manager', 'Manager');
        // $this->aauth->add_member($user_id, 'Management');

        // $user_id = $this->aauth->create_user('retailfinance@nomail.com', DEFAULT_PASSWORD, 'retailfinance', 'Retail Finance');
        // $this->aauth->add_member($user_id, 'Retail Finance');

        // $user_id = $this->aauth->create_user('dealerincharge1@nomail.com', DEFAULT_PASSWORD, 'dealerincharge1', 'Dealer Incharge 1');
        // $this->aauth->add_member($user_id, 'Dealer Incharge');

        // $user_id = $this->aauth->create_user('dealerincharge2@nomail.com', DEFAULT_PASSWORD, 'dealerincharge2', 'Dealer Incharge 2');
        // $this->aauth->add_member($user_id, 'Dealer Incharge');

        // $user_id = $this->aauth->create_user('dealerincharge3@nomail.com', DEFAULT_PASSWORD, 'dealerincharge3', 'Dealer Incharge 3');
        // $this->aauth->add_member($user_id, 'Dealer Incharge');

        $this->db->query('ALTER SEQUENCE aauth_users_id_seq RESTART WITH 101');    
        
        $district_mvs_sql = file_get_contents(FCPATH . 'sql/000_db_dump_district_mvs.sql');
        $queries = explode(';', $district_mvs_sql);

        foreach ($queries as $q) {
            if (trim($q) != '') {
                $this->db->query($q);
            }
        }

        $view_sql = file_get_contents(FCPATH . 'sql/001_db_views.sql');
        $view_sql = str_replace('\r\n', ' ', $view_sql);
        
        $queries = explode(';', $view_sql);

        foreach ($queries as $q) {
            if (trim($q) != '') {
                $this->db->query($q);
            }
        }
    }

    public function make_db($value='', $file="false")
    {
        $view_sql = file_get_contents(FCPATH . 'sql/'. $value . '.sql');
        if(!$file){
            $view_sql = str_replace('\r\n', ' ', $view_sql);
            
            $queries = explode(';', $view_sql);

            foreach ($queries as $q) {
                if (trim($q) != '') {
                    $this->db->query($q);
                }
            }

        }else{
            $this->db->query($view_sql);
        }

        echo 'complete';
    }
}