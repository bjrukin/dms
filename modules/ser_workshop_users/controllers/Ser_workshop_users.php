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
 * Ser_workshop_users
 *
 * Extends the Project_Controller class
 * 
 */

class Ser_workshop_users extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Ser Workshop Users');

		$this->load->model('ser_workshop_users/ser_workshop_user_model');
		$this->lang->load('ser_workshop_users/ser_workshop_user');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('ser_workshop_users');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ser_workshop_users';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->ser_workshop_user_model->_table = "view_ser_workshop_users";
		if(!is_admin()){
				$this->db->where('dealer_id', $this->dealer_id);
		}
		search_params();
		$total=$this->ser_workshop_user_model->find_count();
		
		paging('id');
		
		if(!is_admin()){
			$this->db->where('dealer_id', $this->dealer_id);
		}
		search_params();
		$rows=$this->ser_workshop_user_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if(!$this->input->post('id'))
		{
			$success=$this->ser_workshop_user_model->insert($data);
		}
		else
		{
			$success=$this->ser_workshop_user_model->update($data['id'],$data);
		}

		if($success)
		{
			$success = TRUE;
			$msg=lang('general_success');
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	private function _get_posted_data()
	{
		$data=array();
		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}
		$data['dealer_id'] = ($this->dealer_id)?$this->dealer_id:$this->input->post('dealer_id');
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['phone_no'] = $this->input->post('phone_no');
		$data['Address'] = $this->input->post('Address');
		$data['designation_id'] = $this->input->post('designation_id');

		if($this->input->post('designation_id') == MECHANICS ) {
			$data['parent_id'] = $this->input->post('designation_parent');
		}else{
			$data['parent_id'] = 0;
		}

		return $data;
	}

	public function get_mechanic_heads() {
		$dealer_id = $this->input->get('dealer_id');

		$this->ser_workshop_user_model->_table = "view_ser_workshop_users";
		$rows = $this->ser_workshop_user_model->findAll(array('dealer_id' => $dealer_id, 'designation_id' => MECHANIC_LEADER));
		array_unshift($rows, array('id' => '0', 'name' => 'Select Technician Head'));

		echo json_encode($rows);
	}


}