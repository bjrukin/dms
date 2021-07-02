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
 * Job_cards
 *
 * Extends the Project_Controller class
 * 
 */

class Billing extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Job Cards');

		$this->load->model('job_cards/job_card_model');
		$this->lang->load('job_cards/job_card');
	}

	public function index(){
		$data['job_detail']['vehicle_id'] 		=  $this->input->post('vehicle_id');
		$data['job_detail']['jobcard_group'] 	=  $this->input->post('jobcard_group');

/*		$this->job_card_model->_table = 'view_msil_dispatch_records';
		$where[] = $data['job_detail']['vehicle_id'];
		$data['vehicle_detail'] = $this->job_card_model->find_by('id', $where);*/
		$this->job_card_model->_table = "view_service_job_card";
		$data['vehicle_detail'] = $this->job_card_model->find(array('jobcard_group' =>  $this->input->post('jobcard_group') ));

		// $this->job_card_model->_table = 'view_service_job_card';
		// $data['service_type'] = $this->job_card_model->find(array('jobcard_group'=> $this->input->post('jobcard_group')),'service_type, service_type_name');

		$this->job_card_model->_table = 'view_vehicle_process';
		$data['customer'] = $this->job_card_model->find_by('msil_dispatch_id',$data['job_detail']['vehicle_id']);

		$this->job_card_model->_table = "ser_billing_record";
		$max_bill = $this->job_card_model->find(NULL, array("max(id)"));
		$data['bill_id'] = $max_bill->max + 1;


		$data['under_warranty'] = null;
		$data['ordinal_array'] = null;
		$data['under_warranty_type'] = null;
		
		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$fields = 'jobcard_group';
		// $this->db->group_by($fields);
		// $this->db->where('issue_date IS NOT NULL');
		// $data['service_count'] = count ($this->job_card_model->findAll(array('vehicle_no'=>$data['vehicle_detail']->vehicle_no,'jobcard_group'=>$data['vehicle_detail']->jobcard_group ),$fields)) + 1;
		$data['service_count'] = $data['vehicle_detail']->service_count;

		$this->job_card_model->_table = "ser_billing_record";
		$data['has_billed'] = $this->job_card_model->find(array('jobcard_group'=>$this->input->post('jobcard_group')));
		
		$this->job_card_model->_table = 'view_service_warranty_policy';
		$warranty = $this->job_card_model->find(array('service_policy_no'=>$data['vehicle_detail']->service_policy_id, 'service_count' => $data['service_count'] ));
		
		$interval = date_diff(date_create($data['vehicle_detail']->vehicle_sold_on), date_create(date('Y-m-d')));
		$interval = $interval->format('%m');

		if(($data['vehicle_detail']->kms > $warranty->km_min && $data['vehicle_detail']->kms < $warranty->km_max ) OR ($interval < $warranty->period) ) {
			$data['under_warranty'] = true;
			$data['under_warranty_type'] = $warranty->service_type_name;
			/*$formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
			$formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
			$data['ordinal_array'] =  $formatter->format($warranty->service_count) . PHP_EOL;*/
			$data['ordinal_array'] =  $warranty->service_count;

		}

		$this->load->view($this->config->item('template_admin') . 'partial_billing', $data);
	}





	// for counter Billing
	public function counter_billing(){
		$this->load->view($this->config->item('template_admin') . 'part_bill_table', $part_data);
	}

	// for save
	public function save()
	{
		$post = $this->input->post();
		$post['bill_part_datas'] = json_decode($post['bill_part_datas'],TRUE);
		$post['bill_job_datas'] = json_decode($post['bill_job_datas'],TRUE);

		$billing_record = array(
			'jobcard_group'			=>	$post['bill_details']['job_no'],
			'bill_type'				=>	$post['bill_details']['bill_type_val'],
			'payment_type'			=>	$post['bill_details']['payment_type_val'],
			'issue_date'			=>	$post['bill_details']['issue_date'],

			'invoice_prefix'		=>	$post['bill_details']['invoice_no-prefix'],
			'invoice_no'			=>	$post['bill_details']['invoice_no'],

			'total_parts'		=>	$post['bill_summary']['total_for_parts'],
			'total_jobs'		=>	$post['bill_summary']['total_for_jobs'],
			'cash_discount_percent'	=>	$post['bill_summary']['cash_discount_percent'],
			'cash_discount_amt'		=>	$post['bill_summary']['cash_discount_amt'],
			'vat_percent'			=>	$post['bill_summary']['vat_percent'],
			'vat_parts'				=>	$post['bill_summary']['vat_parts'],
			'vat_job'				=>	$post['bill_summary']['vat_job'],
			'net_total'				=>	$post['bill_summary']['net_total'],
			);
		$billing_record = array_filter($billing_record, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});
		if($post['bill_details']['payment_type_val'] == 'cash')
			$billing_record['cash_account'] = $post['bill_details']['cash_account'];

		if($post['bill_details']['payment_type_val'] == 'credit')
			$billing_record['credit_account'] = $post['bill_details']['credit_account'];

		if($post['bill_details']['payment_type_val'] == 'card')
			$billing_record['card_account'] = $post['bill_details']['card_account'];

		$this->job_card_model->_table = "ser_billing_record";
		$this->job_card_model->insert($billing_record);


		foreach ($post['bill_job_datas'] as $key => $value) {
			if(! isset($value['ow'])) {
				$jobData = array(
					'id' 					=>	$value['id'],
					'cost'					=>	$value['cost'],
					'discount_percentage' 	=>	$value['discount_percentage'],
					'discount_amount' 		=>	$value['cost'] * ($value['discount_percentage']/100),
					'final_amount' 			=>	$value['final_amount'],
					'status' 				=>	$value['status'],
					);
				$this->job_card_model->_table = "ser_job_cards";
				$this->job_card_model->update($jobData['id'],$jobData);
			} else {
				// echo $value['ow'];
				$owData = array(
					'id'						=>	$value['id'],
					'billing_amount'			=>	$value['cost'],
					'billing_discount_percent'	=>	$value['discount_percentage'],
					'billing_final_amount'		=>	$value['final_amount'],
					);
				$this->job_card_model->_table = "ser_outside_work";
				$this->job_card_model->update($owData['id'],$owData);
			}
		}

		$this->job_card_model->_table = "ser_parts";
		foreach ($post['bill_part_datas'] as $key => $value) {
			$jobData = array(
				'id' 					=>	$value['id'],
				'part_id'				=>	$value['part_id'],
				'price' 				=>	$value['price'],
				'discount_percentage' 	=>	$value['discount_percentage'],
				'final_amount' 			=>	$value['final_price'],
				'status' 				=>	$value['status'],
				);
			$this->job_card_model->update($jobData['id'],$jobData);
		}

		echo json_encode(array('success'=>'true'));
	}

	private function _get_posted_data()
	{
		

		return $data;
	}

	public function user_list_json() 
	{
		$this->job_card_model->_table = "view_user_ledger";
		$rows = $this->job_card_model->findAll();

		echo json_encode($rows);


	}
}