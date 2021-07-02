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

/*
 * Rename the file to Employee.php
 * and Define Module Library Function (if any)
 */


class Employee {
	
    public $CI;

	public function __construct()
    {
       	$this->CI =& get_instance();

       	$this->CI->load->model('employees/employee_model');
        $this->CI->load->model('employees/employee_contact_model');

        $this->CI->load->helper(array('project'));
    }

    //get employees list
    public function get_employees($view_name = 'view_employees', $fields = '*') 
    {
        $this->CI->employee_model->_table = $view_name;
        return $this->CI->employee_model->findAll(null, $fields);
    }

    //get employees count
    public function get_employees_count($view_name = 'view_employees') 
    {
        $this->CI->employee_model->_table = $view_name;
        return $this->CI->employee_model->find_count();
    }

	//get employee by id
    public function get_employee($employee_id) 
    {
        $this->CI->employee_model->_table = 'view_employees';
        return $this->CI->employee_model->get_by(array('id'=>$employee_id));
    }

    //save employee
    public function save_employee($data = array()) 
    {
        $this->CI->db->trans_begin();

        if (isset($data['has_login']) && $data['has_login'] === TRUE) {

            $username = $data['username'];
            $email = $data['work_email'];
            $group_id = $data['group_id'];

            unset($data['username']);
            unset($data['group_id']);

            $full_name = $data['first_name'].' '.$data['last_name'];

            //create user
            $user_id = $this->CI->aauth->create_user($email, DEFAULT_PASSWORD, $username,$full_name);
            //create group
            $success = $this->CI->aauth->add_member($user_id, $group_id);

            $data['user_id'] = $user_id;
        }

        if(!array_key_exists('id', $data))
        {
            $success=$this->CI->employee_model->insert($data);
        }
        else
        {
            $success=$this->CI->employee_model->update($data['id'],$data);
        }

        if ($this->CI->db->trans_status() === FALSE)
        {
            $this->CI->db->trans_rollback();
            $success = FALSE;
            $msg=lang('failure_message');
        }
        else
        {
            $this->CI->db->trans_commit();
            $success = TRUE;
            $msg=lang('success_message');
        }

        return array($msg, $success);
    }

    public function get_employee_contacts($employee_id) 
    {
        
        $this->CI->employee_contact_model->_table = 'view_employee_contacts';

        search_params();
        $this->CI->db->where('employee_id', $employee_id);        
        $total=$this->CI->employee_contact_model->find_count();

        paging('id');

        search_params();
        $this->CI->db->where('employee_id', $employee_id);
        $rows=$this->CI->employee_contact_model->findAll();

        return array($total, $rows);
    }

    public function save_employee_contact($data = array())
    {
        $this->CI->db->trans_begin();

        if(empty($data['id']))
        {
            unset($data['id']);
            $this->CI->employee_contact_model->insert($data);
        }
        else
        {
            $this->CI->employee_contact_model->update($data['id'],$data);
        }

        if ($this->CI->db->trans_status() === FALSE)
        {
            $this->CI->db->trans_rollback();
            $success = FALSE;
        }
        else
        {
            $this->CI->db->trans_commit();
            $success = TRUE;
        }

        return $success;
    }

    public function get_employee_customers_followups($executive_id) 
    {
        $this->CI->load->model('customers/customer_followup_model');
        
        $this->CI->customer_followup_model->_table = 'view_customer_followups';

        search_params();
        $this->CI->db->where('executive_id', $executive_id);        
        $total=$this->CI->customer_followup_model->find_count();

        paging('id');

        search_params();
        $this->CI->db->where('executive_id', $executive_id);
        $rows=$this->CI->customer_followup_model->findAll();

        return array($total, $rows);
    }
    
}
/* End of file Employee.php */
/* Location: ./modules/Employee/libraries/Employee.php */

