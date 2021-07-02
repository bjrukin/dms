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
 * Dealer_credits
 *
 * Extends the Project_Controller class
 * 
 */

class Dealer_credits extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Dealer Credits');

		$this->load->model('dealer_credits/dealer_credit_model');
		$this->load->model('dealers/dealer_model');

		$this->lang->load('dealer_credits/dealer_credit');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('dealer_credits');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dealer_credits';
		$this->load->view($this->_container,$data);
	}

	public function payment_index()
	{
		// Display Page
		$data['header'] = lang('dealer_credits');
		$data['page'] = $this->config->item('template_admin') . "payment_register";
		$data['module'] = 'dealer_credits';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$where = '1=1';
		
		if(is_sparepart_dealer_incharge())
		{
			$where = 'spares_incharge_id ='.$this->session->userdata('id');
		}

		search_params();
		$this->dealer_credit_model->_table = "view_spareparts_actual_credit";
		$this->db->where($where);
		$total=$this->dealer_credit_model->find_count();
		
		paging('dealer_id');
		
		search_params();
		$this->db->where($where);
		$rows=$this->dealer_credit_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save(){
		
		$data=$this->_get_posted_data();
		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});
		if(!$this->input->post('id'))
		{

			$success=$this->dealer_credit_model->insert($data);

		}
		else
		{
			$success=$this->dealer_credit_model->update($data['id'],$data);
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
		$data['amount'] = $this->input->post('amount');
		$data['cr_dr'] = $this->input->post('cr_dr');
		$data['particular'] = $this->input->post('particular');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['date'] = $this->input->post('date');
		$data['date_nepali'] = $this->input->post('date_nepali');
		if($data['cr_dr'] == 'DEBIT'){
			$data['cash_card'] = $this->input->post('cash_card');
			$data['receipt_no'] = $this->input->post('receipt_no');
		}
		return $data;
	}

	public function payment_json()
	{
		$this->dealer_credit_model->_table = "view_dealer_credit_list";

		$where = '1=1';
		if(is_sparepart_dealer_incharge())
		{
			$where = 'spares_incharge_id ='.$this->session->userdata('id');
		}
		
		search_params();

		$this->db->where($where);
		$total=$this->dealer_credit_model->find_count(array('cr_dr'=>'DEBIT'));
		
		//paging('id');
		
		search_params();
		$this->db->where($where);
		$rows=$this->dealer_credit_model->findAll(array('cr_dr'=>'DEBIT'));
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function show_detail($dealer_id = NULL)
	{
		$data['rows'] = $this->dealer_model->find(array('id'=>$dealer_id),array('id','name'));
		$data['dealer'] = $dealer_id;
		$data['dealer_name'] = $this->dealer_model->find(array('id'=>$dealer_id),'name');
		$data['header'] = lang('detail_credit');
		$data['page'] = $this->config->item('template_admin') . "credit_detail";
		$data['module'] = 'dealer_credits';
		$this->load->view($this->_container,$data);
	}

	public function detail_json()
	{
		$this->dealer_credit_model->_table = "view_detail_credit_debit";
		$dealer_id = $this->input->get('id');

		search_params();

		$total=$this->dealer_credit_model->find_count(array('dealer_id'=>$dealer_id));
		
		// paging('id');
		paging('date','asc');
		
		search_params();
		$this->db->order_by('id');
		
		$rows=$this->dealer_credit_model->findAll(array('dealer_id'=>$dealer_id));
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	
}