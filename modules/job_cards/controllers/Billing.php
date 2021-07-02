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
        $this->load->model('post_service_followups/post_service_followup_model');
		$this->load->model('ccd_smr_twentyone_days/ccd_smr_twentyone_day_model');
        $this->load->model('ccd_2nd_smr_days/ccd_2nd_smr_day_model');
        $this->load->model('ccd_general_smrs/ccd_general_smr_model');
	}

	public function invoice(){
		// echo $this->fiscal_year_id[0]; exit;
		// $data['job_detail']['vehicle_id'] 		=  $this->input->get('vehicle_id');
		$data['job_detail']['jobcard_group'] 	=  $this->input->get('jobcard_group');
		$data['under_warranty'] = null;
		$data['ordinal_array'] = null;
		$data['under_warranty_type'] = null;
		$data['bill_id'] = '';
		$data['dealer_id'] = $this->dealer_id;


		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$data['jobcard'] = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));
		if(! $this->dealer_id) {
			echo "Error 403";
			return;
			exit;
		}

		if( ! $data['jobcard']) {
			echo "Jobcard not found.";
			return;
		}
		if( $data['jobcard']->closed_status == 0) {
			echo "Jobcard not closed";
			redirect(site_url('404_override'));
			return;
			exit;
		}

		$this->job_card_model->_table = "ser_billing_record";
		$data['has_billed'] = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));


		$this->job_card_model->_table = 'view_service_warranty_policy';
		
		$where = array(
			'service_policy_no'		=>	$data['jobcard']->service_policy_id,
			'service_type_id'		=>	$data['jobcard']->service_type,
			'service_count'			=>	$data['jobcard']->service_count,
		);
		$warranty = $this->job_card_model->find($where);
		// echo "<pre>"; var_dump($warranty);
		// echo $this->db->last_query(); exit;

		if($warranty) {
			$interval = date_diff(date_create($data['jobcard']->vehicle_sold_on), date_create(date('Y-m-d')));
			$interval = $interval->format('%m');

			if(($data['jobcard']->kms > $warranty->km_min && $data['jobcard']->kms < $warranty->km_max ) OR ($interval <= $warranty->period) ) {
				$data['under_warranty'] = true;
				$data['under_warranty_type'] = $warranty->service_type_name;

				$data['ordinal_array'] =  $warranty->service_count;
				// try{
					// $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
					// $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
					// $data['ordinal_array'] =  ucfirst($formatter->format($warranty->service_count)) . PHP_EOL;

				// } catch (Exception $e) {
					// $data['ordinal_array'] =  $warranty->service_count;
				// }

			}
		}


		if($data['has_billed']) {
			$data['job_url'] = site_url('job_cards/billing/get_billed_job');
			$data['part_url'] = site_url('job_cards/billing/get_billed_parts');

			// echo "has billed";
			// echo "<pre>";
			// print_r($data);
			// exit;

		} else {
			$data['job_url'] = site_url('job_cards/billing/get_billable_job');
			$data['part_url'] = site_url('job_cards/billing/get_billable_parts');
			// $this->job_card_model->_table = "view_service_job_card";
			// $data['vehicle_detail'] = $this->job_card_model->find(array('jobcard_group' =>  $this->input->get('jobcard_group') ));

			if( $data['jobcard']->service_type == 4) {
				// $data['service_count'] = $data['jobcard']->service_count;

				
			}

		}

		// Display Page
		$data['header'] = "Invoice";
		$data['page'] = $this->config->item('template_admin') . "partial_billing";
		$data['module'] = 'job_cards';		
		// 
		// echo "<pre>"; print_r($data);exit;
		$this->load->view($this->_container,$data);
		// exit;
		

/*		$this->job_card_model->_table = 'view_msil_dispatch_records';
		$where[] = $data['job_detail']['vehicle_id'];
		$data['vehicle_detail'] = $this->job_card_model->find_by('id', $where);*/
		

		// $this->job_card_model->_table = 'view_service_job_card';
		// $data['service_type'] = $this->job_card_model->find(array('jobcard_group'=> $this->input->get('jobcard_group')),'service_type, service_type_name');

		// $this->job_card_model->_table = 'view_vehicle_process';
		// $data['customer'] = $this->job_card_model->find_by('msil_dispatch_id',$data['job_detail']['vehicle_id']);

		// $data['bill_id'] = $this->get_billing_number();


		
		// $this->job_card_model->_table = "view_report_grouped_jobcard";
		// $fields = 'jobcard_group';
		// $this->db->group_by($fields);
		// $this->db->where('issue_date IS NOT NULL');
		// $data['service_count'] = count ($this->job_card_model->findAll(array('vehicle_no'=>$data['vehicle_detail']->vehicle_no,'jobcard_group'=>$data['vehicle_detail']->jobcard_group ),$fields)) + 1;
		// $data['service_count'] = $data['vehicle_detail']->service_count;

		
		// $this->job_card_model->_table = 'view_service_warranty_policy';
		// $warranty = $this->job_card_model->find(array('service_policy_no'=>$data['vehicle_detail']->service_policy_id, 'service_count' => $data['service_count'] ));
		
		// $interval = date_diff(date_create($data['vehicle_detail']->vehicle_sold_on), date_create(date('Y-m-d')));
		// $interval = $interval->format('%m');


		/*if($warranty) {

			if(($data['vehicle_detail']->kms > $warranty->km_min && $data['vehicle_detail']->kms < $warranty->km_max ) OR ($interval <= $warranty->period) ) {
				$data['under_warranty'] = true;
				$data['under_warranty_type'] = $warranty->service_type_name;

				// try{
					// $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
					// $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
					// $data['ordinal_array'] =  $formatter->format($warranty->service_count) . PHP_EOL;

				// } catch (Exception $e) {
				$data['ordinal_array'] =  $warranty->service_count;
					// print_r( $e->getMessage() );
				// }

			}
		}

		// $this->load->view($this->config->item('template_admin') . 'partial_billing', $data);

		// echo "<pre>"; print_r($data); exit;

		// Display Page
		$data['header'] = "Invoice";
		$data['page'] = $this->config->item('template_admin') . "partial_billing";
		$data['module'] = 'job_cards';		

		$this->load->view($this->_container,$data);*/
	}


	public function sale_return(){
		// print_r("expression");
		// exit();
		// echo $this->fiscal_year_id[0]; exit;
		// $data['job_detail']['vehicle_id'] 		=  $this->input->get('vehicle_id');
		$data['job_detail']['jobcard_group'] 	=  $this->input->get('jobcard_group');
		$data['under_warranty'] = null;
		$data['ordinal_array'] = null;
		$data['under_warranty_type'] = null;
		$data['bill_id'] = '';
		$data['dealer_id'] = $this->dealer_id;


		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$data['jobcard'] = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));

		if(! $this->dealer_id) {
			echo "Error 403";
			return;
			exit;
		}

		if( ! $data['jobcard']) {
			echo "Jobcard not found.";
			return;
		}
		if( $data['jobcard']->closed_status == 0) {
			echo "Jobcard not closed";
			redirect(site_url('404_override'));
			return;
			exit;
		}

		$this->job_card_model->_table = "ser_billing_record";
		$data['has_billed'] = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));


		$this->job_card_model->_table = 'view_service_warranty_policy';
		
		$where = array(
			'service_policy_no'		=>	$data['jobcard']->service_policy_id,
			'service_type_id'		=>	$data['jobcard']->service_type,
			'service_count'			=>	$data['jobcard']->service_count,
		);
		$warranty = $this->job_card_model->find($where);
		// echo "<pre>"; var_dump($warranty);
		// echo $this->db->last_query(); exit;

		if($warranty) {
			$interval = date_diff(date_create($data['jobcard']->vehicle_sold_on), date_create(date('Y-m-d')));
			$interval = $interval->format('%m');

			if(($data['jobcard']->kms > $warranty->km_min && $data['jobcard']->kms < $warranty->km_max ) OR ($interval <= $warranty->period) ) {
				$data['under_warranty'] = true;
				$data['under_warranty_type'] = $warranty->service_type_name;

				$data['ordinal_array'] =  $warranty->service_count;
				// try{
					// $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
					// $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
					// $data['ordinal_array'] =  ucfirst($formatter->format($warranty->service_count)) . PHP_EOL;

				// } catch (Exception $e) {
					// $data['ordinal_array'] =  $warranty->service_count;
				// }

			}
		}


		if($data['has_billed']) {
			$data['job_url'] = site_url('job_cards/billing/get_billed_job');
			$data['part_url'] = site_url('job_cards/billing/get_billed_parts');

			// echo "has billed";
			// echo "<pre>";
			// print_r($data);
			// exit;

		} else {
			$data['job_url'] = site_url('job_cards/billing/get_billable_job');
			$data['part_url'] = site_url('job_cards/billing/get_billable_parts');
			// $this->job_card_model->_table = "view_service_job_card";
			// $data['vehicle_detail'] = $this->job_card_model->find(array('jobcard_group' =>  $this->input->get('jobcard_group') ));

			if( $data['jobcard']->service_type == 4) {
				// $data['service_count'] = $data['jobcard']->service_count;

				
			}

		}

		// Display Page
		$data['header'] = "Sale Return";
		$data['page'] = $this->config->item('template_admin') . "sale_return";
		$data['module'] = 'job_cards';		

		// echo "<pre>"; print_r($data);exit;
		$this->load->view($this->_container,$data);
		// exit;
		

/*		$this->job_card_model->_table = 'view_msil_dispatch_records';
		$where[] = $data['job_detail']['vehicle_id'];
		$data['vehicle_detail'] = $this->job_card_model->find_by('id', $where);*/
		

		// $this->job_card_model->_table = 'view_service_job_card';
		// $data['service_type'] = $this->job_card_model->find(array('jobcard_group'=> $this->input->get('jobcard_group')),'service_type, service_type_name');

		// $this->job_card_model->_table = 'view_vehicle_process';
		// $data['customer'] = $this->job_card_model->find_by('msil_dispatch_id',$data['job_detail']['vehicle_id']);

		// $data['bill_id'] = $this->get_billing_number();


		
		// $this->job_card_model->_table = "view_report_grouped_jobcard";
		// $fields = 'jobcard_group';
		// $this->db->group_by($fields);
		// $this->db->where('issue_date IS NOT NULL');
		// $data['service_count'] = count ($this->job_card_model->findAll(array('vehicle_no'=>$data['vehicle_detail']->vehicle_no,'jobcard_group'=>$data['vehicle_detail']->jobcard_group ),$fields)) + 1;
		// $data['service_count'] = $data['vehicle_detail']->service_count;

		
		// $this->job_card_model->_table = 'view_service_warranty_policy';
		// $warranty = $this->job_card_model->find(array('service_policy_no'=>$data['vehicle_detail']->service_policy_id, 'service_count' => $data['service_count'] ));
		
		// $interval = date_diff(date_create($data['vehicle_detail']->vehicle_sold_on), date_create(date('Y-m-d')));
		// $interval = $interval->format('%m');


		/*if($warranty) {

			if(($data['vehicle_detail']->kms > $warranty->km_min && $data['vehicle_detail']->kms < $warranty->km_max ) OR ($interval <= $warranty->period) ) {
				$data['under_warranty'] = true;
				$data['under_warranty_type'] = $warranty->service_type_name;

				// try{
					// $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
					// $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
					// $data['ordinal_array'] =  $formatter->format($warranty->service_count) . PHP_EOL;

				// } catch (Exception $e) {
				$data['ordinal_array'] =  $warranty->service_count;
					// print_r( $e->getMessage() );
				// }

			}
		}

		// $this->load->view($this->config->item('template_admin') . 'partial_billing', $data);

		// echo "<pre>"; print_r($data); exit;

		// Display Page
		$data['header'] = "Invoice";
		$data['page'] = $this->config->item('template_admin') . "partial_billing";
		$data['module'] = 'job_cards';		

		$this->load->view($this->_container,$data);*/
	}


	// for save
	public function save()
	{
		// echo '<pre>'; print_r($this->input->post()); exit;
		$this->db->trans_begin();

		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$jobcard = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));

		if(! $this->dealer_id) {
			echo "Error 403";
			return;
			exit;
		}

		if($jobcard) {
			// if( $jobcard->closed_status == 0) {
			echo "Unable to create bill";
			return;
			exit;
			// }
		}

		$post['bill_job_datas'] = $this->input->post('bill_job_datas');
		$post['bill_part_datas'] = $this->input->post('bill_part_datas');
		$post['bill_details'] = $this->input->post('bill_details');
		$post['bill_summary'] = $this->input->post('bill_summary');

		// if($post['bill_details']['invoice_no']) {
			// $invoice_no = $post['bill_details']['invoice_no'];
		// } else {
		$invoice_no = $this->get_billing_number();
		// }


		$billing_record = array(
			'dealer_id'			=>	$this->dealer_id,
			
			'jobcard_group'			=>	$post['bill_details']['job_no'],
			'bill_type'				=>	$post['bill_details']['bill_type_val'],
			'payment_type'			=>	$post['bill_details']['payment_type_val'],
			'issue_date'			=>	$post['bill_details']['issue_date'],

			// 'invoice_prefix'		=>	$post['bill_details']['invoice_no-prefix'],
			'invoice_no'			=>	$invoice_no,

			'total_parts'		=>	$post['bill_summary']['total_for_parts'],
			'total_jobs'		=>	$post['bill_summary']['total_for_jobs'],
			'cash_discount_percent'	=>	$post['bill_summary']['cash_discount_percent'],
			'cash_discount_amt'		=>	$post['bill_summary']['cash_discount_amt'],
			'vat_percent'			=>	$post['bill_summary']['vat_percent'],
			'vat_parts'				=>	$post['bill_summary']['vat_parts'],
			'vat_job'				=>	$post['bill_summary']['vat_job'],
			'net_total'				=>	$post['bill_summary']['net_total'],
			'fiscal_year_id'		=> 	$this->fiscal_year_id[0],

		);

		if($post['bill_details']['payment_type_val'] == 'cash')
			$billing_record['cash_account'] = $post['bill_details']['cash_account'];

		if($post['bill_details']['payment_type_val'] == 'credit')
			$billing_record['credit_account'] = $post['bill_details']['credit_account'];

		if($post['bill_details']['payment_type_val'] == 'card')
			$billing_record['card_account'] = $post['bill_details']['card_account'];		

		$billing_record = array_filter($billing_record, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		$this->job_card_model->_table = "ser_billing_record";
		$billing_id = $this->job_card_model->insert($billing_record);
		$total_jobs_amt = 0;
		$total_parts_amt = 0;


		if($post['bill_job_datas']) {
			$jobData = array();
			$owData = array();
			foreach ($post['bill_job_datas'] as $key => $value) {
				if(! isset($value['ow'])) {
					$temp = array(
						'billing_id' 			=>	$billing_id,
						'job_id' 				=>	$value['job_id'],
						'price'					=>	$value['cost']?$value['cost']:0,
						'discount_percentage' 	=>	($value['discount_percentage'])?$value['discount_percentage']:NULL,
						'discount_amount' 		=>	$value['cost'] * ($value['discount_percentage']/100),
						'final_amount' 			=>	$value['final_amount']?$value['final_amount']:0,
						'status' 				=>	$value['status'],
					);
					$total_jobs_amt += $temp['final_amount'];
					$jobData[] = $temp;
					// $jobData[] = array_filter($temp, function($value) {
					// 	return ($value !== null && $value !== false && $value !== ''); 
					// });

				} else {
					$temp = array(
						'billing_id' 			=>	$billing_id,
						'job_id'				=>	$value['job_id'],
						'price'					=>	$value['cost'],
						'discount_amount' 		=>	$value['cost'] * ($value['discount_percentage']/100),
						'discount_percentage'	=>	($value['discount_percentage'])?$value['discount_percentage']:NULL,
						'final_amount'			=>	$value['final_amount'],
						'margin_percentage'		=>	$value['margin_percentage']?$value['margin_percentage']:0
					);
					$total_jobs_amt += $temp['final_amount'];
					$owData[] = $temp;

					// $owData[] = array_filter($temp, function($value) {
					// 	return ($value !== null && $value !== false && $value !== ''); 
					// });
				}
			}
			// echo '<pre>'; print_r($jobData); exit;
			if($owData) {
				$this->job_card_model->_table = "ser_billed_outsidework";
				$this->job_card_model->insert_many($owData);

			}

			if($jobData) {
				$this->job_card_model->_table = "ser_billed_jobs";
				$this->job_card_model->insert_many($jobData);

			}

		}

		if($post['bill_part_datas']) {
			$partData = array();
			foreach ($post['bill_part_datas'] as $key => $value) {
				$partData[] = array(
					'billing_id' 			=>	$billing_id,
					'part_id'				=>	$value['part_id'],
					'price' 				=>	$value['price']?$value['price']:0,
					'quantity' 				=>	($value['quantity'])?$value['quantity']:0,
					'lube_quantity' 		=>	($value['lube_quantity'])?$value['lube_quantity']:0,
					'warranty' 				=>	@$value['warranty'],
					'discount_percentage' 	=>	@$value['discount_percentage'],
					'final_amount' 			=>	$value['final_price'],
				);
				$total_parts_amt += $value['final_price'];
				/*$partData[] = array_filter($temp, function($value) {
						return ($value !== null && $value !== false && $value !== ''); 
					});*/
			}
			if($partData) {
				$this->job_card_model->_table = "ser_billed_parts";
				$this->job_card_model->insert_many($partData);
			}
		}
		$job_vat = $total_jobs_amt * VAT_PERCENTAGE / 100;
		$part_vat = $total_parts_amt * VAT_PERCENTAGE / 100;
		$total_amt = $total_parts_amt + $total_jobs_amt + $job_vat + $part_vat;

		if(!$billing_record['total_jobs']){
			$data = array();
			$data['total_jobs'] = $total_jobs_amt;
			$data['id'] = $billing_id;
			$data['vat_job'] = $job_vat;
			$data['vat_parts'] = $part_vat;
			$data['net_total'] = $total_amt;
			$this->job_card_model->_table = "ser_billing_record";
			$success = $this->job_card_model->update($data['id'],$data);
		}

		if(!$billing_record['total_parts']){
			$data = array();
			$data['total_parts'] = $total_parts_amt;
			$data['id'] = $billing_id;
			$data['vat_job'] = $job_vat;
			$data['vat_parts'] = $part_vat;
			$data['net_total'] = $total_amt;
			$this->job_card_model->_table = "ser_billing_record";
			$success = $this->job_card_model->update($data['id'],$data);
		}

		if($billing_id){
			$psr['jobcard_group'] = $post['bill_details']['job_no'];
			$this->post_service_followup_model->insert($psr);

			// $this->job_card_model->_table = "view_report_grouped_jobcard";
			// $jobcard_info = $this->job_card_model->find(array('jobcard_group'=>$post['bill_details']['job_no']));

			// $this->ccd_smr_twentyone_day_model->_table = 'view_ccd_smr_twentyone_days';
			// $this->db->where('schedule_date >=',date('Y-m-d'));
			// $twentyone = $this->ccd_smr_twentyone_day_model->find(array('engine_no' => $jobcard_info->engine_no, 'chass_no' => $jobcard_info->chassis_no));

			// $this->db->where('schedule_date >=',date('Y-m-d'));
			// $this->ccd_2nd_smr_day_model->_table = 'view_cc_2nd_smr';
			// $second = $this->ccd_2nd_smr_day_model->find(array('engine_no' => $jobcard_info->engine_no, 'chass_no' => $jobcard_info->chassis_no));


			// $this->ccd_smr_twentyone_day_model->_table = 'view_customers';
			// $customer = $this->ccd_2nd_smr_day_model->find(array('engine_no' => $jobcard_info->engine_no, 'chass_no' => $jobcard_info->chassis_no));
			// if($twentyone || $second){}else{
			// 	$ccd['jobcard_group'] = $post['bill_details']['job_no'];
			// 	$ccd['closed_date'] = date('Y-m-d');
			// 	$ccd['vehicle_no'] = $jobcard_info->vehicle_no;
			// 	$ccd['vehicle_id'] = $jobcard_info->vehicle_id;
			// 	$ccd['variant_id'] = $jobcard_info->variant_id;
			// 	$ccd['color_id'] = $jobcard_info->color_id;
			// 	$ccd['chassis_no'] = $jobcard_info->chassis_no;
			// 	$ccd['engine_no'] = $jobcard_info->engine_no;
			// 	$ccd['customer_id'] = @$customer->id;

			// 	$ccd['schedule_date'] =  date('Y-m-d',strtotime(date('Y-m-d')."+113 days"));
			// 	$this->ccd_general_smr_model->insert($ccd);
			// }
		}

		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$success = FALSE;
		}
		else
		{
			$this->db->trans_commit();
			$success = TRUE;
		}

		echo json_encode(array('success' => $success));
	}

	public function user_list_json() 
	{

		// echo json_encode(array());
		// exit;
		$this->job_card_model->_table = "view_user_ledger";
		// $this->db->limit(0,100);
		$rows = $this->job_card_model->findAll(array('dealer_id'=>$this->dealer_id),'id,full_name');

		echo json_encode($rows);


	}

	function get_billable_job() {

		$this->job_card_model->_table = 'view_service_job_card';
		$where['jobcard_group'] = $this->input->get('jobcard_group');

		$rows = $this->job_card_model->find_all($where);
		$total = count($rows);

		foreach ($rows as $key => $value) {
			$rows[$key]->has_billed = 0;
		}

		$this->job_card_model->_table = 'view_outside_works';
		$ow_rows = $this->job_card_model->findAll($where);

		// echo '<pre>';print_r($total);exit;

		foreach ($ow_rows as $key => $value) {
			$k = $total+$key;
			$rows[$k]['id'] = $value->id;
			$rows[$k]['job_id'] = $value->workshop_job_id;
			$rows[$k]['job'] = $value->job_code;
			$rows[$k]['job_description'] = $value->description;
			// $rows[$k]['min_price'] = $value->id;
			$rows[$k]['customer_price'] = $value->amount + $value->taxes;
			$rows[$k]['cost'] = $value->total_amount;
			$rows[$k]['discount_amount'] = $value->discount;
			$rows[$k]['discount_percentage'] = ($value->discount / $value->total_amount ) * 100;
			// $rows[$k]['final_amount'] = $value->total_amount;
			$total_ow = $value->amount * $value->margin_percentage/100;
			$rows[$k]['final_amount'] = $value->total_amount + $total_ow;
			$rows[$k]['margin_percentage'] = $value->margin_percentage;
			// $rows[$k]['status'] = '';
			$rows[$k]['ow'] = true;
		}
		$total += count($ow_rows);
		// echo '<pre>';print_r($rows);exit;

		echo json_encode(array('total' => $total, 'rows' => $rows));
	}

	
	function get_billable_parts() {
		$this->job_card_model->_table = 'view_material_scan';

		$where['jobcard_group'] = $this->input->get('jobcard_group');

		$rows = $this->job_card_model->find_all($where);
		$total = count($rows);

		foreach ($rows as $key => $value) {
			$rows[$key]->has_billed = 0;
		}


		echo json_encode(array('total' => $total, 'rows' => $rows));
	}

	function get_billed_job() {
		// echo json_encode(array('total' => 0, 'rows' => []));
		// exit;
		$this->job_card_model->_table = 'view_service_billing_jobs';
		$where['jobcard_group'] = $this->input->get('jobcard_group');

		search_params();
		$rows = $this->job_card_model->find_all($where);
		$total = count($rows);

		foreach ($rows as $key => $value) {
			$rows[$key]->has_billed = 1;
			$rows[$key]->cost = $rows[$key]->price;
		}
		
		$this->job_card_model->_table = 'view_service_billing_outsideworks';
		$ow_rows = $this->job_card_model->findAll($where);

		foreach ($ow_rows as $key => $value) {
			$k = $total+$key;
			$rows[$k]['id'] = $value->id;
			$rows[$k]['job_id'] = $value->job_id;
			$rows[$k]['job'] = $value->job;
			$rows[$k]['job_description'] = $value->job_description;
			// $rows[$k]['min_price'] = $value->id;
			// $rows[$k]['customer_price'] = $value->amount + $value->taxes;
			$rows[$k]['cost'] = $value->price;
			$rows[$k]['discount_amount'] = $value->discount_amount;
			$rows[$k]['discount_percentage'] = $value->discount_percentage;
			$rows[$k]['margin_percentage'] = $value->margin_percentage;
			$rows[$k]['final_amount'] = $value->final_amount;
			// $rows[$k]['status'] = '';
			$rows[$k]['ow'] = true;
			$rows[$k]['has_billed'] = 1;
		}
		$total += count($ow_rows);



		echo json_encode(array('total' => $total, 'rows' => $rows));
	}

	function get_billed_parts() {
		// echo json_encode(array('total' => 0, 'rows' => []));
		// exit;
		$this->job_card_model->_table = 'view_service_billing_parts';

		$where['jobcard_group'] = $this->input->get('jobcard_group');

		$rows = $this->job_card_model->find_all($where);

		foreach ($rows as $key => $value) {
			$rows[$key]->has_billed = 1;
		}

		$total = count($rows);
		echo json_encode(array('total' => $total, 'rows' => $rows));
	}
}