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
 * Outsidework_ledgers
 *
 * Extends the Project_Controller class
 * 
 */

class Outsidework_ledgers extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Outsidework Ledgers');

		$this->load->model('outsidework_ledgers/outsidework_ledger_model');
		$this->lang->load('outsidework_ledgers/outsidework_ledger');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('outsidework_ledgers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'outsidework_ledgers';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->outsidework_ledger_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->outsidework_ledger_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if(!$this->input->post('id'))
		{
			$success=$this->outsidework_ledger_model->insert($data);
		}
		else
		{
			$success=$this->outsidework_ledger_model->update($data['id'],$data);
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
		$data['name'] = $this->input->post('name');
		$data['address1'] = $this->input->post('address1');
		$data['email'] = $this->input->post('email');
		$data['phone_no'] = $this->input->post('phone_no');
		$data['city'] = $this->input->post('city');
		$data['area'] = $this->input->post('area');
		$data['district_id'] = $this->input->post('district_id');
		$data['zone_id'] = $this->input->post('zone_id');

		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		return $data;
	}

	public function get_outsidework_ledgers() {
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(name) LIKE '%{$search_name}%'"] = NULL;


		// $this->outsidework_ledger_model->_table = "view_user_ledger";
		$data = $this->outsidework_ledger_model->findAll($where, NULL, NULL, NULL, 100);

		echo json_encode($data);
	}
}