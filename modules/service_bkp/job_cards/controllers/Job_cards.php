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
		$this->lang->load('job_cards/job_card');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('job_cards');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'job_cards';

		

		$this->job_card_model->_table = "ser_estimate_details";
		$this->db->limit(1);
		$data['new_estimate_no'] = $this->job_card_model->find(null,'max(estimate_doc_no)');
		$data['new_estimate_no'] = ++$data['new_estimate_no']->max;

		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->job_card_model->_table = 'view_service_job_card';
		$where = NULL;

        if(is_floor_supervisor()){
            $where['floor_supervisor_id'] = $this->_user_id;
        }
        if(is_service_advisor()){
            $where['created_by'] = $this->_user_id;
			// $where['floor_supervisor_id'] = $this->_user_id;
        }

        search_params();

        $fields = 'jobcard_issue_date, jobcard_group, vehicle_no, engine_no, chassis_no, vehicle_id, vehicle_name, variant_id, variant_name, color_id, color_name, closed_status, full_name';

        $this->db->group_by($fields);
        $total =  count($this->job_card_model->findAll($where, $fields));

        paging('jobcard_group');

        search_params();

        $this->db->group_by($fields);
        $rows=$this->job_card_model->findAll($where, $fields);
        // echo $this->db->last_query();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $all_data = $this->_get_posted_data();

        /*To check if action for insert or update*/
        $this->job_card_model->_table = "view_service_job_card";
        $jobcard = $this->job_card_model->find(array('jobcard_group' => $all_data['details']['jobcard_group']));

        // print_r($all_data);exit;

        $this->job_card_model->_table = "ser_job_cards";
        if($jobcard == false) {
            // insert
            $success = $this->job_card_model->insert_many($all_data['jobcard']);
        }
        else {
            // update
            foreach ($all_data['jobcard'] as $key => $value) {
                if( isset($value['id'])) {
                    $success = $this->job_card_model->update($value['id'], $value);
                }
                else {
                    $success = $this->job_card_model->insert($value);
                }
            }
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

        echo json_encode(array('msg'=>$msg,'success'=>$success, 'jobno'=>$all_data['details']['jobcard_group']));
        exit;		
    }

    private function _get_posted_data()
    {
      $data =array();

      $raw = $this->input->post('data');

      //Get service count
      $this->job_card_model->_table = "view_report_grouped_jobcard";
      $this->db->group_by('jobcard_group');
      $this->db->where('issue_date is not null');
      $service_count = $this->job_card_model->find(array('vehicle_no' => $raw['vehicle_register_no']), 'count(jobcard_group)' );

      $data['details'] = array(
         'jobcard_group'		=>	$raw['jobcard_group'],
         'vehicle_no'			=>	$raw['vehicle_register_no'],
         'engine_no'			=>	$raw['engine_no'],
         'chassis_no'			=>	$raw['chassis_no'],
         'gear_box_no'			=>	$raw['gear_box_no'],
         'vehicle_id'			=>	$raw['vehicle_name'],
         'variant_id'			=>	$raw['variant_name'],
         'color_id'				=>	$raw['color_name'],
         'service_type'			=>	$raw['service_type'],
         'service_count'		=>	($service_count)?$service_count->count:1,
         'key_no'				=>	$raw['key_no'],
         'kms'					=>	$raw['kms'],
         'fuel'					=>	$raw['fuel'],
         'floor_supervisor_id'	=>	$raw['floor_supervisor_id'],
         'mechanics_id'			=>	$raw['mechanics_id'],
         'cleaner_id'			=>	$raw['cleaner_id'],
         'vehicle_sold_on'		=>	$raw['vehicle_sold_on'],
         'party_id'				=>	$raw['party_id'],
         'coupon'               =>  $raw['coupon'],
         'issue_date'           =>  $raw['issue_date'],
         'mechanic_list'		=>	@$raw['mechanic_list'],
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
    			$data['jobcard'][$key]['customer_voice'] = $value['customer_voice'];
    			$data['jobcard'][$key]['job_id'] = $value['job_id'];
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


    	$data['user_ledger']['full_name'] = $this->input->post('party_id');

		// print_r($data['user_ledger']);exit;
		// ############################updating users
    	$this->job_card_model->_table = 'mst_user_ledger';
    	$check_user = $this->job_card_model->find(array('full_name'=>$data['user_ledger']['full_name']));

    	$data['user_ledger']['title'] = $check_user->title;
    	$data['user_ledger']['short_name'] = $check_user->short_name;
    	$data['user_ledger']['full_name'] = $check_user->full_name;
    	$data['user_ledger']['address1'] = $check_user->address1;
    	$data['user_ledger']['address2'] = $check_user->address2;
    	$data['user_ledger']['address3'] = $check_user->address3;
    	$data['user_ledger']['city'] = $check_user->city;
    	$data['user_ledger']['area'] = $check_user->area;
    	$data['user_ledger']['district_id'] = $check_user->district_id;
    	$data['user_ledger']['zone_id'] = $check_user->zone_id;
    	$data['user_ledger']['pin_code'] = $check_user->pin_code;
    	$data['user_ledger']['std_code'] = $check_user->std_code;
    	$data['user_ledger']['mobile'] = $check_user->mobile;
    	$data['user_ledger']['phone_no'] = $check_user->phone_no;
    	$data['user_ledger']['email'] = $check_user->email;

    	$data['user_ledger']['vehicle_no'] = $this->input->post('vehicle_register_no');
    	$data['user_ledger']['engine_no'] = $this->input->post('engine_no');
    	$data['user_ledger']['chassis_no'] = $this->input->post('chassis_no');
    	$data['user_ledger']['vehicle_id'] = $this->input->post('vehicle_name');
    	$data['user_ledger']['variant_id'] = $this->input->post('variant_name');
    	$data['user_ledger']['color_id'] = $this->input->post('color_name');
    	$data['user_ledger']['vehicle_sold_on'] = $this->input->post('vehicle_sold_on');
    	$data['user_ledger']['jobcard_group'] = $this->input->post('jobcard_group');

    	$this->job_card_model->insert($data['user_ledger']);

		// ###########################################

    	$data['job_cards']['service_type'] = $this->input->post('service_type');
		// $data['job_cards']['service_no'] = $this->input->post('service_no');
    	$data['job_cards']['kms'] = $this->input->post('kms');
    	$data['job_cards']['fuel'] = $this->input->post('fuel');
    	$data['job_cards']['key_no'] = $this->input->post('key_no');
    	$data['job_cards']['floor_supervisor_id'] = $this->input->post('floor_supervisor_id');
    	$data['job_cards']['mechanics_id'] = $this->input->post('mechanics_id');
    	$data['job_cards']['cleaner_id'] = $this->input->post('cleaner_id');
    	$data['job_cards']['accessories'] = $this->input->post('accessories');
    	$data['job_cards']['sell_dealer'] = $this->input->post('sell_dealer');
    	$data['job_cards']['gear_box_no'] = $this->input->post('gear_box_no');

		// calculating jobcard_no
		// $this->db->select_max('jobcard_group','jobcard_group');
		// $final_job = $this->job_card_model->find();
		// if($final_job->jobcard_group == $this->input->post('jobcard_group'))
		// {
    	$data['job_cards']['jobcard_group'] = $this->input->post('jobcard_group');
		// }
		// else{
			// $data['job_cards']['jobcard_group'] = $final_job->jobcard_group + 1;
		// }
    	$jobs = $this->input->post('jobs');
    	if($jobs != ''){
    		$jobsarray = json_decode($jobs);
			// print_r($jobsarray);
    		foreach ($jobsarray as $key => $value) {
    			$data['jobs'][$key] = $data['job_cards'];

    			$data['jobs'][$key]['customer_voice'] = $value->customer_voice;
    			$data['jobs'][$key]['job_id'] = $value->job_id;
    			$data['jobs'][$key]['cost'] = $value->price;
    			$data['jobs'][$key]['final_amount'] = $value->price;
    			$data['jobs'][$key]['status'] = $value->status;
    			$data['jobs'][$key]['id'] 	=	@$value->id;

				// $data['jobs'][$key] = array_filter($data['jobs'][$key]);
				// print_r($data['jobs'][$key]);
    			$data['jobs'][$key] = array_filter($data['jobs'][$key], function($value) {
    				return ($value !== null && $value !== false && $value !== ''); 
    			});
				// $data['jobs'][$key]['jobcard_group'] = $data['job_cards']['jobcard_group'];
    		}

    	}

    	unset($data['job_cards']);
			// print_r($data);exit;

    	return $data;
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
    	$this->user_group_model->_table = 'view_user_groups';

    	$where['group'] = $this->input->get('group');

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
    	$data['count'] = count ($this->job_card_model->findAll($where, $fields));


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
    public function estimate_form_data_json(){
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

		/*echo $this->db->last_query();
		print_r( $ow_rows );
		print_r( $rows );
		exit;*/


		echo json_encode(array('total' => $total, 'rows' => $rows));
	}

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

	public function partial_save_estimate() {
		$this->job_card_model->_table = "ser_estimate_details";

		$post = $this->input->post();
		$post['jobs'] = json_decode($post['jobs']);
		$post['parts'] = json_decode($post['parts']);


		/*$this->db->select_max('estimate_doc_no');
		$estimate_group = $this->job_card_model->find(null,'');
		$estimate_group = $estimate_group->estimate_doc_no +1;

		print_r($estimate_group);
		exit;*/
		// print_r($post); exit;

		if($post['party_setting'] == 1) {
			/*foreach ($post['party_details'] as $key => $value) {
				$refine_party[$value['name']] = $value['value'];
			}*/

			$party_details = array(
				'title'      	=>	$post['party_details']['new_entry-title'],
				'short_name' 	=>	$post['party_details']['new_entry-short_name'],
				'full_name'  	=>	$post['party_details']['new_entry-name'],
				'address1'   	=>	$post['party_details']['new_entry-address1'],
				'address2'   	=>	$post['party_details']['new_entry-address2'],
				'address3'   	=>	$post['party_details']['new_entry-address3'],
				'city'       	=>	$post['party_details']['new_entry-city'],
				'area'       	=>	$post['party_details']['new_entry-area'],
				'district_id'	=>	$post['party_details']['new_entry-district'],
				'zone_id'    	=>	$post['party_details']['new_entry-zone'],
				'pin_code'   	=>	$post['party_details']['new_entry-pin_code'],
				'std_code'   	=>	$post['party_details']['new_entry-std_code'],
				'mobile'     	=>	$post['party_details']['new_entry-mobile'],
				'phone_no'   	=>	$post['party_details']['new_entry-phone'],
				'email'      	=>	$post['party_details']['new_entry-email'],
				);

			$party_details = array_filter($party_details, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});

			$this->job_card_model->_table = 'mst_user_ledger';
			$post['party_details']['ledger_id'] = $this->job_card_model->insert($party_details);
		}

		$data = array(
			// 'estimate_doc_no' 		=>	$post['details']['doc_no'],
			'jobcard_group'			=>	$post['details']['jobcard_group'],
			'vehicle_register_no'	=>	$post['details']['vehicle_register_no'],
			'chassis_no'			=>	$post['details']['chassis_no'],
			'engine_no'				=>	$post['details']['engine_no'],
			'model_no'			=>	$post['details']['vehicle_id'],
			'variant'			=>	$post['details']['variant_id'],
			'color'				=>	$post['details']['color_id'],

			'ledger_id'			=>	$post['party_details']['ledger_id'],

			'total_parts'		=>	$post['summary']['total_for_parts'],
			'total_jobs'		=>	$post['summary']['total_for_jobs'],
			'cash_percent'	=>	$post['summary']['cash_discount_percent'],
			'vat_percent'			=>	$post['summary']['vat_percent'],
			'net_total'				=>	$post['summary']['net_total']
			);

		$this->job_card_model->_table = "ser_estimate_details";
		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		if($post['details']['doc_id']) {
			$data['estimate_doc_no'] = $post['details']['doc_no'];
			$data['id'] = $post['details']['doc_id'];
			$estimate_id =$this->job_card_model->update($data['id'],$data);
		}
		else {
			$data['estimate_doc_no'] = $this->job_card_model->find(null,'max(estimate_doc_no)');
			$data['estimate_doc_no'] = ++$data['estimate_doc_no']->max;
			$estimate_id =$this->job_card_model->insert($data);
		}

		if(! empty($post['jobs']))
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
				$this->job_card_model->insert($data);
			}
		}

		if(! empty($post['parts']))
		{
			foreach ($post['parts'] as $key => $value) {
				$data = array(
					'part_id'		=>	$value->part_id,
					'price'			=>	$value->price,
					'quantity'		=>	$value->quantity,
					'discount_percentage'		=>	@$value->discount,
					'final_amount'	=>	$value->total,

					'estimate_id'	=>	$estimate_id,
					);

				$this->job_card_model->_table = "ser_parts";
				if(isset($value->id)) {
					$data['id'] = $value->id;
					$this->job_card_model->update($data['id'],$data);
				}
				else {
					$this->job_card_model->insert($data);
				}
			}
		}

		

		

	}

	// save estimate
	public function save_estimate()
	{
		$data = $this->input->post();

		echo '<pre>';
		print_r($data);
		$jobs = json_decode($data['jobs']);
		$parts= json_decode($data['parts']);
		$where['vehicle_id'] = $data['vehicle_id'];
		$where['jobcard_group'] = $data['jobcard_group'];
		print_r($parts);

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
				echo 'here';
				$part_data['id'] = $value->id;
				$this->job_card_model->update($part_data['id'],$part_data);
				print_r($this->db->last_query());
			}else{
				echo 'there';
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

	public function combobox_workshop_json() {
		$this->job_card_model->_table = 'view_sparepart_dealers';

		$rows = $this->job_card_model->findAll();

		echo json_encode($rows);
	}

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

		$this->job_card_model->_table = 'ser_jobcard_status';
		$this->job_card_model->insert($data);

		/*Now updating in the Job cards*/
		$this->job_card_model->_table = 'ser_job_cards';
		$job_cards = $this->job_card_model->findAll(array('jobcard_group' => $data['jobcard_group']), 'id, closed_status');


		foreach ($job_cards as $key => $value) {
			$value->closed_status = $data['status'];
			$success = $this->job_card_model->update($value->id,$value);
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
		$this->job_card_model->_table = 'mst_user_ledger';


		$fields = 'id, full_name';
		$this->db->order_by('full_name asc');
		// $this->db->group_by($fields);
		$rows=$this->job_card_model->findAll(null, $fields);

		echo json_encode($rows);
	}

	public function save_outside_work_all() {
		$this->job_card_model->_table = 'ser_outside_work';

		$post = array_filter($this->input->post());

		$data = array(
			'send_date'			=> $post['data']['send_date'],
			'workshop_id'		=> $post['data']['workshop_id'],
			'splr_invoice_no'	=> $post['data']['splr_invoice_no'],
			'splr_invoice_date'	=> $post['data']['splr_invoice_date'],
			'remarks'			=> $post['data']['remarks'],
			'gross_total'		=> $post['data']['gross_total'],
			'round_off'			=> $post['data']['round_off'],
			'net_amount'		=> $post['data']['net_amount'],
			);

		$post = $post['outsideRecords'];

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

        foreach ($post as $key => $value) {
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
   exit;
}

public function get_grouped_outsideWorks() {
  $this->job_card_model->_table = 'ser_outside_work';
  $jobcard_group = $this->input->post('jobcard_group');

  $fields = 'jobcard_group, workshop_id, remarks, send_date, splr_invoice_date, splr_invoice_no, gross_total, net_amount, round_off'; 

  $this->db->group_by($fields);
  $rows = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group), $fields);

  echo json_encode(array('rows'=>$rows));
}
public function get_grid_outsideWorks() {
  $this->job_card_model->_table = 'view_outside_works';
  $jobcard_group = $this->input->post('jobcard_group');

		// $fields = 'jobcard_group, workshop_id, remarks, send_date, splr_invoice_date, splr_invoice_no, gross_total, net_amount, round_off'; 

		// $this->db->group_by($fields);
  $rows = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group));

  echo json_encode(array('rows'=>$rows));
}

public function get_jobCard_details() {
  $jobcard_group = $this->input->post('jobcard_group');
  $vehicle_no = $this->input->post('vehicle_no');

  $this->job_card_model->_table = "view_service_job_card";
  $data['jobs'] = $this->job_card_model->findAll(array('jobcard_group'=> $jobcard_group));

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

		$this->job_card_model->_table = 'view_service_parts';
		$rows['parts'] = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group));

		echo json_encode($rows);
	}

	public function material_issue_save() {
		$this->job_card_model->_table = "ser_parts";
		$post = array_filter($this->input->post());

		if($post['materialData'] != ''){
			$materialData = json_decode($post['materialData']);
		}

		foreach ($materialData as $key => &$value) {
			$value  = (array)$value;
		}
		unset($value);

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
		$jobcard_group = $this->input->post('jobcard_group');


		if($jobcard_group){
			$this->job_card_model->_table = 'view_service_job_card';

			$rows['details'] = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group));
		}
		if($docno) {
			$this->job_card_model->_table = 'view_service_estimate_records';
			$rows['details'] = $this->job_card_model->find(array('estimate_doc_no'=>$docno));
			
			$this->job_card_model->_table = 'view_service_parts';
			$rows['parts'] = $this->job_card_model->findAll(array('estimate_id'=>$rows['details']->id));

		}
		// print_r($rows);exit;

		echo json_encode($rows);

	}

	public function print_preview() {
		$get = $this->input->get();
		
		$data['workshop'] = $this->get_workshop_name();

		switch ($get['type']) {
			case 'JobCard':
			$print = "prints/jobcard_print";
			if(isset($get['jobcard'])) {
				$this->job_card_model->_table = "view_service_job_card";
				$data['jobcard'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));
				// $this->job_card_model->_table = "view_user_ledger";
				// $data['customer'] = $this->job_card_model->find(array('jobcard_group' => $get['jobcard']));
				$data['customer'] = $data['jobcard'][0];

				$data['header'] = $get['type'];
				$data['module'] = 'dispatch_dealers';


			}
			break;

			case 'Material Issue':
			$print = "prints/material_issue_print";
			if(isset($get['jobcard'])) {
				$this->job_card_model->_table = "view_service_parts";
				$data['parts'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));
				$data['customer'] = $data['parts'][0];

				$data['header'] = $get['type'];
				$data['module'] = 'dispatch_dealers';
			}
			break;

			case 'Estimate':
			$print = "prints/estimate_print";
			if(isset($get['jobcard'])) {
				$this->job_card_model->_table = "view_service_estimate_records";
				$data['estimate'] = $this->job_card_model->find(array('estimate_doc_no' => $get['jobcard']));
				$this->job_card_model->_table = "view_service_parts";
				$data['parts'] = $this->job_card_model->findAll(array('estimate_id' => $data['estimate']->id));
				$this->job_card_model->_table = "view_service_job_card";
				$data['jobs'] = $this->job_card_model->findAll(array('estimate_id' => $data['estimate']->id));

				$data['header'] = $get['type'];
				$data['module'] = 'dispatch_dealers';
			}
            // echo "<pre>";
            // print_r($data);exit;

			break;

            case 'Outside Work':
            $print = "prints/outsidework_print";
            if(isset($get['jobcard'])) {
                $this->job_card_model->_table = "view_outside_works";
                $data['works'] = $this->job_card_model->findAll(array('jobcard_group' => $get['jobcard']));
                $data['outside_work'] = $data['works'][0];

                $data['header'] = $get['type'];
                $data['module'] = 'dispatch_dealers';
            }
            break;
            
            default:
            break;

            case 'Invoice':
            $print = "prints/invoice_print";
            if(isset($get['jobcard'])) {
                $this->job_card_model->_table = "view_service_job_card";
                $data['jobs'] = $this->job_card_model->findAll( array('jobcard_group' =>  $get['jobcard']) );

                $data['jobcard'] = $data['jobs'][0];

                $this->job_card_model->_table = 'view_outside_works';
                $ow_rows = $this->job_card_model->findAll( array('jobcard_group' =>  $get['jobcard']) );

                $total = count($data['jobs']);
                foreach ($ow_rows as $key => $value) {
                    $k = $total+$key;
                    $data['jobs'][$k] = new \stdClass();
                    $data['jobs'][$k]->id                = $value->id;
                    $data['jobs'][$k]->job_id            = $value->workshop_job_id;
                    $data['jobs'][$k]->job               = $value->job_code;
                    $data['jobs'][$k]->job_description   = $value->description;
                    // $data['jobs'][$k]->min_price         = $value->id;
                    $data['jobs'][$k]->cost              = ($value->billing_amount)?$value->billing_amount:$value->total_amount;
                    // $data['jobs'][$k]->discount_amount   = $value->billing_discount_percent;
                    $data['jobs'][$k]->discount_percentage     = $value->billing_discount_percent;
                    $data['jobs'][$k]->final_amount      = ($value->billing_final_amount)?$value->billing_final_amount:$value->total_amount;
                    $data['jobs'][$k]->status            = '';
                    $data['jobs'][$k]->ow                = true;
                }

                $this->job_card_model->_table = 'view_service_parts';
                $data['parts'] = $this->job_card_model->findAll( array('jobcard_group' =>  $get['jobcard'], 'estimate_id' => NULL) );
                
                $this->job_card_model->_table = 'ser_billing_record';
                $data['invoice'] = $this->job_card_model->find( array('jobcard_group' =>  $get['jobcard']) );


                $data['header'] = $get['type'];
                $data['module'] = 'dispatch_dealers';
            }
            break;

            default:
            return "Error";
            exit;
            break;
        }
        $this->load->view($this->config->item('template_admin') . $print , $data);

    }

    function get_jobcard_number() {
      $this->db->order_by('jobcard_group','desc');
      $id = $this->job_card_model->find();
      $id = ($id)?++$id->jobcard_group:1;
      echo json_encode($id);
  }

	/*function get_billing_number() {
		$this->db->order_by('id','desc');
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->id:1;
		return $id;
		echo json_encode($id);
	}*/

    function get_vehicles_json() {

        $this->job_card_model->_table = "view_dms_vehicles";
        $fields = 'deleted_at, vehicle_id, vehicle_name';

        $this->db->group_by($fields);
        $rows = $this->job_card_model->findAll(null, $fields);
        
        echo json_encode($rows);
    }

}