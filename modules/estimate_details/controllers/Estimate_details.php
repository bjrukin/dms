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
 * Estimate_details
 *
 * Extends the Project_Controller class
 * 
 */

class Estimate_details extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Estimate Details');

		$this->load->model('estimate_details/estimate_detail_model');
		$this->lang->load('estimate_details/estimate_detail');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('estimate_details');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'estimate_details';
		$this->load->view($this->_container,$data);
	}

	public function get_part_price_json()
	{
		$part_code = $this->input->post('part_code');
		$this->estimate_detail_model->_table = "mst_spareparts";
		$row=$this->estimate_detail_model->find(array('part_code'=>$part_code));
		// echo '<pre>'; print_r($row); exit;
		$success = false;
		if(!empty($row)){
			$success = true;
		}
		echo json_encode(array('success'=>$success,'row'=>$row));
	}

	public function json()
	{

		$this->estimate_detail_model->_table = "view_service_estimate_records";
		if( ! is_admin() ) {
			$this->db->where('dealer_id', $this->dealer_id);
		}
		search_params();
		$total=$this->estimate_detail_model->find_count();

		paging('id');


		if( ! is_admin() ) {
			$this->db->where('dealer_id', $this->dealer_id);
		}
		search_params();
		$rows=$this->estimate_detail_model->findAll();

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$this->db->trans_begin();
		// echo '<pre>'; print_r($this->input->post()); exit;
		$data = $this->_get_posted_data(); //Retrive Posted Data
		$jobs_data 	= $this->input->post('jobs_data');
		$parts_data = $this->input->post('parts_data');
		$data['jobcard_group'] = (isset($data['jobcard_group']) && $data['jobcard_group'])?$data['jobcard_group']:NULL;
		// echo '<pre>'; print_r($parts_data); exit;
		if( ! $this->input->post('data')['id'])
		{
			$this->estimate_detail_model->_table = "ser_estimate_details";
			$estimate_doc_no_exist = $this->estimate_detail_model->find(array('dealer_id' => $this->dealer_id,'estimate_doc_no'=>$data['estimate_doc_no']));

			if($estimate_doc_no_exist){
				$this->estimate_detail_model->_table = 'ser_estimate_details';
				$this->db->where('dealer_id', $this->dealer_id);
				$estimate_no = $this->estimate_detail_model->find(null,'max(estimate_doc_no)');
				$new_estimate_no = $estimate_no->max + 1;
			
				$data['estimate_doc_no'] = $new_estimate_no;
			}
				
			$estimate_id = $this->estimate_detail_model->insert($data);
		}
		else
		{
			$this->estimate_detail_model->update($data['id'],$data);
			$estimate_id = $data['id'];
		}



		if($jobs_data)
		{
			foreach ($jobs_data as $key => $value) {
				$data = array(
					'job_id'				=>	$value['job_id'],
					'price'					=>	$value['price'],
					'discount'				=>	($value['discount'])?$value['discount']:NULL,
					'total_amount'          =>  $value['total_amount'],
					'customer_voice'			=>	$value['customer_voice'],
					'estimate_id'			=>	$estimate_id,
				);

				$this->estimate_detail_model->_table = "ser_estimate_jobs";
				if( isset($value['id']) ){
					if( $value['id'] ){
						$data['id'] = $value['id'];
						$this->estimate_detail_model->update($data['id'], $data);
					}
				} else {
					$this->estimate_detail_model->insert($data);
				}
			}
		}

		if($parts_data)
		{

			foreach ($parts_data as $key => $value) {
				$this->estimate_detail_model->_table = "mst_spareparts";
				$parts = $this->estimate_detail_model->find(array('part_code'=>$value['part_code']));
				$data = array(
					'part_id'				=>	(int)$parts->id,
					'price'					=>	(array_key_exists('price', $value))?(int)$value['price']:0,
					'quantity'				=>	(array_key_exists('quantity', $value))?(int)$value['quantity']:0,
					'discount_percentage'	=>	(isset($value['discount']) && $value['discount'])?$value['discount']:NULL,
					'final_amount'			=>	(array_key_exists('final_amount', $value))?(($value['final_amount'])?$value['final_amount']:0):0,
					'estimate_id'			=>	(int)$estimate_id,
				);

				$this->estimate_detail_model->_table = "ser_estimate_parts";
				if(isset($value['id'])) {
					if($value['id']) {
						$data['id'] = $value['id'];
						$this->estimate_detail_model->update($data['id'],$data);
					}
				}
				else {
					$this->estimate_detail_model->insert($data);
				}
			}			
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$msg = lang('general_failure');
			$success = FALSE;
			echo json_encode(array('success' => $success));
		}
		else
		{
			$this->db->trans_commit();
			$msg = lang('general_success');
			$success = TRUE;
			echo json_encode(array('success' => $success));
		}

	}

	private function _get_posted_data()
	{
		$data=array();
		$post 		= $this->input->post('data');

		if($post['id']) {
			$data['id'] = $post['id'];
		}

		if($post['estimate_doc_no']) {
			$data['estimate_doc_no'] = $post['estimate_doc_no'];
		} else {
			$this->estimate_detail_model->_table = 'ser_estimate_details';
			$this->db->where('dealer_id', $this->dealer_id);
			$estimate_no = $this->estimate_detail_model->find(null,'max(estimate_doc_no)');

			$new_estimate_no = $estimate_no->max + 1;
			$data['estimate_doc_no'] = $new_estimate_no;
		}

		$data['dealer_id'] = $this->dealer_id;
		$data['jobcard_group'] = $post['jobcard_group'];
		$data['issued_date'] = $post['issued_date'];
		$data['vehicle_register_no'] = $post['vehicle_register_no'];
		$data['chassis_no'] = $post['chassis_no'];
		$data['engine_no'] = $post['engine_no'];
		$data['model_no'] = $post['model_no'];
		$data['variant'] = $post['variant'];
		$data['color'] = $post['color'];
		$data['ledger_id'] = $post['party_name'];

		// $data['total_jobs'] = $post['total_for_jobs'];
		// $data['total_parts'] = $post['total_for_parts'];

		$data['total_jobs'] = ($post['total_for_jobs'] != '' || $post['total_for_jobs'] != null)?$post['total_for_jobs']:0;
		$data['total_parts'] = ($post['total_for_parts'] != '' || $post['total_for_parts'] != null)?$post['total_for_parts']:0;
		

		$data['cash_percent'] = $post['cash_discount_percent'];
		$data['vat_percent'] = $post['vat_percent'];
		$data['net_total'] = $post['net_total'];

		return $data;
	}

	public function get_estimate_jobs() {
		$id = $this->input->get('id');
		$estimate_no = $this->input->get('estimate_id');


		$this->estimate_detail_model->_table = "view_service_estimate_jobs";
		search_params();
		// $this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('estimate_id', $id);
		$this->db->order_by("estimate_id", "asc");
		$rows = $this->estimate_detail_model->findAll();
		$total = count($rows);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function get_estimate_parts() {
		$id = $this->input->get('id');
		$estimate_no = $this->input->get('estimate_id');


		$this->estimate_detail_model->_table = "view_service_estimate_parts";
		search_params();
		// $this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('estimate_id', $id);
		$rows = $this->estimate_detail_model->findAll();
		$total = count($rows);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function add_job() {

	}

	public function delete_jobs()
	{
		$id = $this->input->post('id');
		$this->estimate_detail_model->_table = 'ser_estimate_jobs';
		$success = $this->estimate_detail_model->delete($id);
		echo json_encode(array('success'=>$success));
	}

	public function delete_parts()
	{
		$id = $this->input->post('id');
		$this->estimate_detail_model->_table = 'ser_estimate_parts';
		$success = $this->estimate_detail_model->delete($id);
		echo json_encode(array('success'=>$success));
	}

}