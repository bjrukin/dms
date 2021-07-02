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

class Job_cards extends Project_Controller
{

	public function __construct()
	{
		parent::__construct();

		control('Job Cards');

		$this->load->model('job_cards/job_card_model');
		
		$this->load->model('ccd_smr_twentyone_days/ccd_smr_twentyone_day_model');
		$this->load->model('ccd_2nd_smr_days/ccd_2nd_smr_day_model');
		$this->load->model('ccd_general_smrs/ccd_general_smr_model');
		$this->lang->load('job_cards/job_card');

		// print_r($this->session->all_userdata());exit;
	}

	public function info(){
		phpinfo();
	}

	public function index()
	{
		// Display Page
		$data['dealer_id'] = $this->dealer_id;
		$data['header'] = lang('job_cards');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'job_cards';	

		$this->load->view($this->_container,$data);
	}

	public function change_job_date()
	{
		// $this->db->where('dealer_id', 41);
		$this->db->where('issue_date >= ','2020-07-16');
		$row = $this->job_card_model->findAll();
		// echo '<pre>'; 
		
		echo '<pre>'; print_r($row); exit;
	}


	public function get_job_price_info()
	{
		$code = $this->input->post('job_code');
		$vehicle_id = $this->input->post('vehicle_id');
		$this->job_card_model->_table = 'mst_service_jobs';
		$service_job = $this->job_card_model->find(array('job_code' => $code));
		$this->job_card_model->_table = 'mst_service_job_description';
		$price = $this->job_card_model->find(array('service_job_id' => $service_job->id,'vehicle_id'=>$vehicle_id));
		if($price){
			$success = true;
		}else{
			$success = false;
		}
		// echo '<pre>'; print_r($price); exit;
		echo json_encode(array('success'=>$success,'price'=>$price));
	}
	public function json()
	{
		
		$where = NULL;

		if(is_admin() || is_service_finance()){
		} else if( is_service_advisor() || is_accountant() ||  is_workshop_manager()) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where["dealer_id"] = $this->dealer_id;
			}
		} else if(is_floor_supervisor()){
			$where["dealer_id"] = $this->dealer_id;
			if(!$this->_user_id == 321){
				$where['floor_supervisor_id'] = $this->_user_id;
				
			}
		} else if( is_service_head() || is_national_service_manager() || is_admin() ){

		} else if( is_service_dealer_incharge() ) {
			$this->load->model('dealers/dealer_model');
			$dealers_of = $this->dealer_model->findAll(array('service_incharge_id' => $this->_user_id),'id');

			$dealers_list = null;
			foreach ($dealers_of as $key => $value) {
				$dealers_list[] = $value->id;
			}			

			$this->db->where_in('dealer_id', $dealers_list);
			unset($dealers_list);

			

			// $this->job_card_model->_table = 'view_report_grouped_jobcard';
			// $rows = $this->job_card_model->findAll($where);
			// echo $this->db->last_query();

		} else {
			$where["dealer_id"] = $this->dealer_id;
		}
		$this->db->order_by('dealer_id');

		$fields = '';
		// $fields = 'job_card_issue_date, jobcard_group, vehicle_no, engine_no, chassis_no, vehicle_id, vehicle_name, variant_id, variant_name, color_id, color_name, closed_status, customer_name';


		// $this->job_card_model->_table = 'view_service_job_card';
		$this->job_card_model->_table = 'view_report_grouped_jobcard';
		// if(is_sparepart_dealer_incharge() || is_sparepart_dealer()){
		// 	$this->db->where('material_issued_status', 1);

		// }
		paging('job_card_issue_date');

		search_params();
		// $this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$rows = $this->job_card_model->findAll($where);
		// print_r($this->db->last_query()); exit;
		
		// if(is_sparepart_dealer_incharge() || is_sparepart_dealer()){
		// 	$this->db->where('material_issued_status', 1);

		// }
		search_params();
		// $this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$total = $this->job_card_model->find_count($where);
		// print_r($this->db->last_query()); exit;
		

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function change_mechanic($mechanics_id , $jobcard_group){
		$return_mecha = null;
		$this->job_card_model->_table = 'view_report_grouped_jobcard';
		$getjob = $this->job_card_model->find(array('jobcard_group' => $jobcard_group));
		if($getjob->mechanics_id != $mechanics_id){
			if($mechanics_id == NULL || $mechanics_id == ''){
				$return_mecha = $getjob->mechanics_id;
			}else{
				$this->db->where('jobcard_group',$jobcard_group);
				$this->db->where('dealer_id',$this->dealer_id);
				$this->db->set('mechanics_id',$mechanics_id);
				$this->db->update('ser_job_cards');

				$return_mecha = $mechanics_id;

			}
		}else{
			$return_mecha = $mechanics_id;
		}

		return $return_mecha;
		
	}

	public function save()
	{
		$all_data = $this->_get_posted_data();
		// echo '<pre>'; print_r($all_data); exit;

		$this->db->trans_begin();

		if( ! isset($all_data['jobcard'])) {
			echo json_encode(array('msg' => 'No Jobs to save.', 'success' => false, ));
			exit;
		}

		/*To check if action for insert or update*/
		$this->job_card_model->_table = "view_service_job_card";
		$jobcard = $this->job_card_model->find(array('jobcard_group' => $all_data['details']['jobcard_group']));

		// print_r($all_data);exit;


		$this->job_card_model->_table = "ser_job_cards";
		if($jobcard == false) {
			// insert
			// $success = $this->job_card_model->insert_many($all_data['jobcard']);
			foreach ($all_data['jobcard'] as $key => $value) {
				$value['service_adviser_id'] = $this->_user_id;
				$this->job_card_model->insert($value);
			}
		}
		else {
			// $existing = $this->job_card_model->find(array('jobcard_group' => $all_data['jobcard'][0]['jobcard_group']));
			$mechanics_id = $this->change_mechanic($all_data['details']['mechanics_id'], $all_data['details']['jobcard_group']);
			// $service_adviser_id = $this->change_service_adviser($all_data['details']['mechanics_id'], $all_data['details']['jobcard_group']);
			$existing = $this->job_card_model->find(array('jobcard_group' => $all_data['details']['jobcard_group']));
			// update
			$this->job_card_model->_table = "ser_job_cards";
			// update
			foreach ($all_data['jobcard'] as $key => $value) {
				if( isset($value['id'])) {
					// unset($value['fiscal_year_id']);
					$success = $this->job_card_model->update($value['id'], $value);
				}
				else {
					$value['service_adviser_id'] = $existing->service_adviser_id;
					$value['mechanics_id'] =       $mechanics_id;
					$value['pdi_kms'] =            $existing->pdi_kms;
					
					$success = $this->job_card_model->insert($value);
				}
			}
		}

		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$success = FALSE;
			$msg=lang('general_failure');
		}
		else
		{
			$this->db->trans_commit();

			if($jobcard == false) { 
				if($all_data['details']['service_type'] == 4)
				{
					$default_item = array('OIL FILTER','ENGINE OIL GULF');
					foreach ($default_item as $key => $value) 
					{
						$floor = array(
							'dealer_id'=>$all_data['details']['dealer_id'],
							'part_name'=>$value,
							'jobcard_group'=>$all_data['details']['jobcard_group'],
							'quantity'=> 1
						);
						$this->job_card_model->_table = "ser_floor_supervisor_advice";
						$this->job_card_model->insert($floor);
					}

				}
			}

			$success = TRUE;
			$msg=lang('general_success');
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success, 'jobno'=>$all_data['details']['jobcard_group']));
		exit;		
	}

	private function _get_posted_data()
	{
		$data =array();

		$raw = $this->input->post('data');
		//Get service count
		// $this->job_card_model->_table = "view_report_grouped_jobcard";
		// $this->db->group_by('jobcard_group');
		// $this->db->where('issue_date is not null');
		// $service_count = $this->job_card_model->find(array('vehicle_no' => $raw['vehicle_register_no']), 'count(jobcard_group)' );
		$this->db->order_by('jobcard_group','desc');
		$new_job_id = $this->job_card_model->find();
		$new_job_id = ($new_job_id)?++$new_job_id->jobcard_group:1;

		$this->db->order_by('jobcard_serial','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$new_job_serial = $this->job_card_model->find();
		// echo $this->db->last_query()
		$new_job_serial = $new_job_serial?++$new_job_serial->jobcard_serial: 1;

		if($raw['jobcard_group']) {
			$new_job_id = $raw['jobcard_group'];
		}
		if($raw['jobcard_serial']) {
			$new_job_serial = $raw['jobcard_serial'];
		}

		if($raw['service_type']==8){
			$tire_make = $raw['tire_make'];
			$battery_no = $raw['battery_no'];
		}else{
			$tire_make = '';
			$battery_no = '';
		}
		$data['details'] = array(
			'jobcard_group'			=>	$new_job_id,  //serial increment over the table; Works like 'id'
			'jobcard_serial'       	=>  $new_job_serial,  // serial increment grouped by dealers
			'vehicle_no'			=>	strtoupper($raw['vehicle_register_no']),
			'engine_no'				=>	strtoupper($raw['engine_no']),
			'chassis_no'			=>	strtoupper($raw['chassis_no']),
			'gear_box_no'			=>	$raw['gear_box_no'],
			'vehicle_id'			=>	$raw['vehicle_name'],
			'variant_id'			=>	@$raw['variant_name'],
			'color_id'				=>	@$raw['color_name'],
			'service_type'			=>	$raw['service_type'],
			'service_count'        	=>  $raw['service_no'],
		 // 'service_count'			=>	($service_count)?$service_count->count:1,
			'key_no'				=>	$raw['key_no'],
			'kms'					=>	$raw['kms'],
			'fuel'					=>	$raw['fuel'],
			'floor_supervisor_id'	=>	$raw['floor_supervisor_id'],
			'mechanics_id'			=>	$raw['mechanics_id'],
			'cleaner_id'			=>	$raw['cleaner_id'],
			'vehicle_sold_on'		=>	$raw['vehicle_sold_on'],
			'party_id'				=>	$raw['party_id'],
			'coupon'               	=>  $raw['coupon'],
			'issue_date'           	=>  $raw['issue_date'],
			'mechanic_list'			=>	@$raw['mechanic_list'],
			'year'                 	=>  $raw['year'],
			'reciever_name'        	=>  $raw['reciever_name'],
			'remarks'              	=>  $raw['remarks'],
			'dealer_id'            	=>  $this->dealer_id,
			'pdi_kms'              	=>  $raw['pdi_kms'],
			'pdi_inspector'			=>	@$raw['pdi_inspector'],
			'accessories'			=>	$raw['accessories'],
			'sell_dealer'			=>	$raw['sell_dealer'],
			'tire_make'			    =>	$tire_make,
			'battery_no'			=>	$battery_no,
			// 'fiscal_year_id'		=> 	$this->fiscal_year_id[0],
			'fiscal_year_id'		=>  ($raw['fiscal_year_id'])?$raw['fiscal_year_id']:$this->fiscal_year_id[0],
			
		);

		/*$data['details'] = array_filter($data['details'], function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});*/
		$raw_jobData = $this->input->post('jobData');
		$raw_partData = $this->input->post('partData');

		if($raw_jobData) {
			foreach ($raw_jobData as $key => $value) {
				$data['jobcard'][$key] = $data['details'];
				$data['jobcard'][$key]['id'] = isset($value['id'])?$value['id']:'';
				$data['jobcard'][$key]['customer_voice'] = substr($value['customer_voice'], 0, 254);
				$data['jobcard'][$key]['advisor_voice'] = substr($value['advisor_voice'], 0, 254);
				$data['jobcard'][$key]['job_id'] = $value['job_id'];
				$data['jobcard'][$key]['cost'] = $value['price'];
				$data['jobcard'][$key]['final_amount'] = $value['price'];
				$data['jobcard'][$key]['status'] = $value['status'];

				$data['jobcard'][$key] = array_filter($data['jobcard'][$key], function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});
			}
		}

		if($raw_partData) {

			foreach ($raw_partData as $key => $value) {
				$data['parts'][$key]['jobcard_group'] = $data['details']['jobcard_group'];
				$data['parts'][$key]['part_id'] = $value['id'];
				$data['parts'][$key]['price'] = $value['price'];
				$data['parts'][$key]['quantity'] = $value['quantity'];

				$data['parts'][$key] = array_filter($data['parts'][$key], function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});
			}
		}

		return $data;
		exit;

	}

/*    public function get_vehicle_no_json(){
		$this->job_card_model->_table = 'view_user_ledger';
		$where = array('vehicle_no <>' => NULL);

		$fields = ('vehicle_no');

		$this->db->group_by($fields);
		$rows = $this->job_card_model->findAll($where, $fields);

		echo json_encode($rows);
	}*/

	public function get_job_card_json(){
		$this->job_card_model->_table = 'view_msil_dispatch_records';
		$where = array('vehicle_register_no <>' => NULL);

		$fields = ('id, vehicle_register_no AS name');

		$rows = $this->job_card_model->findAll($where, $fields);

		array_unshift($rows, array('id' => '', 'name' => 'Select Vehicle No.'));

		echo json_encode($rows);
	}

	public function vehicle_detail(){
		$index = $this->input->post('field');
		$value = $this->input->post('value');

		$row = $this->get_msil_dispatch_vehicle($index,$value);

		$this->job_card_model->_table = 'view_dealer_stock';
		$where['vehicle_id'] = $row['0']->id;
		$row['dealer'] = $this->job_card_model->findAll($where);

		$row['number_of_service'] = $this->get_service_number($where['vehicle_id']);

		$this->job_card_model->_table = 'view_vehicle_process';

		$row['customer'] = $this->job_card_model->find_by('msil_dispatch_id',$value);

		echo json_encode($row);
	}

   // get supervisor and mechanics
	public function get_user_combo_json() 
	{
		$this->load->model('users/user_group_model');
		$this->user_group_model->_table = 'view_service_user_group';

		$where['group'] = $this->input->get('group');
		$where['dealer_id'] = $this->dealer_id;

		$this->user_group_model->order_by('name asc');
		$fields = array('user_id AS id','username AS name');

		$rows=$this->user_group_model->findAll($where, $fields);

		array_unshift($rows, array('id' => '0', 'name' => 'Select Group'));

		echo json_encode($rows);
		exit;
	}

	// get service number
	public function get_service_number($vehicle_reg_no = NULL){
		if($vehicle_reg_no == NULL){
			$data['msg'] = 'vehicle_reg_no is required';
			$data['success'] = FALSE;

			return $data;
			exit;
		}

		$this->job_card_model->_table = "ser_job_cards";
		$where = array(
			// 'jobcard_group IS NOT '=> NULL,
			'vehicle_no'	=>	$vehicle_reg_no,
		);
		$fields = 'jobcard_group';
		$this->db->group_by($fields);
		$data['count'] =  ($this->job_card_model->findAll($where, $fields));


		// $this->job_card_model->_table = 'view_service_job_card';
		// $where['vehicle_register_no'] = $vehicle_reg_no;
		// $fields = 'COUNT(id) AS service_no';
		// $this->db->group_by('jobcard_group');
		// $data['count'] = $this->job_card_model->find_all($where,$fields);


		return count($data['count']);
		exit;

	}

	// data for estimate form
	public function estimate_form(){
		$this->job_card_model->_table = 'view_service_job_card';
		$data['job_detail'] = $this->input->post();

		$where['vehicle_id'] = $this->input->post('vehicle_id');
		$where['jobcard_group'] = $this->input->post('jobcard_group');

		$data['vehicle_detail'] = $this->job_card_model->find_all($where);

		$data['page'] = $this->config->item('template_admin') . "estimate";

		$this->load->view($data['page'],$data);
	}

	// job_data for estimate form
	/*public function estimate_form_data_json(){
		$this->job_card_model->_table = 'view_service_job_card';

		$where['jobcard_group'] = $this->input->get('jobcard_group');
		// $where['vehicle_id'] = $this->input->get('vehicle_id');

		$total = $this->job_card_model->find_count($where);
		$rows = $this->job_card_model->find_all($where);

		foreach ($rows as $key => $value) {
			if($value->status == 'PENDING'){
				$rows[$key]->stat = FALSE;
			}else{
				$rows[$key]->stat = TRUE;
			}

		}
		$this->job_card_model->_table = "ser_billing_record";
		$has_billed = $this->job_card_model->find(array('jobcard_group'=>$this->input->get('jobcard_group')));
		if($has_billed) {
			$has_billed = 1;
		} else {
			$has_billed = 0;
		}
		foreach ($rows as $key => $value) {
			$rows[$key]->has_billed = $has_billed;
		}

		// echo "<pre>"; print_r($rows);exit;

		$this->job_card_model->_table = 'view_outside_works';
		$ow_rows = $this->job_card_model->findAll($where);

		foreach ($ow_rows as $key => $value) {
			$k = $total+$key;
			$rows[$k]['id'] = $value->id;
			$rows[$k]['job_id'] = $value->workshop_job_id;
			$rows[$k]['job'] = $value->job_code;
			$rows[$k]['job_description'] = $value->description;
			// $rows[$k]['min_price'] = $value->id;
			$rows[$k]['customer_price'] = $value->total_amount;
			$rows[$k]['cost'] = ($value->billing_amount)?$value->billing_amount:$value->total_amount;
			// $rows[$k]['discount_amount'] = $value->billing_discount_percent;
			$rows[$k]['discount_percentage'] = $value->billing_discount_percent;
			$rows[$k]['final_amount'] = ($value->billing_final_amount)?$value->billing_final_amount:$value->total_amount;
			$rows[$k]['status'] = '';
			$rows[$k]['ow'] = true;
		}
		$total += count($ow_rows);


		echo json_encode(array('total' => $total, 'rows' => $rows));
	}*/

	// parts data for estimate form
	public function estimate_for_parts_json(){
		$this->job_card_model->_table = 'view_service_parts';

		$where['jobcard_group'] = $this->input->get('jobcard_group');
		// $where['vehicle_id'] = $this->input->get('vehicle_id');

		if($this->input->get('status')){
			$where['status'] = $this->input->get('status');
		}

		$total = $this->job_card_model->find_count($where);

		$rows = $this->job_card_model->find_all($where);

		echo json_encode(array('total' => $total, 'rows' => $rows));	
	}


	public function get_estimate_number() {
		$this->job_card_model->_table = 'ser_estimate_details';
		$this->db->where('dealer_id', $this->dealer_id);
		$estimate_no = $this->job_card_model->find(null,'max(estimate_doc_no)');

		$estimate_no = ++$estimate_no->max;

		echo json_encode($estimate_no);
	}

	public function partial_save_estimate() {

		$this->db->trans_begin();

		$post = $this->input->post();
		$post['jobs'] = json_decode($post['jobs']);
		$post['parts'] = json_decode($post['parts']);


		if($post['details']['doc_no']) {
			$estimate_no = $post['details']['doc_no'];
		} else {
			$this->job_card_model->_table = 'ser_estimate_details';
			$this->db->where('dealer_id', $this->dealer_id);
			$estimate_no = $this->job_card_model->find(null,'max(estimate_doc_no) as maxlastid');
			$estimate_no = ++$estimate_no->maxlastid;
		}

		$data = array(
			'estimate_doc_no' 		=>	$estimate_no,
			'jobcard_group'			=>	$post['details']['jobcard_group'],
			'vehicle_register_no'	=>	$post['details']['vehicle_register_no'],
			'chassis_no'			=>	$post['details']['chassis_no'],
			'engine_no'				=>	$post['details']['engine_no'],
			'model_no'				=>	$post['details']['vehicle_id'],
			'variant'				=>	@$post['details']['variant_id'],
			'color'					=>	@$post['details']['color_id'],

			'ledger_id'				=>	@$post['party_details']['ledger_id'],
			'total_parts'			=>	$post['summary']['total_for_parts'],
			'total_jobs'			=>	$post['summary']['total_for_jobs'],
			'cash_percent'			=>	$post['summary']['cash_discount_percent'],
			'vat_percent'			=>	$post['summary']['vat_percent'],
			'net_total'				=>	$post['summary']['net_total'],

			'dealer_id'				=>	$this->dealer_id
		);

		$this->job_card_model->_table = "ser_estimate_details";
		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		if($post['details']['doc_no']) {
			// $estimate_doc_no = $post['details']['doc_no'];
			$get_estimate_id = $this->job_card_model->find(array('estimate_doc_no' => $estimate_no, 'dealer_id' => $this->dealer_id));

			if($get_estimate_id) {
				$data['id'] = $get_estimate_id->id;
				$success = $this->job_card_model->update($data['id'],$data);
				
				$estimate_id = $get_estimate_id->id;
			} else {
				
				echo "error, no estiamte to update";
				exit;
			}
		}
		else {
			$success = $estimate_id =$this->job_card_model->insert($data);
		}

		/*if(! empty($post['jobs']))
		{
			foreach ($post['jobs'] as $key => $value) {
				$data = array(
					'job_id'				=>	$value->job_id,
					'cost'					=>	$value->price,
					'discount_percentage'	=>	$value->discount,
					'final_amount'			=>	$value->total_amount,
					'status'				=>	$value->status,

					'estimate_id'			=>	$estimate_id,
				);
				$this->job_card_model->_table = "ser_job_cards";
				$success = $this->job_card_model->insert($data);
			}
		}*/

		if(! empty($post['parts']))
		{
			foreach ($post['parts'] as $key => $value) {
				$data = array(
					'part_id'		=>	$value->part_id,
					'price'			=>	$value->price,
					'quantity'		=>	@$value->quantity,
					'discount_percentage'		=>	@$value->discount,
					'final_amount'	=>	$value->total,

					'estimate_id'	=>	$estimate_id,
				);

				$this->job_card_model->_table = "ser_estimate_parts";
				if(isset($value->id)) {
					if($value->id) {
						$data['id'] = $value->id;
						$success = $this->job_card_model->update($data['id'],$data);
					}
				}
				else {
					$success = $this->job_card_model->insert($data);
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

	// save estimate
	public function save_estimate()
	{
		$data = $this->input->post();

		// echo '<pre>';
		// print_r($data);
		$jobs = json_decode($data['jobs']);
		$parts= json_decode($data['parts']);
		$where['vehicle_id'] = $data['vehicle_id'];
		$where['jobcard_group'] = $data['jobcard_group'];
		// print_r($parts);


		// exit;

		$fields = 'id';

		$db_jobs = $this->job_card_model->find_all($where,$fields);
		$job_ids = array();

		foreach($db_jobs as $key => $value){
			$job_ids[] = $value->id;
		}

		$job_data['vehicle_id'] = $where['vehicle_id'];

		foreach($jobs as $key =>$value){
			$job_data['job_id'] = $value->job_id;

			if(in_array($value->id, $job_ids)){
				$job_data['id'] = $value->id;
				$this->job_card_model->update($job_data['id'],$job_data);
			}else{
				$this->job_card_model->insert($job_data);
			}

		}

		$this->job_card_model->_table = 'ser_parts';
		$db_parts = $this->job_card_model->find_all($where,$fields);

		foreach($db_parts as $key => $value){
			$part_ids[] = $value->id;
		}
		// $part_data['vehicle_id'] = $where['vehicle_id'];

		foreach($parts as $key =>$value){
			print_r($value);
			$part_data['part_id'] = $value->part_id;
			$part_data['price'] = $value->price;
			$part_data['discount_percentage'] = $value->discount_percentage;
			$part_data['labour'] = $value->labour;
			$part_data['cash_discount'] = $data['total_discount'];
			$part_data['quantity'] = $value->quantity;

			if(in_array($value->id, $part_ids)){
				// echo 'here';
				$part_data['id'] = $value->id;
				$this->job_card_model->update($part_data['id'],$part_data);
				// print_r($this->db->last_query());
			}else{
				// echo 'there';
				$this->job_card_model->insert($part_data);
			}

		}
		// print_r($job_ids);
		// print_r($part_ids);
		// print_r($jobs);
	}

	public function save_assign_jobcard() 
	{
		$this->job_card_model->_table = 'ser_job_cards';
		$post = $this->input->post();

		$jobcard_ids = $this->job_card_model->findAll(array('jobcard_group'=>$post['jobcard_group']),'id');

		$data = array();
		foreach ($jobcard_ids as $value) {
			$data[] = array(
				'id'                    =>  $value->id,
				'floor_supervisor_id'   =>  $post['combo_floor_supervisor'],
				'mechanics_id'          =>  $post['combo_mechanics'],
				'cleaner_id'            =>  $post['combo_cleaner'],
				// 'jobcard_group'         =>  $post['jobcard_group'],
			);
		}
		foreach($data as &$value)
		{
			$value = array_filter($value);
		}
		unset($value);
		$success = $this->job_card_model->update_batch($data,'id');

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

	public function save_outside_work() {
		$this->job_card_model->_table = 'ser_outside_work';

		$post = array_filter($this->input->post());

	// print_r($post);
	// exit;

		if( $this->input->post('id')) {
			$success = $this->job_card_model->update($post['id'], $post);
		}
		else {
			$success = $this->job_card_model->insert($post);
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

	public function delete_outsidework() {
		$this->job_card_model->_table = 'ser_outside_work';

		$id = $this->input->post("id");

		$success = $this->job_card_model->delete($id);

		echo json_encode(array('success'=>$success));
	}

	public function outside_work_json() {
		$this->job_card_model->_table = 'ser_outside_work';
		$where = NULL;
		// $where['jobcard_group'] = $this->input->get('jobcard_group');
		// $where['vehicle_id'] = $this->input->get('vehicle_id');

		$total = $this->job_card_model->find_count($where);

		$rows = $this->job_card_model->find_all($where);

		echo json_encode(array('total' => $total, 'rows' => $rows));    
	}

	public function combobox_outsidework_json() {
		$this->job_card_model->_table = 'view_service_job_card';

		$post = $this->input->get();

		$where = array('jobcard_group' => $post['jobcard_group']);
		$fields = 'id,job,job_description';
		$this->db->group_by($fields);
		$rows = $this->job_card_model->findAll($where,$fields);

		echo json_encode($rows);
	}

/*	public function combobox_workshop_json() {
		$this->job_card_model->_table = 'view_sparepart_dealers';

		$rows = $this->job_card_model->findAll();

		echo json_encode($rows);
	}*/

	public function job_status(){

		/* Inserting the information into a table */

		$data = $this->input->post('data');
		$data['status'] = $this->input->post('status');

		if($data['status'] == JOB_REOPEN){
			$this->job_card_model->_table = "ser_billing_record";
			$bill_count = count ($this->job_card_model->findAll(array('jobcard_group'=>$data['jobcard_group'])));
			if($bill_count > 0){
				echo json_encode(array('success' => false, 'msg' => 'Cannot Re-open job with Bill Issued'));
				exit;
			}
		}



		$this->job_card_model->_table = 'view_service_job_card';
		$check_job_status = $this->job_card_model->find_count(array('jobcard_group'=>$data['jobcard_group'], 'status' => "Pending"));

		$this->job_card_model->_table = 'ser_floor_supervisor_advice';
		$check_part_status = $this->job_card_model->find_count(array('jobcard_group'=>$data['jobcard_group'],'received_status'=> 0));

		if($check_part_status > 0 || $check_job_status > 0)
		{
			echo json_encode(array('success' => false, 'msg' => 'All Parts Not Received or Job not completed.'));
			exit;
		}
		else
		{

			$this->job_card_model->_table = 'ser_jobcard_status';
			$this->job_card_model->insert($data);

			/*Now updating in the Job cards*/
			$this->job_card_model->_table = 'ser_job_cards';
			$job_cards = $this->job_card_model->findAll(array('jobcard_group' => $data['jobcard_group']), 'id, closed_status');

			foreach ($job_cards as $key => $value) {
				$value->closed_status = $data['status'];
				$value->closed_date = date('Y-m-d');
				$success = $this->job_card_model->update($value->id,$value);
			}




			$this->job_card_model->_table = "view_report_grouped_jobcard";
			$jobcard_info = $this->job_card_model->find(array('jobcard_group'=>$data['jobcard_group']));
			$this->ccd_smr_twentyone_day_model->_table = 'view_ccd_smr_twentyone_days';
			$this->db->where('schedule_date >=',date('Y-m-d'));
			$twentyone = $this->ccd_smr_twentyone_day_model->find(array('engine_no' => $jobcard_info->engine_no, 'chass_no' => $jobcard_info->chassis_no));
	
		
			
			$this->db->where('schedule_date >=',date('Y-m-d'));
			$this->ccd_2nd_smr_day_model->_table = 'view_cc_2nd_smr';
			$second = $this->ccd_2nd_smr_day_model->find(array('engine_no' => $jobcard_info->engine_no, 'chass_no' => $jobcard_info->chassis_no));

			$this->db->select('dms_customers.id as id,msil_dispatch_records.engine_no as engine_no,msil_dispatch_records.chass_no as chass_no');
			$this->db->from('dms_customers');
			$this->db->where('engine_no', $jobcard_info->engine_no);
			$this->db->where('chass_no', $jobcard_info->chassis_no);
			$this->db->join('sales_vehicle_process', 'sales_vehicle_process.customer_id = dms_customers.id');
			$this->db->join('msil_dispatch_records', 'sales_vehicle_process.msil_dispatch_id = msil_dispatch_records.id');
			$customer = $this->db->get()->row();

			
				
			
			if($twentyone || $second){}else{
				$ccd['jobcard_group'] = $data['jobcard_group'];
				$ccd['closed_date'] = date('Y-m-d');
				$ccd['vehicle_no'] = $jobcard_info->vehicle_no;
				$ccd['vehicle_id'] = $jobcard_info->vehicle_id;
				$ccd['variant_id'] = $jobcard_info->variant_id;
				$ccd['color_id'] = $jobcard_info->color_id;
				$ccd['chassis_no'] = $jobcard_info->chassis_no;
				$ccd['engine_no'] = $jobcard_info->engine_no;
				$ccd['customer_id'] = @$customer->id;

				$ccd['schedule_date'] =  date('Y-m-d',strtotime(date('Y-m-d')."+113 days"));
				
				$this->ccd_general_smr_model->insert($ccd);
				
				$success = true;
			}
		}

		if(isset($data['send_sms'])) {
			$sms_status = $this->save_sms($data['jobcard_group'], SMS_JOB_CLOSE);

			if($sms_status) {
				$sms_status_msg = "Error: Message not sent.";
			}
		}


		echo json_encode(array('success' => $success));
		exit;
	}

	public function get_ledger_combo_json() {
		$this->job_card_model->_table = 'view_user_ledger';


		$fields = 'id, full_name, party_name';
		$this->db->order_by('full_name asc');
		// $this->db->group_by($fields);
		$rows=$this->job_card_model->findAll(null, $fields);

		echo json_encode($rows);
	}

	// public function save_outside_work_all() {
	// 	$this->job_card_model->_table = 'ser_outside_work';

	// 	$post = array_filter($this->input->post());

	// 	$data = array(
	// 		'send_date'			=> $post['data']['send_date'],
	// 		'workshop_id'		=> $post['data']['workshop_id'],
	// 		'splr_invoice_no'	=> $post['data']['splr_invoice_no'],
	// 		'splr_invoice_date'	=> $post['data']['splr_invoice_date'],
	// 		'remarks'			=> $post['data']['remarks'],
	// 		'gross_total'		=> $post['data']['gross_total'],
	// 		'round_off'			=> $post['data']['round_off'],
	// 		'net_amount'		=> $post['data']['net_amount'],
	// 	);

	// 	$post = $post['outsideRecords'];

	// 	foreach ($data as $key => $value) {
	// 		foreach ($post as $k => $v) {
	// 			$post[$k][$key] = $value;
	// 			// unset($post[$k]['id']);
	// 			unset($post[$k]['uid']);
	// 			unset($post[$k]['description']);
	// 			unset($post[$k]['mechanic_name']);

	// 			$post[$k] = array_filter($post[$k], function($value) {
	// 				return ($value !== null && $value !== false && $value !== ''); 
	// 			});
	// 		}
	// 	}

	// 	foreach ($post as $key => $value) {
	// 		if( isset($value['id'])) {
	// 			if($value['id'] != 0 ){
	// 				$success = $this->job_card_model->update($value['id'], $value);
					
	// 			}
	// 			else {
	// 				unset($value['id']);
	// 				$success = $this->job_card_model->insert($value);
	// 			}
	// 		} else {
	// 			$success = $this->job_card_model->insert($value);
	// 		}
	// 	}

	// 	// $success = $this->job_card_model->insert_many($post);

	// 	if($success)
	// 	{
	// 		$success = TRUE;
	// 		$msg=lang('general_success');
	// 	}
	// 	else
	// 	{
	// 		$success = FALSE;
	// 		$msg=lang('general_failure');
	// 	}

	// 	echo json_encode(array('msg'=>$msg,'success'=>$success));
	// 	exit;
	// }

	// public function save_outside_work_all() {
	// 	$this->job_card_model->_table = 'ser_outside_work';

	// 	$post = array_filter($this->input->post());

	// 	$data = array(
	// 		// 'send_date'			=> $post['data']['send_date'],
	// 		// 'workshop_id'		=> $post['data']['workshop_id'],
	// 		// 'splr_invoice_no'	=> $post['data']['splr_invoice_no'],
	// 		// 'splr_invoice_date'	=> $post['data']['splr_invoice_date'],
	// 		'remarks'			=> $post['data']['remarks'],
	// 		'gross_total'		=> (int)round($post['data']['gross_total']),
	// 		'round_off'			=> $post['data']['round_off'],
	// 		'net_amount'		=> (int)round($post['data']['net_amount']),
	// 	);


	// 	$post = $post['outsideRecords'];
	// 	foreach ($data as $key => $value) {
	// 		foreach ($post as $k => $v) {
	// 			$post[$k][$key] = $value;
	// 			// unset($post[$k]['id']);
	// 			unset($post[$k]['uid']);
	// 			unset($post[$k]['description']);
	// 			unset($post[$k]['mechanic_name']);

	// 			$post[$k] = array_filter($post[$k], function($value) {
	// 				return ($value !== null && $value !== false && $value !== ''); 
	// 			});
	// 		}
	// 	}
	// 	// echo '<pre>'; print_r($post); exit;

	// 	// echo '<pre>'; print_r($post); exit;

	// 	$this->db->where('jobcard_group',$post[0]['jobcard_group']);
	// 	$this->db->delete('ser_outside_work');

	// 	foreach ($post as $key => $value) {
	// 		if( isset($value['id'])) {
	// 			unset($value['id']);
				
	// 			// // if($value['id'] != 0 ){
	// 			// 	$success = $this->job_card_model->update($value['id'], $value);
					
	// 			// }
	// 			// else {
	// 			// 	$success = $this->job_card_model->insert($value);
	// 			}
	// 			unset($value['total']);
	// 		// if()	

	// 		// } else {
	// 		$success = $this->job_card_model->insert($value);
	// 		// }
	// 	}

	// 	// $success = $this->job_card_model->insert_many($post);

	// 	if($success)
	// 	{
	// 		$success = TRUE;
	// 		$msg=lang('general_success');
	// 	}
	// 	else
	// 	{
	// 		$success = FALSE;
	// 		$msg=lang('general_failure');
	// 	}

	// 	echo json_encode(array('msg'=>$msg,'success'=>$success));
	// 	exit;
	// }
	public function save_outside_work_all() {
		$this->job_card_model->_table = 'ser_outside_work';
		$job_group = $this->input->post('data')['job_group'];
		$post = array_filter($this->input->post());
		$data = array(
			// 'send_date'			=> $post['data']['send_date'],
			// 'workshop_id'		=> $post['data']['workshop_id'],
			// 'splr_invoice_no'	=> $post['data']['splr_invoice_no'],
			// 'splr_invoice_date'	=> $post['data']['splr_invoice_date'],
			'remarks'			=> $post['data']['remarks'],
			'gross_total'		=> (int)round($post['data']['gross_total']),
			'round_off'			=> $post['data']['round_off'],
			'net_amount'		=> (int)round($post['data']['net_amount']),
		);


		$post = @$post['outsideRecords'];
		if(empty($post)){
			$this->db->where('jobcard_group',$job_group);
			$this->db->delete('ser_outside_work');
			$success = true;
		}else{
			foreach ($data as $key => $value) {
				foreach ($post as $k => $v) {
					$post[$k][$key] = $value;
					// unset($post[$k]['id']);
					unset($post[$k]['uid']);
					unset($post[$k]['description']);
					unset($post[$k]['mechanic_name']);

					$post[$k] = array_filter($post[$k], function($value) {
						return ($value !== null && $value !== false && $value !== ''); 
					});
				}
			}
			
			// if(!empty($post)){
			$this->db->where('jobcard_group',$job_group);
			$this->db->delete('ser_outside_work');
			// }
			// echo '<pre>'; print_r($post); exit;

			foreach ($post as $key => $value) {
				if( isset($value['id'])) {
					unset($value['id']);
					
					// // if($value['id'] != 0 ){
					// 	$success = $this->job_card_model->update($value['id'], $value);
						
					// }
					// else {
					// 	$success = $this->job_card_model->insert($value);
					}
					unset($value['total']);
				// if()	

				// } else {
				$success = $this->job_card_model->insert($value);
				// }
			}
		}


		// $success = $this->job_card_model->insert_many($post);

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
	public function get_grouped_outsideWorks() {
		$this->job_card_model->_table = 'ser_outside_work';
		$jobcard_group = $this->input->post('jobcard_group');

		$fields = 'jobcard_group, remarks, gross_total, net_amount, round_off'; 

		$this->db->group_by($fields);
		$rows = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group), $fields);

		echo json_encode(array('rows'=>$rows));
	}
	public function get_grid_outsideWorks() {
		$this->job_card_model->_table = 'view_outside_works';
		
		$jobcard_group = $this->input->get('jobcard_group');

		paging('id');
		search_params();

		$rows = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group));
		$total = count($rows);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function get_jobCard_details() {
		$jobcard_group = $this->input->post('jobcard_group');
		$vehicle_no = $this->input->post('vehicle_no');

		$this->job_card_model->_table = "view_service_job_card";
		$data['jobs'] = $this->job_card_model->findAll(array('jobcard_group'=> $jobcard_group));

		if($data['jobs']){
			if( in_array($data['jobs'][0]->service_type, array(3,4,5))) {
				// echo "Free or";
			}
			// print_r($data['jobs']);
		}

		$data['number_of_service'] = $this->get_service_number($vehicle_no);
		echo json_encode($data);
	}	

	/*public function get_jobCard_job_details() {
		$jobcard_group = $this->input->post('jobcard_group');

		$rows = $this->job_card_model->find(array('jobcard_group'=> $jobcard_group));

		echo json_encode(array('rows'=>$rows));
	}*/

	public function get_jobCard_groups() {
		$fields  = 'jobcard_group';

		$this->db->group_by($fields);
		$this->db->order_by("{$fields} desc");
		$rows = $this->job_card_model->findAll(null,$fields);

		echo json_encode($rows);
	}
	
	public function get_material_issue() {
		$jobcard_group = $this->input->post('jobcard_group');

		// $this->job_card_model->_table = 'ser_floor_supervisor_advice';
		// $rows['advised_parts'] = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group, 'dealer_id' => $this->dealer_id));

		$this->job_card_model->_table = 'view_report_grouped_jobcard';
		$rows['jobs'] = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id' => $this->dealer_id));

		// $this->job_card_model->_table = 'view_material_scan';
		// $rows['scanned'] = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group,));

		$this->job_card_model->_table = 'view_material_scan';
		$this->db->group_by($fields = 'material_issue_no');
		$rows['material_issue_no'] = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id'=>$this->dealer_id), $fields);
		$rows['material_issue_no'] = ( $rows['material_issue_no']) ? $rows['material_issue_no']->material_issue_no: '';

		echo json_encode($rows);
	}

	public function material_issue_save() {
		$this->load->model('dealer_stocks/dealer_stock_model');


		$this->job_card_model->_table = "ser_parts";
		$post = array_filter($this->input->post());

		if($post['materialData'] != '[]'){
			$materialData = json_decode($post['materialData'], true);
		} else {

			echo json_encode(array('msg'=>lang('general_failure'), 'success'=> false));
			return;
			exit;
		}

		foreach ($materialData as $key => $value) {
			foreach ($post['data'] as $k => $v) {
				$materialData[$key][$k] = $v;
			}
			unset($materialData[$key]['mechanic_id']);
			unset($materialData[$key]['uid']);
			unset($materialData[$key]['part_name']);
			unset($materialData[$key]['part_code']);
			unset($materialData[$key]['total']);
		}

		foreach ($materialData as $key => $value) {

			$dealer_stock = $this->dealer_stock_model->find(array('sparepart_id' => $value['part_id'], 'dealer_id' => $this->dealer_id));
			$new_quantity = $dealer_stock->quantity - $value['quantity'];

			if(  $new_quantity >= 0 ) {
				$dealerdata  = array(
					'id'	=>	$dealer_stock->id,
					'quantity'	=>	$new_quantity,

				);
				$this->dealer_stock_model->update($dealerdata['id'], $dealerdata);
			}
			else {

				echo json_encode(array('msg'=>'Stock not available. ','success'=>FALSE));
				return;
				exit;

			}
		}

		foreach ($materialData as $key => $value) {

			if( isset($value['id'])) {
				$success = $this->job_card_model->update($value['id'], $value);
			}
			else {
				$success = $this->job_card_model->insert($value);
			}


		}
		// $success = $this->job_card_model->insert_many($post);

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

	}



	public function get_job_status() {
		$jobcard_group = $this->input->post('jobcard_group');

		$this->job_card_model->_table = "view_service_job_card";
		$details = $this->job_card_model->find(array('jobcard_group' => $jobcard_group));


		$this->job_card_model->_table = "view_service_job_statuses";
		$status = $this->job_card_model->find(array('jobcard_group' => $jobcard_group));

		echo json_encode(array('success'=>true, 'details'=>$details, 'status'=>$status));

	}

	public function get_estimate_details() {
		$docno = $this->input->post('docno');
		//this is actually jobcard serial now
		$jobcard_serial = $this->input->post('jobcard_group'); 


		if($jobcard_serial){
			$this->job_card_model->_table = 'view_service_job_card';
			$this->db->where('dealer_id', $this->dealer_id);
			$rows['details'] = $this->job_card_model->find(array('jobcard_serial'=>$jobcard_serial));

			$jobcard_group = $rows['details']->jobcard_group;
		}

		if($docno) {
			$this->job_card_model->_table = 'view_service_estimate_records';
			$this->db->where('dealer_id', $this->dealer_id);
			$rows['details'] = $this->job_card_model->find(array('estimate_doc_no'=>$docno));
		}

		if($rows['details']) {
			//Always get from estimate parts.

			// if( $rows['details']->jobcard_group ){
				// $this->job_card_model->_table = "view_service_parts";
				// $rows['parts'] = $this->job_card_model->findAll(array('jobcard_group' => $jobcard_group));
			// } else {
			$this->job_card_model->_table = "view_service_estimate_parts";
			$rows['parts'] = $this->job_card_model->findAll(array('estimate_id' => $rows['details']->id));
			// }
		}

		echo json_encode($rows);

	}

	public function print_preview() {
		$get = $this->input->get();

		$data['workshop'] = $this->get_workshop_name();



		switch ($get['type']) {
			case 'JobCard':

			if( ! $get['jobcard'] ) {
				echo "No jobcard found.";
				exit;
			}
			
			$print = "prints/jobcard_print";
			$this->job_card_model->_table = "view_service_job_card";
			$data['jobcard'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));
			// $this->job_card_model->_table = "view_user_ledger";
			// $data['customer'] = $this->job_card_model->find(array('jobcard_group' => $get['jobcard']));
			if(! $data['jobcard']) {
				echo "Data not saved to print.";
				exit;
			}

			if($data['jobcard'][0]->accessories) {
				$accessories = explode(',', $data['jobcard'][0]->accessories);
			}

			if(isset($accessories)) {
				$this->job_card_model->_table = "mst_accessories";
				$data['accessories'] = $this->job_card_model->get_many($accessories);
			}

			$data['customer'] = $data['jobcard'][0];

			$data['header'] = $get['type'];
			$data['module'] = 'dispatch_dealers';
			break;

			case 'Material Issue':
			$print = "prints/material_issue_print";


			if(isset($get['jobcard'])) {
				$this->job_card_model->_table = "view_material_scan";
				$this->db->order_by('is_consumable desc');
				$data['parts'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));
				$data['customer'] = @$data['parts'][0];

				if(! $data['customer']) {
					echo "Data not saved to print.";
					exit;
				}

				$data['header'] = $get['type'];
				$data['module'] = 'dispatch_dealers';
			}
			break;

			case 'Estimate':
			$print = "prints/estimate_print";
			$data['data'] = 0;
			if(($get['jobcard'])) {
				$this->job_card_model->_table = "view_service_estimate_records";
				$data['estimate'] = $this->job_card_model->find(array('estimate_doc_no' => $get['jobcard'],'dealer_id' => $this->dealer_id,'id' => $get['real_id']));
				// var_dump(($data['estimate']));
				// echo '<pre>'; print_r($data); exit;
				// var_dump(count($data['estimate']) > 0);exit;
				if(($data['estimate'])){
					$data['data'] = 1;
					$this->job_card_model->_table = "view_service_estimate_parts";
					$data['parts'] = $this->job_card_model->findAll(array('estimate_id' => $data['estimate']->id));
					$this->job_card_model->_table = "view_service_estimate_jobs";
					$data['jobs'] = $this->job_card_model->findAll(array('estimate_id' => $data['estimate']->id));
				}else{
					$data['data'] = 0;
				}
			}
			$data['header'] = $get['type'];
			$data['module'] = 'dispatch_dealers';
			// echo "<pre>";
			// print_r($data);exit;

			break;

			case 'Outside Work':
			$print = "prints/outsidework_print";
			if(isset($get['jobcard'])) {
				$this->job_card_model->_table = "view_outside_works";
				$data['works'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));

				if($data['works']) {
					$data['outside_work'] = $data['works'][0];

					$data['header'] = $get['type'];
					$data['module'] = 'dispatch_dealers';
				} else {
					echo "No Data to Print.";
					exit;
				}
				echo "<pre> <!--";
				print_r($data);
				echo "-->";
			}
			break;

			default:
			break;

			case 'Invoice':
			$print = "prints/invoice_print";
			if(isset($get['jobcard'])) {

				$this->job_card_model->_table = "view_service_billing_record";
				$data['jobcard'] = $this->job_card_model->find(array('jobcard_group'=>$get['jobcard']));

				if(! $this->dealer_id) {
					echo "Error 403";
					exit;
				}

				if( ! $data['jobcard']) {
					echo "Bill Not saved.";
					exit;
				}

				$this->job_card_model->_table = 'view_service_billing_jobs';
				$where = array();
				$where['jobcard_group'] = $get['jobcard'];
				$rows = $this->job_card_model->find_all($where);

				$total = count($rows);

				foreach ($rows as $key => $value) {
					$rows[$key]->has_billed = 1;
					$rows[$key]->cost = $rows[$key]->price;
				}

				$this->job_card_model->_table = 'view_service_billing_outsideworks';
				$ow_rows = $this->job_card_model->findAll($where);
				// print_r($total);
				// echo '<pre>';
				// print_r($rows);
				// print_r($ow_rows);

				foreach ($ow_rows as $key => $value) {
					$k = $total+$key;

					$rows[$k] = $value;

					$rows[$k]->id = $value->id;
					$rows[$k]->job_id = $value->job_id;
					$rows[$k]->job = $value->job;
					$rows[$k]->job_description = $value->job_description;
					$rows[$k]->cost = $value->price;
					$rows[$k]->discount_amount = $value->discount_amount;
					$rows[$k]->discount_percentage = $value->discount_percentage;
					$rows[$k]->final_amount = $value->final_amount;
					$rows[$k]->ow = true;
					$rows[$k]->has_billed = 1;
				}

				$data['jobs'] = $rows;
				

				$this->job_card_model->_table = 'view_service_billing_parts';
				$data['parts'] = $this->job_card_model->find_all($where);


				/* Gatepass */
				$this->job_card_model->_table = 'view_gatepass';
				$where = array(
					'jobcard_id' => $data['jobcard']->jobcard_group,
					'dealer_id'	=>	$this->dealer_id,
				);
				$gatepass = $this->job_card_model->find($where);

				if($gatepass){
					$data['gatepass']['id'] = $gatepass->id;
					$data['gatepass']['gatepass_no'] = $gatepass->gatepass_no;
				} else{

					$this->db->order_by('gatepass_no desc');
					$this->db->where('dealer_id', $this->dealer_id);
					$gatepass_no = $this->job_card_model->find();
					$gatepass_no = ($gatepass_no)?++$gatepass_no->gatepass_no:1;

					$save_data = array(
						'jobcard_id'		=>	$data['jobcard']->jobcard_group,
						'date'				=>	date('Y-m-d'),
						'dealer_id'			=>	$this->dealer_id,
						'gatepass_no'		=>	$gatepass_no,
					);
					$this->job_card_model->_table = 'ser_gatepass';
					$id = $this->job_card_model->insert($save_data);

					$data['gatepass']['id'] = $id;
					$data['gatepass']['gatepass_no'] = $gatepass_no;
				}

				/* Gatepass */

				$data['header'] = $get['type'].'<br><p style="font-size: 14px !important;">'.$data['jobcard']->payment_type.'<p>';
				$data['module'] = 'dispatch_dealers';
			}
			break;

			/*for gatepass*/
			case 'Gatepass':
			$data['header'] = $get['type'];
			$data['module'] = 'dispatch_dealers';

			$print = "prints/gatepass_print";
			$this->job_card_model->_table = "view_service_job_card";
			$data['jobs'] = $this->job_card_model->findAll( array('jobcard_group' =>  $get['jobcard']) );
			$data['jobcard'] = $data['jobs'][0];

			$this->job_card_model->_table = 'view_gatepass';
			$where = array(
				'jobcard_id' => $data['jobcard']->jobcard_group,
				'dealer_id'	=>	$this->dealer_id,
			);
			$gatepass = $this->job_card_model->get_by($where);
			
			if(count($gatepass)>0){
				$data['gatepass']['id'] = $gatepass->id;
				$data['gatepass']['gatepass_no'] = $gatepass->gatepass_no;
				$data['gatepass']['date'] = $gatepass->date;
				$data['gatepass']['invoice_no'] = $gatepass->invoice_no;
			}
			else{
				//get new gatepass no
				$this->db->order_by('gatepass_no desc');
				$this->db->where('dealer_id', $this->dealer_id);
				$gatepass_no = $this->job_card_model->find(array());
				$gatepass_no = ($gatepass_no)?++$gatepass_no->gatepass_no:1;

				$save_data = array(
					'jobcard_id'		=>	$data['jobcard']->jobcard_group,
					'date'				=>	date('Y-m-d'),
					'dealer_id'			=>	$this->dealer_id,
					'gatepass_no'		=>	$gatepass_no,
				);
				$this->job_card_model->_table = 'ser_gatepass';
				$id = $this->job_card_model->insert($save_data);

				$data['gatepass']['id'] = $id;
				$data['gatepass']['gatepass_no'] = $gatepass_no;
				$data['gatepass']['date'] = $save_data['date'];
			}
			// print_r($data);
			break;

			default:
			return "Error";
			exit;
			break;
		}	
		// echo $print;
		// echo '<pre>'; print_r($data); exit;
		$this->load->view($this->config->item('template_admin') . $print , $data);

	}

	function get_jobcard_serial() {
		$this->db->order_by('jobcard_group','desc');
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->jobcard_group:1;

		$this->db->order_by('jobcard_serial','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$serial = $this->job_card_model->find();
		$serial = $serial?++$serial->jobcard_serial: 1;

		echo json_encode(array('id'=>$id, 'serial' => $serial));
	}

	/*function get_billing_number() {
		$this->db->order_by('id','desc');
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->id:1;
		return $id;
		echo json_encode($id);
	}*/

	// function get_vehicles_json() {

	// 	// $this->job_card_model->_table = "view_dms_vehicles";
	// 	// $fields = 'deleted_at, vehicle_id, vehicle_name';

	// 	// $this->db->group_by($fields);
	// 	// $rows = $this->job_card_model->findAll(null, $fields);

	// 	// echo json_encode($rows);

	// 	$this->job_card_model->_table = "view_dms_vehicles_service";
	// 	$fields = 'deleted_at, vehicle_id, vehicle_name';

	// 	$this->db->group_by($fields);
	// 	$this->db->select($fields);
	// 	$rows =$this->db->get('view_dms_vehicles_service')->result();
	// 	// // $rows = $this->job_card_model->findAll(null, $fields);

	// 	echo json_encode($rows);
	// }

	public function get_vehicles_json() {

		$this->job_card_model->_table = "view_dms_vehicles_service";
		$fields = 'deleted_at, vehicle_id, vehicle_name';

		$this->db->group_by($fields);
		$this->db->select($fields);
		$rows = $this->db->get('view_dms_vehicles_service')->result();
		// $rows = $this->job_card_model->findAll(null, $fields);

		echo json_encode($rows);
	}

	public function get_variants_combo_json_service() 
	{
		$vehicle_id = $this->input->get('vehicle_id');

		// $this->load->model('vehicles/vehicle_model');
// 
		// $this->vehicle_model->_table = 'view_dms_vehicles';

		$this->db->where('vehicle_id', $vehicle_id);

		$this->db->group_by('1,2,3');
		$this->db->select('vehicle_id,variant_id,variant_name');
		$rows = $this->db->get('view_dms_vehicles_service')->result();
		
		// $rows=$this->vehicle_model->findAll(null, array('vehicle_id','variant_id', 'variant_name'));

		array_unshift($rows, array('variant_id' => '0', 'variant_name' => 'Select Variant'));

		echo json_encode($rows);
	}

	public function get_colors_combo_json_service() 
	{
		$vehicle_id = $this->input->get('vehicle_id');
		$variant_id = $this->input->get('variant_id');

		// $this->load->model('vehicles/vehicle_model');

		// $this->vehicle_model->_table = 'view_dms_vehicles';

		$this->db->where('vehicle_id', $vehicle_id);
		$this->db->where('variant_id', $variant_id);

		// $rows=$this->vehicle_model->findAll(null, array('color_id','color_id'));
		$this->db->select('color_id,color_name');
		$rows = $this->db->get('view_dms_vehicles_service')->result();
		
		array_unshift($rows, array('color_id' => '0', 'color_name' => 'Select Color'));

		echo json_encode($rows);
	}
	function save_party_entry() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('name', 'Full Name', 'required');
		$this->form_validation->set_rules('address1', 'Address', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('success' =>false));
			exit;
		}

		$data = array(
			'title'             =>  $this->input->post('title'),
			'short_name'        =>  $this->input->post('short_name'),
			'full_name'         =>  $this->input->post('name'),
			'address1'          =>  $this->input->post('address1'),
			'address2'          =>  $this->input->post('address2'),
			'address3'          =>  $this->input->post('address3'),
			'city'              =>  $this->input->post('city'),
			'area'              =>  $this->input->post('area'),
			'district_id'       =>  $this->input->post('district'),
			'zone_id'           =>  $this->input->post('zone'),
			'pin_code'          =>  $this->input->post('pin_code'),
			'std_code'          =>  $this->input->post('std_code'),
			'mobile'            =>  $this->input->post('mobile'),
			'phone_no'          =>  $this->input->post('phone'),
			'email'             =>  $this->input->post('email'),
			'dob'				=> 	$this->input->post('dob'),

		);

		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== 0 && $value !== '');
		});

		$this->job_card_model->_table = 'mst_user_ledger';
		$success = $this->job_card_model->insert($data);

		echo json_encode(array('success' =>$success, 'value' => $data));
	}

	public function import_history()
	{
		ini_set('memory_limit', '-1');
	    $config['upload_path'] = './uploads/spareparts_stock_import';
	    $config['allowed_types'] = 'xlsx|csv|xls';
	    $config['max_size'] = 1000000000;

	    $this->load->library('upload', $config);

	    if (!$this->upload->do_upload('userfile')) {
	        $error = array('error' => $this->upload->display_errors());
	        print_r($error);
	    } else {
	        $data = array('upload_data' => $this->upload->data());
	    }
	    $file = FCPATH . 'uploads/spareparts_stock_import/' . $data['upload_data']['file_name']; 
	    $this->load->library('Excel');
	    $objPHPExcel = PHPExcel_IOFactory::load($file);
	    $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
	    $objReader->setReadDataOnly(false);

	    $index = array('chassis_no','engine_no','color','model','variant');
	    $raw_data = array();
	    $view_data = array();
	    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
	        if ($key == 0) {
	            $worksheetTitle = $worksheet->getTitle();
	            $highestRow = $worksheet->getHighestRow();
	            $highestColumn = "E"; //limited to 4th column
	            // $highestColumn = $worksheet->getHighestColumn();
	            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	            $nrColumns = ord($highestColumn) - 64;

	            for ($row = 2; $row <= $highestRow; ++$row) {
	                for ($col = 0; $col < $highestColumnIndex; ++$col) {
	                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
	                    $val = $cell->getValue();
	                    $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
	                    $raw_data[$row][$index[$col]] = $val;
	                }
	            }
	        }
	    }
	    
	    $unavailable_qty = array();
	    $imported_data = array();
	    foreach ($raw_data as $key => $value) {
	        $color = $this->db->where('name',$value['color'])->get('mst_colors')->row_array();
	        $model = $this->db->where('name',$value['model'])->get('mst_vehicles')->row_array();
	        $variant = $this->db->where('name',$value['variant'])->get('mst_variants')->row_array();

	        $imported_data[$key]['chassis_no'] = $value['chassis_no'];
	        $imported_data[$key]['engine_no'] = $value['engine_no'];
	        $imported_data[$key]['model'] = $value['model'];
	        $imported_data[$key]['vehicle_id'] = $model['id'];
	        $imported_data[$key]['variant_id'] = $variant['id'];
	        $imported_data[$key]['color_id'] = $color['id'];
	        
	    }
	    
	 	$this->db->trans_start();
	 	$this->db->insert_batch('temp_verhicle_service_history', $imported_data); 
	// 
	    if ($this->db->trans_status() === FALSE) 
	    {
	        $this->db->trans_rollback();
	    } 
	    else 
	    {
	        $this->db->trans_commit();            
	    } 
	    $this->db->trans_complete();
	    redirect($_SERVER['HTTP_REFERER']);
	}

	// kms for jobcard
	public function get_kms()
	{
		$value = strtoupper($this->input->post('data'));
		$data['kms'] = 0;
		if($value){

			// $where["(chassis_no  = '{$value}')"] = NULL;
			$where["(chassis_no  = '{$value}') OR (vehicle_no  = '{$value}') OR (engine_no  = '{$value}')"] = NULL;

			// $this->db->where("upper(chassis_no)", $value);
			$this->job_card_model->_table = "view_service_job_card";
			$this->db->order_by('id desc');
			$data = $this->job_card_model->find($where);
			if( ! $data )
			{
				$this->job_card_model->_table = "view_service_msil_records";
				$this->db->where("chassis_no", $value);
				// $this->db->or_where("vehicle_no",$value);
				$this->db->or_where("engine_no",$value);
				$data = $this->job_card_model->find();

				if(! $data){
					$this->db->where("chassis_no", $value);
					$this->db->or_where("vehicle_no",$value);
					$this->db->or_where("engine_no",$value);
					$data = $this->db->get('temp_verhicle_service_history')->row();
				}
			}
			if( ! $data){
				$this->job_card_model->_table = "view_msil_dispatch_records";
				$this->db->select('*,chass_no AS chassis_no');
				$this->db->where('chass_no',$value);
				$this->db->or_where("vehicle_register_no",$value);
				$this->db->or_where("engine_no",$value);
				$data = $this->job_card_model->find();
			}

		}
		echo json_encode($data);
	}

	public function get_coupon_detail()
	{
		$coupon = $this->input->post('coupon');
		$chassis_no = $this->input->post('chassis_no');

		$this->job_card_model->_table = 'view_foc_details';
		$where['free_servicing'] = $coupon;
		$where["trim(chass_no) = trim('{$chassis_no}')"] = null;

		$value = $this->job_card_model->get_by($where);
		if($value){
			$data['success'] = true;
		}else{
			$data['success'] = false;
		}
		echo json_encode($data);
	}

	public function get_company()
	{
		// $where['id'] = $this->input->post('vehicle_id');
		// $this->job_card_model->_table = 'view_mst_vehicles';
		// $data = $this->job_card_model->get_by($where);
		// if(count($data) > 0){
		// 	$result['company'] = $data->firm_name;
		// }else{
		// 	$result['company'] = '';
		// }
		$where['chass_no'] = $this->input->post('chassis_no');
		$this->job_card_model->_table = 'view_msil_dispatch_records';
		$data = $this->job_card_model->get_by($where);
		if(count($data) > 0){
			if($data->firm_name){
				$result['company'] = $data->firm_name;
			}else{
				$where = array('id'=>$this->input->post('vehicle_id'));
				$this->job_card_model->_table = 'view_mst_vehicles';
				$data = $this->job_card_model->get_by($where);
				if(count($data) > 0){
					$result['company'] = $data->firm_name;
				}else{
					$result['company'] = '';
				}
			}
		}else{
			$where = array('id'=>$this->input->post('vehicle_id'));
			$this->job_card_model->_table = 'view_mst_vehicles';
			$data = $this->job_card_model->get_by($where);
			if(count($data) > 0){
				$result['company'] = $data->firm_name;
			}else{
				$result['company'] = '';
			}
		}
		echo json_encode($result);
	}

	// public function set_barcode() {

	// 	if( ! $this->dealer_id) {
	// 		echo "403 Forbidden";
	// 		exit;
	// 	}

	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('jobcard_group', 'Jobcard_group', 'required');
	// 	$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');

	// 	if ($this->form_validation->run() == FALSE)
	// 	{
	// 		echo json_encode(array('success' =>false, 'msg'=> "Inputs fields missing."));
	// 		exit;
	// 	}

	// 	$jobcard_group = $this->input->post('jobcard_group');
	// 	$barcode = $this->input->post('barcode');
	// 	$advisedpart_id = $this->input->post('advisedpart_id');
	// 	// $old_barcode = $this->input->post('old');

	// 	$barcode = strtoupper($barcode);
	// 	// $old_barcode = strtoupper($old_barcode);
	// 	$returnData = array();
		
	// 	$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
	// 	// $dealer_stock = $this->job_card_model->find(array('upper(part_code)' => $barcode, 'dealer_id'=>$this->dealer_id),'MAX(quantity) as max_qty, *');
	// 	$dealer_stock_ALL = $this->job_card_model->find_all(array('upper(part_code)' => $barcode, 'dealer_id'=>$this->dealer_id));
	// 	$dealer_stock = array();
	// 	$max = 0;
	// 	// $max_found
	// 	foreach ($dealer_stock_ALL as $key => $value) {
	// 		if($value->quantity > $max){
	// 			$dealer_stock = $value;
	// 			$max = $value->quantity;
	// 			// break;
	// 		}
	// 	}

	// 	// $dealer_stock = max(array_column($dealer_stock_ALL, 'quantity'))
	// 	// echo '<pre>'; echo $this->db->last_query(); print_r($dealer_stock); exit; 
	// 	if($dealer_stock){
	// 		$stock['id'] = $dealer_stock->id;
	// 		$stock['quantity'] = $dealer_stock->quantity - 1;

	// 		if($dealer_stock->quantity > 0) {

	// 			//Material scan part
	// 			$this->job_card_model->_table = "view_material_scan";
	// 			$scannedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'part_code' => $barcode, 'dealer_id' => $this->dealer_id));

	// 			if($scannedParts) {
	// 				$data = array(
	// 					'id'			=>	$scannedParts->id,
	// 					'issue_date'	=>	date('Y-m-d'),
	// 					'quantity'		=>	$scannedParts->quantity + 1,
	// 					'material_issue_no'=>$scannedParts->material_issue_no,
	// 				);


	// 				$this->job_card_model->_table = "ser_material_scan";
	// 				$this->job_card_model->update($data['id'], $data);
	// 				$material_scan_id = $data['id'];
	// 				$data['updated'] = true;

	// 			} else {

	// 				// --- getting material-issue number --- //
	// 				$getMaterialId = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
	// 				if( ! $getMaterialId) {
	// 					$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
	// 				}
	// 				// end //

	// 				$data = array(
	// 					'dealer_id'	 				=> 	$this->dealer_id,
	// 					'jobcard_group'				=>	$jobcard_group,
	// 					'part_id'					=>	$dealer_stock->sparepart_id,
	// 					'part_code'					=>	$barcode,
	// 					'issue_date'				=>	date('Y-m-d'),
	// 					'quantity'					=>	1,
	// 					'material_issue_no'			=>	$getMaterialId,

	// 				);

	// 				$this->job_card_model->_table = "ser_material_scan";
	// 				$material_scan_id = $this->job_card_model->insert($data);
	// 				$data['updated'] = false;
	// 				// $success= true;
	// 			}

	// 			//FloorSupervisor advised
	// 			$this->job_card_model->_table = "ser_floor_supervisor_advice";
	// 			if($advisedpart_id) {
	// 				$advicedParts = $this->job_card_model->find(array('id'=>$advisedpart_id,));
	// 			} else {
	// 				$advicedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'upper(part_code)' => strtoupper($barcode), 'dealer_id' => $this->dealer_id));
	// 			}
	// 			// $advicedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'upper(part_name)' => strtoupper($dealer_stock->name), 'dealer_id' => $this->dealer_id));
	// 			if(! $advicedParts) {
	// 				$floordata = array(
	// 					'dealer_id'				=>	$this->dealer_id,
	// 					'jobcard_group'			=>	$jobcard_group,
	// 					'part_name'				=>	$dealer_stock->name,
	// 					'part_code'				=>	$dealer_stock->part_code,
	// 					'issue_date'			=> 	date('Y-m-d'),
	// 					'quantity'				=>	0,
	// 					'dispatched_quantity'	=>	1,
	// 					'material_scan_id'		=>	$material_scan_id,
	// 					'total_dispatched'		=>	1,
	// 				);			

	// 				$this->job_card_model->_table = "ser_floor_supervisor_advice";
	// 				$this->job_card_model->insert($floordata);
	// 				$success = TRUE;

	// 			} else {
	// 				$floordata = array(
	// 					'id'					=>	$advicedParts->id,
	// 					'part_name'				=>	$dealer_stock->name,
	// 					'dispatched_quantity'	=>	$advicedParts->dispatched_quantity + 1,
	// 					'part_code'				=>	$dealer_stock->part_code,
	// 					'issue_date'			=> 	date('Y-m-d'),
	// 					'material_scan_id'		=>	$material_scan_id,
	// 					'total_dispatched'		=>	$advicedParts->total_dispatched + 1,
	// 				);

	// 				$this->job_card_model->_table = "ser_floor_supervisor_advice";
	// 				$this->job_card_model->update($floordata['id'], $floordata);
	// 				$success = TRUE;
	// 			}


	// 			if ($success) {
	// 				// Subtracting quantity from stock
	// 				$this->job_card_model->_table = 'spareparts_dealer_stock';
	// 				if( ENABLE_SERVICE_TESTING == 0) {
	// 					$this->job_card_model->update($stock['id'],$stock);
	// 				}

	// 				$msg = "Part Added";
	// 				$success = TRUE;
	// 			}
	// 			else {
	// 				$msg = "Failed";
	// 				$success = FALSE;
	// 			}


	// 		} else {
	// 			$msg = "Not enough stock for this item.";
	// 			$success = FALSE;
	// 		}

	// 		/*$returnData = array(
	// 			'jobcard_group'				=>	$jobcard_group,
	// 			'part_id'					=>	$dealer_stock->sparepart_id,
	// 			'part_name'					=>	$dealer_stock->name,
	// 			'part_code'					=>	$barcode,
	// 			'issue_date'				=>	$data['issue_date'],
	// 			'quantity'					=>	$data['quantity'],
	// 			'updated'					=>	$data['updated'],
	// 			'material_issue_no'			=>	$data['material_issue_no'],
	// 		);*/

	// 	} else {
	// 		$msg = "You don't have this item.";
	// 		$success = FALSE;
	// 	}
		
	// 	echo json_encode(array('success' => $success, 'msg' => $msg,));

	// }

	public function set_barcode() {

		if( ! $this->dealer_id) {
			echo "403 Forbidden";
			exit;
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('jobcard_group', 'Jobcard_group', 'required');
		$this->form_validation->set_rules('barcode', 'Barcode', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('success' =>false, 'msg'=> "Inputs fields missing."));
			exit;
		}

		$jobcard_group = $this->input->post('jobcard_group');
		$barcode = $this->input->post('barcode');
		$advisedpart_id = $this->input->post('advisedpart_id');
		$old_barcode = $this->input->post('old');


		$barcode = strtoupper($barcode);
		$returnData = array();
		$deduct_Qty  = 1;

		if($old_barcode != null || $old_barcode != ''){
			$old_barcode = strtoupper($old_barcode);
			$this->job_card_model->_table = "ser_floor_supervisor_advice";
			$getOldDisqty = $this->job_card_model->find(array('id'=>$advisedpart_id,'upper(part_code)' => $old_barcode, 'dealer_id'=>$this->dealer_id));

			$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
			$old_Stock = $this->job_card_model->find(array('upper(part_code)' => $old_barcode, 'dealer_id'=>$this->dealer_id));


			if($old_Stock){
				$stock_adjust['id'] = $old_Stock->id;
				$stock_adjust['quantity'] = (int)$old_Stock->quantity + (int)$getOldDisqty->dispatched_quantity;
				$this->job_card_model->_table = 'spareparts_dealer_stock';
				$this->job_card_model->update($stock_adjust['id'],$stock_adjust);
				$deduct_Qty = (int)$getOldDisqty->dispatched_quantity;
			}
		}

		// echo '<pre>'; var_dump(($old_barcode != null || $old_barcode != '')); print_r($old_barcode); exit;

		$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
		// $dealer_stock = $this->job_card_model->find(array('upper(part_code)' => $barcode, 'dealer_id'=>$this->dealer_id),'MAX(quantity) as max_qty, *');
		$dealer_stock_ALL = $this->job_card_model->find_all(array('upper(part_code)' => $barcode, 'dealer_id'=>$this->dealer_id));
		$dealer_stock = array();
		$max = 0;
		// $max_found
		foreach ($dealer_stock_ALL as $key => $value) {
			if($value->quantity > $max){
				$dealer_stock = $value;
				$max = $value->quantity;
				// break;
			}
		}

		// $dealer_stock = max(array_column($dealer_stock_ALL, 'quantity'))
		// echo '<pre>'; echo $this->db->last_query(); print_r($dealer_stock); exit; 
		if($dealer_stock){
			$stock['id'] = $dealer_stock->id;
			$stock['quantity'] = $dealer_stock->quantity - $deduct_Qty;

			if($stock['quantity'] >= 0) {

				//Material scan part
				$this->job_card_model->_table = "view_material_scan";
				$scannedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'part_code' => $barcode, 'dealer_id' => $this->dealer_id));

				if($scannedParts) {
					$data = array(
						'id'			=>	$scannedParts->id,
						'issue_date'	=>	date('Y-m-d'),
						'quantity'		=>	$scannedParts->quantity + $deduct_Qty,
						'material_issue_no'=>$scannedParts->material_issue_no,
					);


					$this->job_card_model->_table = "ser_material_scan";
					$this->job_card_model->update($data['id'], $data);
					$material_scan_id = $data['id'];
					$data['updated'] = true;

				} else {

					// --- getting material-issue number --- //
					$getMaterialId = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
					if( ! $getMaterialId) {
						$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
					}
					// end //

					$data = array(
						'dealer_id'	 				=> 	$this->dealer_id,
						'jobcard_group'				=>	$jobcard_group,
						'part_id'					=>	$dealer_stock->sparepart_id,
						'part_code'					=>	$barcode,
						'issue_date'				=>	date('Y-m-d'),
						'quantity'					=>	$deduct_Qty,
						'material_issue_no'			=>	$getMaterialId,

					);

					$this->job_card_model->_table = "ser_material_scan";
					$material_scan_id = $this->job_card_model->insert($data);
					$data['updated'] = false;
					// $success= true;
				}

				//FloorSupervisor advised
				$this->job_card_model->_table = "ser_floor_supervisor_advice";
				if($advisedpart_id) {
					$advicedParts = $this->job_card_model->find(array('id'=>$advisedpart_id,));
				} else {
					$advicedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'upper(part_code)' => strtoupper($barcode), 'dealer_id' => $this->dealer_id));
				}
				// $advicedParts = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'upper(part_name)' => strtoupper($dealer_stock->name), 'dealer_id' => $this->dealer_id));
				if(! $advicedParts) {
					$floordata = array(
						'dealer_id'				=>	$this->dealer_id,
						'jobcard_group'			=>	$jobcard_group,
						'part_name'				=>	$dealer_stock->name,
						'part_code'				=>	$dealer_stock->part_code,
						'issue_date'			=> 	date('Y-m-d'),
						'quantity'				=>	0,
						'dispatched_quantity'	=>	$deduct_Qty,
						'material_scan_id'		=>	$material_scan_id,
						'total_dispatched'		=>	1,
					);			

					$this->job_card_model->_table = "ser_floor_supervisor_advice";
					$this->job_card_model->insert($floordata);
					$success = TRUE;

				} else {
					if($old_barcode != null || $old_barcode != ''){
						$dispatched_quantity = $advicedParts->dispatched_quantity;
					}else{
						$dispatched_quantity = $advicedParts->dispatched_quantity + 1;
					}
					$floordata = array(
						'id'					=>	$advicedParts->id,
						'part_name'				=>	$dealer_stock->name,
						'dispatched_quantity'	=>	$dispatched_quantity,
						'part_code'				=>	$dealer_stock->part_code,
						'issue_date'			=> 	date('Y-m-d'),
						'material_scan_id'		=>	$material_scan_id,
						'total_dispatched'		=>	$advicedParts->total_dispatched + 1,
					);

					$this->job_card_model->_table = "ser_floor_supervisor_advice";
					$this->job_card_model->update($floordata['id'], $floordata);
					$success = TRUE;
				}


				if ($success) {
					// Subtracting quantity from stock
					$this->job_card_model->_table = 'spareparts_dealer_stock';
					if( ENABLE_SERVICE_TESTING == 0) {
						$this->job_card_model->update($stock['id'],$stock);
					}

					$msg = "Part Added";
					$success = TRUE;
				}
				else {
					$msg = "Failed";
					$success = FALSE;
				}


			} else {
				$msg = "Not enough stock for this item.";
				$success = FALSE;
			}

			/*$returnData = array(
				'jobcard_group'				=>	$jobcard_group,
				'part_id'					=>	$dealer_stock->sparepart_id,
				'part_name'					=>	$dealer_stock->name,
				'part_code'					=>	$barcode,
				'issue_date'				=>	$data['issue_date'],
				'quantity'					=>	$data['quantity'],
				'updated'					=>	$data['updated'],
				'material_issue_no'			=>	$data['material_issue_no'],
			);*/

		} else {
			$msg = "You don't have this item.";
			$success = FALSE;
		}
		
		echo json_encode(array('success' => $success, 'msg' => $msg,));

	}


	function set_material_quantity() {
		$row = $this->input->post('partdata');
		$newvalue = $this->input->post('newvalue');
		$part_code = $this->input->post('part_code');
		$part_code = strtoupper($part_code);
		$old_quantity = $row['dispatched_quantity'];	
		$added_quantity = $newvalue - $old_quantity;
		
		// exit;
		//update to ser_material_scan not working
		if( ! $part_code) {
			// exit;
			echo json_encode(array('success' => false, 'msg' => 'Part code is not defined !!!', 'old_quantity' => $old_quantity));	
			exit;	
		}	
		if ($newvalue < 1) {	
			echo json_encode(array('success' => false, 'msg' => 'Quantity cannot be less than 1 !!!', 'old_quantity' => $old_quantity));	
			exit;	
		}	
		// echo '<pre>';	
		// print_r($this->input->post());	
		$this->job_card_model->_table = "view_spareparts_all_dealer_stock";	
		$dealer_stock_ALL = $this->job_card_model->find_all(array('upper(part_code)' => $part_code, 'dealer_id'=>$this->dealer_id));	
		$stock = 0;	
		// print_r($dealer_stock_ALL);	
		foreach ($dealer_stock_ALL as $key => $value) {	
			$stock += $value->quantity;	
		}	
		// print_r($stock);	
		// exit;	
		if($stock >= $added_quantity){	
			$data = array(	
				'id'	=>	$row['id'],	
				'dispatched_quantity'	=>	$newvalue,	
			);	
			$this->job_card_model->_table = "ser_floor_supervisor_advice";	
			$success = $this->job_card_model->update($data['id'], $data);	
			$this->job_card_model->_table = 'spareparts_dealer_stock';	
			if($success){	
				foreach ($dealer_stock_ALL as $key => $value) {	
					$stock = array(	
						'id' => $value->id,	
					);	
					if($value->quantity > $added_quantity){	
						$stock['quantity'] = $value->quantity - $added_quantity;	
						$this->job_card_model->update($stock['id'],$stock);	
						$added_quantity = 0;	
					}else{	
						$stock['quantity'] = 0;	
						$this->job_card_model->update($stock['id'],$stock);	
						$added_quantity = $added_quantity - $value->quantity;	
					}	
				}	
			}	
			$msg = 'false';	
		}else{	
			$success = false;	
			$msg = 'Stock is less than entered quantity!!!';	
		}	
		// ---------------------------------------	
		// $this->job_card_model->_table = "view_spareparts_all_dealer_stock";	
		// $dealer_stock = $this->job_card_model->find(array('upper(part_code)' => $barcode, 'dealer_id'=>$this->dealer_id),'MAX(quantity) as max_qty, *');	
		/*$dealer_stock = array();	
		$max = 0;	
		// $max_found	
		foreach ($dealer_stock_ALL as $key => $value) {	
			if($value->quantity > $max){	
				$dealer_stock = $value;	
				$max = $value->quantity;	
				// break;	
			}	
		}	
		if($dealer_stock){	
			$stock['id'] = $dealer_stock->id;	
			$stock['quantity'] = $dealer_stock->quantity - $newvalue + 1;	
			$this->job_card_model->_table = 'spareparts_dealer_stock';	
			$this->job_card_model->update($stock['id'],$stock);	
		}*/	
		echo json_encode(array('success' => $success, 'msg' => $msg, 'old_quantity' => $old_quantity));
	}

	public function save_part_return()
	{
		$this->db->trans_begin();

		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$advicedParts = $this->job_card_model->find(array('id'=>$this->input->post('return_floor_id')));

		if($advicedParts->dispatched_quantity <= 0 ) {
			echo json_encode(array('success' => FALSE));
			exit;
		}

		$data['id'] = $this->input->post('return_floor_id');
		$data['return_quantity'] = $this->input->post('return_quantity');
		$data['return_remarks'] = $this->input->post('return_remarks');
		// $data['dispatched_quantity'] = $advicedParts->dispatched_quantity -	$this->input->post('return_quantity');
		$data['received_status'] = 0;
		$data['returned_status'] = 1;

		$success = $this->job_card_model->update($data['id'],$data);

		if($success)
		{
			/*$dealer_id = $this->dealer_id;
			$jobcard_group = $this->input->post('jobcard_group');
			$part_name = $this->input->post('return_part_name');

			$this->job_card_model->_table = "view_material_scan";
			$part_detail = $this->job_card_model->find(array('dealer_id'=>$dealer_id,'jobcard_group'=>$jobcard_group,'part_name'=>$part_name),'id, part_id, quantity');

			$remove_scanned = array(
				'id'		=>	$part_detail->id,
				'quantity'	=>	$part_detail->quantity - $this->input->post('return_quantity'),
			);
			$this->job_card_model->_table = "ser_material_scan";
			$this->job_card_model->update($remove_scanned['id'], $remove_scanned);
			
			$this->job_card_model->_table = "spareparts_dealer_stock";
			$dealer_stock = $this->job_card_model->find(array('dealer_id'=>$dealer_id,'sparepart_id'=>$part_detail->part_id),array('id','quantity'));

			$stock_dealer['id'] = $dealer_stock->id;
			$stock_dealer['quantity'] = $dealer_stock->quantity + $data['return_quantity'];

			$this->job_card_model->_table = "spareparts_dealer_stock";
			if( ENABLE_SERVICE_TESTING == 0 ){
				$this->job_card_model->update($stock_dealer['id'],$stock_dealer);
			}*/
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

	public function viewJob_cardRecord($jobcard_group) {
		if ($jobcard_group==null || $jobcard_group==0 ) 
		{
			flashMsg('error', 'Invalid jobcard ID');
			redirect('admin/job_cards');  
		}

		$this->job_card_model->_table = "view_service_job_card";
		// $this->job_card_model->_table = "view_report_grouped_jobcard";
		$this->db->where('jobcard_group', $jobcard_group);
		$data['job_details'] = $this->job_card_model->findAll();

		$data['jobcard'] = $data['job_details'][0];

		$this->job_card_model->_table = "view_material_scan";
		$this->db->where('jobcard_group', $jobcard_group);
		$data['job_materials'] = $this->job_card_model->findAll();
		// print_r($this->db->last_query());
		// exit;

		$this->job_card_model->_table = "view_floor_supervisor_advice";
		$this->db->where('jobcard_group', $jobcard_group);
		$data['job_supervisor_adviced'] = $this->job_card_model->findAll();


		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$this->db->where('jobcard_group', $jobcard_group);
		$data['grouped_jobcard'] = $this->job_card_model->findAll();

		// Display Page
		$data['header'] = lang('job_cards');
		$data['page'] = $this->config->item('template_admin') . "jobcard_details_view";
		$data['module'] = 'job_cards';

		$this->load->view($this->_container,$data);
	}

	public function view_history_upload()
	{
		$data['header'] = 'Upload';
        $data['page'] = $this->config->item('template_admin') . "excel";
        $data['module'] = 'job_cards';       
        $this->load->view($this->_container,$data);
	}

	public function excelUpload()
	{
		$config['upload_path'] = './uploads/vehicle_history';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/vehicle_history/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];

        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = array(
            'title', 
            'customer_name', 
            'address_1', 
            'address_2', 
            'address_3', 
            'address_4', 
            'city', 
            'district',
            'state', 
            'mobile', 
            'phone', 
            'email', 
            'date_of_birth', 
            'date_of_anniversary', 
            'model', 
            'color_id', 
            'register_no', 
            'chassis_no', 
            'engine_no', 
            'gear_box_no', 
            'coupon_no', 
            'selling_dealer', 
            'sales_date', 
            // 'position', 
            
            /*'permanent_district_id',
            'permanent_mun_vdc_id',
            'permanent_address_id',
            'temporary_district_id',
            'temporary_mun_vdc_id',
            'temporary_address_id',*/
        );
        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
        // echo '<pre>'; print_r($raw_data); exit;

        $this->db->trans_begin();

		$this->db->insert_batch('temp_verhicle_service_history', $raw_data);
	 	if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $success = FALSE;
            $msg=lang('failure_message');
        }else{
            $this->db->trans_commit();
        	$success = TRUE;
            $msg=lang('success_message');
        }

        echo $msg;

	}

	public function delete_job()
	{
		$data['id'] = $this->input->post('id');
		$result = $this->job_card_model->delete($data['id']);
		echo json_encode(array('success'=>$result));
	}

	// public function viewJobrecord($jobcard_group) {
	// 	if ($jobcard_group==null || $jobcard_group==0 ) 
	// 	{
	// 		flashMsg('error', 'Invalid jobcard ID');
	// 		redirect('admin/job_cards');  
	// 	}

	// 	$this->job_card_model->_table = "view_service_job_card";
	// 	// $this->job_card_model->_table = "view_report_grouped_jobcard";
	// 	$this->db->where('jobcard_group', $jobcard_group);
	// 	$data['job_details'] = $this->job_card_model->findAll();

	// 	$data['jobcard'] = $data['job_details'][0];

	// 	$this->job_card_model->_table = "view_material_scan";
	// 	$this->db->where('jobcard_group', $jobcard_group);
	// 	$data['job_materials'] = $this->job_card_model->findAll();

	// 	$this->job_card_model->_table = "view_floor_supervisor_advice";
	// 	$this->db->where('jobcard_group', $jobcard_group);
	// 	$data['job_supervisor_adviced'] = $this->job_card_model->findAll();


	// 	$this->job_card_model->_table = "view_report_grouped_jobcard";
	// 	$this->db->where('jobcard_group', $jobcard_group);
	// 	$data['jobcard_billing_details'] = $this->job_card_model->find();

		
	// 	// Display Page
	// 	$data['header'] = lang('job_cards');
	// 	$data['page'] = $this->config->item('template_admin') . "jobview";
	// 	$data['module'] = 'job_cards';

	// 	$this->load->view($this->_container,$data);
	// }





	function billingexcel_dump(){
		
		$dealer_id =$this->dealer_id;

		$input_dealer = $this->input->post('dealer_list');
		// echo '<pre>'; print_r($input_dealer); exit;
		// $dealer = str_replace('-', ',', $input_dealer);

		// print_r($this->dealer_id);
		// exit;
		
		$date = $this->input->post('date_wise');
		$dates = explode(' - ', $date);
		// $date = '2018-04-17';

		$this->job_card_model->_table = "view_billing_jobcard";
		$fields = 'dealer_name,issue_date,service_advisor_name,jobcard_serial,service_type_name,vehicle_no,variant_name,color_name,chassis_no,invoice_no,payment_type,cash_account,credit_account,total_parts,total_jobs,cash_discount_percent,cash_discount_amt,vat_percent,vat_job,net_total';
		// $this->db->where("issue_date >='$date 00:00:00' AND issue_date <='$date 24:00:00'");

		// if($dealer_id){
		// 	$this->db->where('dealer_id',$dealer_id);
		// }

		if(is_admin()){
				$where = '';
		}else if( is_service_advisor() || is_accountant() ||  is_workshop_manager()) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				// $where = "dealer_id = {$this->dealer_id}";
				$this->db->where('dealer_id',$dealer_id);
			}
		

		} else if(is_floor_supervisor()){
			// $where = "dealer_id = {$this->dealer_id}";
			$this->db->where('dealer_id',$dealer_id);
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() ||  is_service_finance() || is_service_management()){
			$where = '';
	
		}
		elseif(is_service_dealer_incharge()){
			$dealer_list    = (is_service_dealer_incharge()) ? get_service_dealer_list() : NULL; 
				if(!empty($dealer_list)) {
				// $this->db->where_in('dealer_id', $dealer_list);
				$dealer_where_array = array();
				foreach ($dealer_list as $key => $value) {
					$dealer_where_array[] = "(".$value.")";
				}
				$where_dealer = implode(',', $dealer_where_array);
				$this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
			}

		}
		else{
			// $where = "dealer_id = {$this->dealer_id}";
			$this->db->where('dealer_id',$dealer_id);
		}	
		// if(count($dates) > 1){
		// 	$this->db->where("issue_date >='".$dates[0]." 00:00:00' AND issue_date <='". $dates[1] ." 24:00:00'");
		// }else{
		// 	$this->db->where("issue_date >='".date('Y-m-d')." 00:00:00' AND issue_date <='". date('Y-m-d') ." 24:00:00'");
		// }

		if(count($dates) > 1){
			$this->db->where("job_card_issue_date >='".$dates[0]." 00:00:00' AND job_card_issue_date <='". $dates[1] ." 23:59:59'");
		}else{
			$this->db->where("job_card_issue_date >='".date('Y-m-d')." 00:00:00' AND job_card_issue_date <='". date('Y-m-d') ." 23:59:59'");
		}

		if($this->input->post('dealer_list'))
			{
				$this->db->where("dealer_id IN (".$input_dealer.")",NULL, false);
			}
		$this->db->where("closed_status",1);
		$rows = $this->job_card_model->findAll(NULL,$fields);
		// echo $this->db->last_query();
		// echo"<pre>";
		// print_r($rows);
		// exit;
		if($rows)
		{
			$this->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Issue Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Service Advisor');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Job Card Number');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Service Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Vehicle No.');
			
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Variant');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Color');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Inovice No');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Payment Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Cash Account');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','Credit Account');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1','Total Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1','Total Jobs');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q1','Cash Discount Percent');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1','Cash Discount Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('S1','VAT Percent');
			$objPHPExcel->getActiveSheet()->SetCellValue('T1','VAT No');
			$objPHPExcel->getActiveSheet()->SetCellValue('U1','Net Total');
			
			

			$row = 2;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->variant_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->color_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->payment_type);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_account);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->credit_account);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_parts);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_jobs);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount_percent);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount_amt);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_percent);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_job);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
				$col++;
				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=AllJobcardBilling.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			redirect('admin/service_reports/jobcard_billing');
		}
		redirect('admin/service_reports/jobcard_billing');

	}


	
function excel_dump(){

	$dealer_id =$this->dealer_id;

	$input_dealer = $this->input->post('dealer_list');
	$date = $this->input->post('date_wise');
	$dates = explode(' - ', $date);
		// $date = '2018-03-18';

		// $this->db->where("closed_status",1);

	 if(is_admin()){
				$where = '';
		}else if( is_service_advisor() || is_accountant() ||  is_workshop_manager()) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				// $where = "dealer_id = {$this->dealer_id}";
				$this->db->where('dealer_id',$dealer_id);
			}
		

		} else if(is_floor_supervisor()){
			// $where = "dealer_id = {$this->dealer_id}";
			$this->db->where('dealer_id',$dealer_id);
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() ||  is_service_finance() || is_service_management()){
			$where = '';
	
		}
		elseif(is_service_dealer_incharge()){
			$dealer_list    = (is_service_dealer_incharge()) ? get_service_dealer_list() : NULL; 
				if(!empty($dealer_list)) {
				// $this->db->where_in('dealer_id', $dealer_list);
				$dealer_where_array = array();
				foreach ($dealer_list as $key => $value) {
					$dealer_where_array[] = "(".$value.")";
				}
				$where_dealer = implode(',', $dealer_where_array);
				$this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
			}

		}
		
		// $this->job_card_model->_table = "view_jobcard_excel";
		// $fields = 'jobcard_group,full_name,mobile,address1,jobcard_issue_date,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,service_advisor_name,floor_supervisor_name,customer_voice,issue_date,kms,mechanic_name,dealer_name';
			$this->job_card_model->_table = "view_all_grouped_jobcard";
		$fields = 'jobcard_group,customer_name,mobile,address1,job_card_issue_date,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,service_advisor_name,floor_supervisor_name,job_desc,issue_date,kms,mechanic_name,dealer_name';

		
		// $this->db->group_by("jobcard_group,job,full_name,mobile,address1,jobcard_issue_date,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,service_advisor_name,floor_supervisor_name,customer_voice");
		// $this->db->where("jobcard_issue_date >='$date 00:00:00' AND jobcard_issue_date <='$date 24:00:00'");
		if(count($dates) > 1){
			$this->db->where("job_card_issue_date >='".$dates[0]." 00:00:00' AND job_card_issue_date <='". $dates[1] ." 23:59:59'");
		}else{
			$this->db->where("job_card_issue_date >='".date('Y-m-d')." 00:00:00' AND job_card_issue_date <='". date('Y-m-d') ." 23:59:59'");
		}
		$rows = $this->job_card_model->findAll(null,$fields);
		// echo"<pre>";
		// print_r($rows);
		// exit;
		if($rows)
		{
			$this->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Job Card Number');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Party Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Mobile');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Address');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Issued Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Vehicle Model');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Vehicle No.');
			
			
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Service Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Service Count');
			
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Advisor');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','Floor');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1','Customer Voice');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1','Bill Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q1','KMS');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1','Mechanic Name');
			

			$row = 2;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_group);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mobile);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->address1);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_count);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->floor_supervisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, ($values->issue_date != NULL || $values->issue_date != '')?'Billed':'Not Billed');
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->kms);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;

				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=Jobcards.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			redirect('admin/service_reports/jobcard');
		}
		redirect('admin/service_reports/jobcard');
}

	public function show_service_history()
	{
		$chass_no = $this->input->get('chassis_no');

		$data['workshop'] = $this->get_workshop_name();


		$data['jobcard'] = null;
		$this->job_card_model->_table = "view_report_grouped_jobcard";
		$jobcard = $this->job_card_model->findAll(array('chassis_no' => $chass_no));
		if($jobcard){

			foreach ($jobcard as $key => &$value) {
				$this->job_card_model->_table = "view_service_billing_record";
				$billing = $this->job_card_model->find(array('jobcard_group' => $value->jobcard_group));
				$value = (object) array_merge( (array)$value, array( 'payment_type' => @$billing->payment_type ) );
				$value = (object) array_merge( (array)$value, array( 'bill_issue_date' => @$billing->issue_date ) );
				$value = (object) array_merge( (array)$value, array( 'invoice_no' => @$billing->invoice_no ) );
				$value = (object) array_merge( (array)$value, array( 'invoice_no' => @$billing->invoice_no ) );

				$this->job_card_model->_table = "view_service_billing_jobs";
				$jobs = $this->job_card_model->findAll(array('jobcard_group' => $value->jobcard_group));


				$this->job_card_model->_table = "view_service_billing_parts";
				$parts = $this->job_card_model->findAll(array('jobcard_group' => $value->jobcard_group));

				$this->job_card_model->_table = "view_service_billing_outsideworks";
				$outside_work = $this->job_card_model->findAll(array('jobcard_group' => $value->jobcard_group));

				$value->jobs = @$jobs;
				$value->parts = @$parts;
				$value->outside_work = @$outside_work;



			}
			$data['jobcard'] = $jobcard;
		}
		// echo '<pre>'; print_r($data); exit;
		$data['module'] = 'job_cards';
		$this->load->view($this->config->item('template_admin') . 'show_history' , $data);
	}


	public function save_job_billed_parts_error($jobcard = null)
	{
		$this->job_card_model->_table = 'view_material_scan';

		$where['jobcard_group'] = $jobcard;

		$rows = $this->job_card_model->find_all($where);

		$jobData = array();
		$owData = array();
		foreach ($rows as $key => $value) {
			$temp = array(
				'billing_id' 			=>	2573,
				'part_id' 				=>	$value->part_id,
				'price'					=>	$value->price?$value->price:0,
				'quantity'					=>	$value->dispatched_quantity,
				// 'discount_percentage' 	=>	$value->discount_percentage,
				// 'discount_amount' 		=>	$value->price * ($value->discount_percentage/100),
				'final_amount' 			=>	$value->price * $value->dispatched_quantity,
				// 'status' 				=>	$value->status,
			);

			$jobData[] = array_filter($temp, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});

			
		}
		if($jobData) {
			$this->job_card_model->_table = "ser_billed_parts";
			$this->job_card_model->insert_many($jobData);

		}
		echo 'success'; exit;
		// echo '<pre>'; print_r($jobData); exit;
	}

	function getPDI_jobs(){
		$this->job_card_model->_table ='mst_service_jobs';
		$this->db->like('job_code','PDI');
		$get = $this->job_card_model->findAll();
		
		echo json_encode($get);
		// exit;
	}


	public function generate_excel()
    {
    	$jobcard_group = $this->input->get('jobcard_group');

    	
    	$this->job_card_model->_table = "view_service_billing_record";
    	$data['jobcard'] = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group));

    	$date = explode(' ',$data['jobcard']->created_at);


    	$where = array();
    	$where['jobcard_group'] = $jobcard_group;


    	$this->job_card_model->_table = 'view_service_billing_parts';
    	$data['parts'] = $this->job_card_model->find_all($where);

    	if($data)
    	{
    		$this->load->library('Excel');
    		$this->load->library('number_to_words');
    		$objPHPExcel = new PHPExcel(); 

    		$styleArray = [
    			'font' => [
    				'bold' => true,
    			],

    		];
    		$objPHPExcel->setActiveSheetIndex(0);
    		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
    		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
    		$objPHPExcel->getActiveSheet()->SetCellValue('A1','Credit');
    		$objPHPExcel->getActiveSheet()->SetCellValue('A2','Name');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B2',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C2',$data['jobcard']->customer_name);
    		$objPHPExcel->getActiveSheet()->SetCellValue('E3','Invoice NO');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F3',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G3',$data['jobcard']->invoice_no);
    		$objPHPExcel->getActiveSheet()->SetCellValue('A4','Address');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B4',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C4',$data['jobcard']->address1);


    		$objPHPExcel->getActiveSheet()->SetCellValue('E5','Date & Time');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F5',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G5',$date[0]);
    		$objPHPExcel->getActiveSheet()->SetCellValue('H5',$date[1]);

    		$objPHPExcel->getActiveSheet()->SetCellValue('A6','Phone no');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B6',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C6',$data['jobcard']->mobile);
				// $objPHPExcel->getActiveSheet()->SetCellValue('D6','');
    		$objPHPExcel->getActiveSheet()->SetCellValue('E7','Job no');
    		$objPHPExcel->getActiveSheet()->SetCellValue('f7',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G7',$data['jobcard']->jobcard_serial);

    		$objPHPExcel->getActiveSheet()->SetCellValue('A8',' TPIN No.');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B8','');

    		$objPHPExcel->getActiveSheet()->SetCellValue('A10','Model');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B10',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C10',$data['jobcard']->vehicle_name.' '.$data['jobcard']->variant_name);
    		$objPHPExcel->getActiveSheet()->SetCellValue('E10','Kms');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F10',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G10',$data['jobcard']->kms);
    		$objPHPExcel->getActiveSheet()->SetCellValue('A11',' Regd No.');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B11',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C11',$data['jobcard']->vehicle_no);

    		$objPHPExcel->getActiveSheet()->SetCellValue('E11','Service');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F11',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G11',$data['jobcard']->service_type_name);


    		$objPHPExcel->getActiveSheet()->SetCellValue('A12',' Chassiss No');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B12',':');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C12',$data['jobcard']->chassis_no);
    		$objPHPExcel->getActiveSheet()->SetCellValue('E12','Service No');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F12',":");
    		$objPHPExcel->getActiveSheet()->SetCellValue('G12',$data['jobcard']->service_count);
    		$objPHPExcel->getActiveSheet()->getStyle('A15:H15')->applyFromArray($styleArray);
    		$objPHPExcel->getActiveSheet()->SetCellValue('A15','Sr #');
    		$objPHPExcel->getActiveSheet()->SetCellValue('B15','Item No.');
    		$objPHPExcel->getActiveSheet()->SetCellValue('C15','Item Description');
    		$objPHPExcel->getActiveSheet()->SetCellValue('D15','Qty.');
    		$objPHPExcel->getActiveSheet()->SetCellValue('E15','Rate');
    		$objPHPExcel->getActiveSheet()->SetCellValue('F15','Item Discount');
    		$objPHPExcel->getActiveSheet()->SetCellValue('G15','Labour Amount');
    		$objPHPExcel->getActiveSheet()->SetCellValue('H15','parts Amount');

    		$row = 16;
    		$col = 0;  
    		$sum = 0;

    		foreach($data['parts'] as $key=>$value)
    		{


    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->part_code);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->part_name);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,($value->lube_quantity>0)?$value->lube_quantity:$value->quantity);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->price);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->discount_percentage);
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,'');
    			$col++;
    			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,$value->final_amount);
    		
    			$sum = $sum + $value->final_amount;
    			$col = 0;
    			$row++; 
    		
    		}

    		$total = $sum;
    		$discount_amt = $sum *($data['jobcard']->cash_discount_percent/100);
    		$taxable_amt = $total-$discount_amt;
    		$vat_amt = $taxable_amt*(13/100);
    		$net_amt = $taxable_amt+$vat_amt;
    		$sum_in_word = $this->number_to_words->number_to_words_nepali_format($net_amt);

    		$objPHPExcel->getActiveSheet()->getStyle('G'.($row).':H'.($row))->applyFromArray($styleArray);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.$row, 'Sub Total')
    		->setCellValue('H'.$row, '=SUM(H7:H'.($row-1).')');

    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+1), 'Gross Amount');
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+1), '=SUM(H7:H'.($row-1).')');

    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+2), 'cash Disc. @'.$data['jobcard']->cash_discount_percent.'%');
			
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+2), $discount_amt);

    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+3), 'Taxable Amt');
				
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+3), $taxable_amt);


    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+4), 'vat @13%');
				
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+4),$vat_amt);


    		$objPHPExcel->getActiveSheet()->getStyle('G'.($row+6).':H'.($row+6))->applyFromArray($styleArray);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+6), 'Net Bill Amount');
				
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+6), $net_amt);


    		$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+7).':B'.($row+7));
				
    		$objPHPExcel->getActiveSheet()->mergeCells('C'.($row+7).':H'.($row+7));
			
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('A'.($row+7), 'Amount In Words');
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('C'.($row+7),$sum_in_word);
    		
    		$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+9).':F'.($row+9));
    		$objPHPExcel->getActiveSheet()->getStyle('A'.($row+9).':F'.($row+9))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('A'.($row+9), 'PAYMENT TO BE MADE IN FAVOR M/S '.$data['jobcard']->dealer_name.'  - GOODS ONCE SOLD WILL NOT BE TAKEN BACK');

    		$objPHPExcel->getActiveSheet()->getStyle('G'.($row+10).':H'.($row+10))->applyFromArray($styleArray);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+10), 'For');
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('H'.($row+10), $data['jobcard']->dealer_name);
    		$objPHPExcel->getActiveSheet()->mergeCells('A'.($row+11).':B'.($row+11));
    		$objPHPExcel->getActiveSheet()->getStyle('A'.($row+11).':B'.($row+11))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('A'.($row+11), 'Customer Signature');
    		$objPHPExcel->getActiveSheet()->mergeCells('G'.($row+11).':H'.($row+11));
    		$objPHPExcel->getActiveSheet()->getStyle('G'.($row+11).':H'.($row+11))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    		$objPHPExcel->getActiveSheet()
    		->setCellValue('G'.($row+11), 'Authorised Signature');
    		header("Pragma: public");
    		header("Content-Type: application/force-download");
    		header("Content-Disposition: attachment;filename=Jobcards-".date('Y-m-d').".xls");
    		header("Content-Transfer-Encoding: binary ");

    		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    		ob_end_clean();
    		$objWriter->save('php://output');

    	}

 	}

} 

