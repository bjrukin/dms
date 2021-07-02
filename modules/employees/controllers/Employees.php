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
 * Employees
 *
 * Extends the Project_Controller class
 * 
 */

class Employees extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Employees');

        $this->lang->load('employees/employee');

        $this->load->library('employees/employee');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('employees');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'employees';       
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
       // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $this->db->where_in('dealer_id', $dealer_list);
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
        }

		search_params();
        
        $total=$this->employee->get_employees_count();
        
        paging('id');

        if(!empty($dealer_list)) {
            $this->db->where_in('dealer_id', $dealer_list);
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
        }
        
        search_params();
        
        $rows = $this->employee->get_employees();
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
	}

	// save employee
    public function save()
    {
        $data = $this->_get_posted_data();
        list($msg, $success) = $result = $this->employee->save_employee($data);
        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

   private function _get_posted_data()
   {
   		$data=array();
		if($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }

        $data['dealer_id'] = ($this->input->post('dealer_id')) ? $this->input->post('dealer_id') : NULL;
        $data['employee_type'] = ($this->input->post('employee_type')) ? $this->input->post('employee_type') : DEALER_EMPLOYEE;

        if ($this->input->post('has_login')) {
            $data['has_login'] = ($this->input->post('has_login')) ? TRUE : FALSE;
            $data['username'] = $this->input->post('username');
            $data['group_id'] = $this->input->post('group_id');    
        }

        $data['user_id'] = ($this->input->post('user_id')) ? $this->input->post('user_id') : NULL;

		$data['first_name'] = strtoupper($this->input->post('first_name'));
		$data['middle_name'] = strtoupper($this->input->post('middle_name'));
		$data['last_name'] = strtoupper($this->input->post('last_name'));
		$data['dob_en'] = $this->input->post('dob_en');
        $data['dob_np'] = $this->input->post('dob_np');
		$data['gender'] = $this->input->post('gender');
		$data['marital_status'] = $this->input->post('marital_status');

        if($this->input->post('permanent_district_id')){
            $data['permanent_district_id'] = $this->input->post('permanent_district_id');
        }

        if($this->input->post('permanent_mun_vdc_id')){
            $data['permanent_mun_vdc_id'] = $this->input->post('permanent_mun_vdc_id');
        }

		$data['permanent_ward'] = $this->input->post('permanent_ward');
		$data['permanent_address_1'] = $this->input->post('permanent_address_1');
		$data['permanent_address_2'] = $this->input->post('permanent_address_2');

		if($this->input->post('temporary_district_id')){
            $data['temporary_district_id'] = $this->input->post('temporary_district_id');
        }

        if($this->input->post('temporary_mun_vdc_id')){
            $data['temporary_mun_vdc_id'] = $this->input->post('temporary_mun_vdc_id');
        }
        
		$data['temporary_ward'] = $this->input->post('temporary_ward');
		$data['temporary_address_1'] = $this->input->post('temporary_address_1');
		$data['temporary_address_2'] = $this->input->post('temporary_address_2');
		$data['home'] = $this->input->post('home');
		$data['work'] = $this->input->post('work');
		$data['mobile'] = $this->input->post('mobile');
		$data['work_email'] = $this->input->post('work_email');
		$data['personal_email'] = $this->input->post('personal_email');
		$data['photo'] = $this->input->post('photo');
		$data['nationality'] = $this->input->post('nationality');
		$data['citizenship_no'] = $this->input->post('citizenship_no');
		$data['citizenship_issued_on'] = $this->input->post('citizenship_issued_on');
		$data['citizenship_issued_by'] = $this->input->post('citizenship_issued_by');
		$data['license'] = $this->input->post('license');
		$data['license_type'] = $this->input->post('license_type');
		$data['license_no'] = $this->input->post('license_no');
		$data['license_issued_on'] = $this->input->post('license_issued_on');
		$data['license_issued_by'] = $this->input->post('license_issued_by');
		$data['license_expiry'] = $this->input->post('license_expiry');
		$data['passport'] = $this->input->post('passport');
		$data['passport_type'] = $this->input->post('passport_type');
		$data['passport_no'] = $this->input->post('passport_no');
		$data['passport_issued_on'] = $this->input->post('passport_issued_on');
		$data['passport_issued_by'] = $this->input->post('passport_issued_by');
		$data['passport_expiry'] = $this->input->post('passport_expiry');


        $data['education_id'] = ($this->input->post('education_id')) ? $this->input->post('education_id') : null;
        $data['designation_id'] = ($this->input->post('designation_id')) ? $this->input->post('designation_id') : null;
        $data['interview_date_en'] = ($this->input->post('interview_date_en')) ? ($this->input->post('interview_date_en')) : null;
        $data['interview_date_np'] = ($this->input->post('interview_date_np')) ? ($this->input->post('interview_date_np')) : null;
        $data['probation_period'] = ($this->input->post('probation_period')) ? ($this->input->post('probation_period')) : null;
        $data['joining_date_en'] = ($this->input->post('joining_date_en')) ? ($this->input->post('joining_date_en')) : null;
        $data['joining_date_np'] = ($this->input->post('joining_date_np')) ? ($this->input->post('joining_date_np')) : null;
        $data['confirmation_date_en'] = ($this->input->post('confirmation_date_en')) ? ($this->input->post('confirmation_date_en')) : null;
        $data['confirmation_date_np'] = ($this->input->post('confirmation_date_np')) ? ($this->input->post('confirmation_date_np')) : null;
        $data['leaving_date_en'] = ($this->input->post('leaving_date_en')) ? ($this->input->post('leaving_date_en')) : null;
        $data['leaving_date_np'] = ($this->input->post('leaving_date_np')) ? ($this->input->post('leaving_date_np')) : null;
        $data['leaving_reason'] = ($this->input->post('leaving_reason')) ? ($this->input->post('leaving_reason')) : null;

        return $data;
   }

    // get employee detail
    public function detail($id=null)
    {
        control('Employee Detail');

        if ($id==null) 
        {
            flashMsg('error', 'Invalid employee ID');
            redirect('admin/employees');  
        }

        $employee_info = $this->employee->get_employee($id);

        if ($employee_info == null) 
        {
            flashMsg('error', 'Invalid Employee ID');
            redirect('admin/employees');            
        }

        $data['employee_info'] = $employee_info;

        // Display Page
        $data['header'] = lang('employees');
        $data['page'] = $this->config->item('template_admin') . "details";
        $data['module'] = 'employees';

      
        $this->load->view($this->_container,$data);
    }

    //employee contacts json
    public function employee_contacts_json()
    {
    	if($this->input->get('employee_id'))
        {
            $employee_id = $this->input->get('employee_id');
        }

        list($total, $rows) = $this->employee->get_employee_contacts($employee_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }

    //save employee contacts
    public function save_employee_contact()
    {
    	$result = $this->employee->save_employee_contact($this->input->post());

        if($result)
        {
            $success = TRUE;
            $msg=lang('success_message');
        } 
        else
        {
            $success = FALSE;
            $msg=lang('failure_message');
        }
        
        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

    //employee contacts json
    public function employee_customers_followup_json()
    {
        if($this->input->get('executive_id'))
        {
            $executive_id = $this->input->get('executive_id');
        }

        list($total, $rows) = $this->employee->get_employee_customers_followups($executive_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
    }

    //check duplicate

    public function check_team_leader() 
   {
        if ($this->input->post('id')) {
            $this->db->where('id <>', $this->input->post('id'));
        }

        $this->db->where('dealer_id', $this->input->post('dealer_id'));
        $this->db->where('designation_id', $this->input->post('designation_id'));

        $total = $this->employee_model->find_count();

        if ($total == 0) 
            echo json_encode(array('success' => true));
         else
            echo json_encode(array('success' => false));
    }

}