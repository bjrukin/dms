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
 * Warranty_claims
 *
 * Extends the Project_Controller class
 * 
 */

class Warranty_claims extends Project_Controller
{
	var $dealer_id;

	public function __construct()
	{
		parent::__construct();

		control('Warranty Claims');

		$this->load->model('warranty_claims/warranty_claim_model');
		$this->lang->load('warranty_claims/warranty_claim');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('warranty_claims');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'warranty_claims';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();

		$where = array('dealer_id' => $this->dealer_id);
		if(is_admin() ){
			unset($where['dealer_id']);
		}

		$total=$this->warranty_claim_model->find_count($where);

		paging('id');

		search_params();

		$rows=$this->warranty_claim_model->findAll($where);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if($data['warranty']) {
			echo json_encode(array('msg'=>"Empty Parts.",'success'=> false));
			exit;
		}

		if(! isset($data['warranty']['id'] ))
		{
			
			$success = $this->warranty_claim_model->insert($data['warranty']);

			$claims = array();
			foreach ($data['warranty_parts'] as $key => $value) {
				$claims[$key]['part_id'] 			= $value['part_id'];
				$claims[$key]['quantity'] 			= $value['quantity'];
				$claims[$key]['remarks'] 			= $value['remarks'];
				$claims[$key]['selected'] 			= $value['selected'];
				$claims[$key]['warranty_claim_id'] 	= $success;

				$claims[$key] = array_filter($claims[$key], function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});
			}
			$this->warranty_claim_model->_table = "ser_warranty_claim_list";
			$success = $this->warranty_claim_model->insert_many($claims);


		}
		else
		{

			$success=$this->warranty_claim_model->update($data['warranty']['id'],$data['warranty']);
			$claims = array();
			foreach ($data['warranty_parts'] as $key => $value) {
				$claims[$key]['id'] 			= $value['id'];
				$claims[$key]['part_id'] 			= $value['part_id'];
				$claims[$key]['quantity'] 			= $value['quantity'];
				$claims[$key]['remarks'] 			= $value['remarks'];
				$claims[$key]['selected'] 			= $value['selected'];
				$claims[$key] = array_filter($claims[$key], function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});
			}
			$this->warranty_claim_model->_table = "ser_warranty_claim_list";
			$success = $this->warranty_claim_model->update_batch($claims,'id');
		}
		// print_r($data); print_r($claims); exit;

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
		$data['warranty'] = $this->input->post('data');
		$data['warranty']['dealer_id'] = $this->dealer_id;

		$data['warranty'] = array_filter($data['warranty'], function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		$data['warranty_parts'] = $this->input->post('warranty_parts');

		return $data;
	}

	public function get_claim_number() {
		$this->db->order_by('claim_number','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$id = $this->warranty_claim_model->find();
		$id = ($id)?++$id->claim_number:1;
		echo json_encode($id);
	}

	public function get_manufacturer_json() {

		$this->warranty_claim_model->_table = "mst_workshop";
		$rows = $this->warranty_claim_model->findAll();
		echo json_encode($rows);

	}

	public function get_from_job() {
		$job_no = $this->input->post('job_no');

		if( $job_no <= 0 ) {
			echo json_encode(array('success' => false, 'msg' => 'No such job cards.', 'rows' => ''));
			exit;
			
		}

		$this->warranty_claim_model->_table = "ser_warranty_claim";
		$job = $this->warranty_claim_model->findAll(array('job_no' => $job_no, 'dealer_id' => $this->dealer_id));

		if($job) {
			echo json_encode(array('success' => false, 'msg'=> 'No Warranty Parts found.', 'rows' => ''));
			exit;
		}

		$this->warranty_claim_model->_table = "view_service_parts";
		$this->db->where('dealer_id', $this->dealer_id);
		$rows = $this->warranty_claim_model->findAll(array('jobcard_group' => $job_no, 'warranty' => 'UW'));

		$this->warranty_claim_model->_table = "view_report_grouped_jobcard";
		$this->db->where('dealer_id', $this->dealer_id);
		$user = $this->warranty_claim_model->find(array('jobcard_group' => $job_no));

		echo json_encode(array('success' => true, 'rows' => $rows, 'user' => $user));
	}

	public function get_warranty_claim_list() {
		$warranty_claim_id = $this->input->post('claim_id');

		$this->warranty_claim_model->_table = "view_service_warranty_claim_list";
		$rows = $this->warranty_claim_model->findAll(array('warranty_claim_id' => $warranty_claim_id));

		echo json_encode(array('success' => true, 'rows' => $rows));
	}
}