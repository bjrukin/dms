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

class Counter extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Job Cards');

		$this->load->model('job_cards/job_card_model');
		$this->lang->load('job_cards/job_card');
	}

	public function index(){
		$this->job_card_model->_table = 'ser_billing_record';

		/*$field = array("max(id)");
		$max_bill = $this->job_card_model->find_all(NULL,$field);
		$data['bill_id'] = $max_bill[0]->max + 1;*/
		$data['bill_id'] = $this->get_billing_number();

		$this->load->view($this->config->item('template_admin') . 'partial_counter_form',$data);
		// $this->load->view($this->config->item('template_admin') . 'counter_form',$data);
	}

	public function save(){
		$post = $this->input->post();

		$bill_details = $post['bill_details'];
		$bill_summary = $post['bill_summary'];
		$bill_parts = $post['bill_part_datas'];

		$bill_details = array_filter($bill_details, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});


		$counter_sales_id = $this->get_counter_sales_number();

		/*Know if its insert or update*/
		if(isset($post['bill_details']['counter_sales_id'])) {
			/*Insert data for billing table*/
			$data2 = array(
				'bill_type'		=>	'counter',
				'payment_type'	=>	$bill_details['payment_type_val'],
				'issue_date'			=>	$bill_details['issue_date'],
				'credit_account'		=>	$bill_details['credit_account'],

				'invoice_no-prefix'		=>	@$bill_details['invoice_no-prefix'],
				'invoice_no'			=>	$bill_details['invoice_no'],

				'total_parts'			=>	$bill_summary['total_for_parts'],
				'total_jobs'			=>	$bill_summary['total_for_jobs'],
				'cash_discount_percent'	=>	$bill_summary['cash_discount_percent'],
				'cash_discount_amt'		=>	$bill_summary['cash_discount_amt'],
				'vat_percent'			=>	$bill_summary['vat_percent'],
				'vat_parts'				=>	$bill_summary['vat_parts'],
				'vat_job'				=>	$bill_summary['vat_job'],
				'net_total'				=>	$bill_summary['net_total'],

				);
			$data2 = array_filter($data2, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});
			$this->job_card_model->_table = "ser_billing_record";
			$billing_record_id = $this->job_card_model->insert($data2);

			/*insert data for counter table*/
			$data = array(
				'date_time'			=>	$bill_details['issue_date'],
				'party_id'			=>	$bill_details['credit_account'],

				'vehicle_no'		=>	$bill_details['vehicle_no'],
				'chasis_no'			=>	$bill_details['engine_no'],
				'engine_no'			=>	$bill_details['chassis_no'],
				'vehicle_id'		=>	$bill_details['vehicle_id'],
				'variant_id'		=>	$bill_details['variant_id'],
				// 'color_id'			=>	$bill_details['vehicle_no'],
				'counter_sales_id'	=>	$counter_sales_id,
				'billing_record_id'	=>	$billing_record_id,
				);
			$this->job_card_model->_table = "ser_counter_sales";
			$counter_id = $this->job_card_model->insert($data);
			


			/*Insert data for parts table*/
			$this->job_card_model->_table = "ser_parts";
			foreach ($bill_parts as $key => $value) {
				$data3 = array(
					'part_id'				=>	$value['part_id'],
					'price'					=>	$value['price'],
					'quantity'				=>	$value['quantity'],
					'discount_percentage'	=>	@$value['discount'],
					'warranty'				=>	@$value['warranty'],
					'final_amount'			=>	$value['total'],
					'bill_id'				=>	$counter_id,

					);
				$data3 = array_filter($data3, function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});
				$this->job_card_model->insert($data3);
			}



			echo json_encode(array('success' => TRUE));
			exit;
		}
		else {

		}

	}

	public function save_counter() {

	}

	public function findCounterInvoice() {
		$post = $this->input->post();
		if($post['prefix'] == ''){
			$post['prefix'] = NULL;
		}
		$this->job_card_model->_table = "view_counter_billing";
		$data = $this->job_card_model->findAll(array('invoice_prefix'=>$post['prefix'], 'invoice_no' => $post['invoice_no']));
		
		if($data == false)
		{
			echo json_encode(array('success'=> false));
			exit;
		}

		echo json_encode(array('success'=> true, 'row' => $data));
	}
}