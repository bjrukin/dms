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

class Job_card_detail extends Project_Controller
{

	public function __construct()
	{
		parent::__construct();

		control('Job Cards');

		$this->load->model('job_cards/job_card_model');
		$this->lang->load('job_cards/job_card');

		$this->load->library('job_cards/job_card');
		// $this->dealer_id = $this->session->userdata()['employee']['dealer_id'];
	}

	public function index(){
		// $data['jobcard_group'] = $this->input->post('jobcard_group');
		// $data['vehicle_id'] = $this->input->post('vehicle_id');

		// $this->load->view($this->config->item('template_admin') . 'job_detail',$data);
		// $this->load->view($this->config->item('template_admin') . 'job_part_detail',$data);
	}

	public function get_jobs_json() {
		$where['jobcard_group'] = $this->input->post('jobcard_group');
		$data['vehicle_id'] = $this->input->post('vehicle_id');

		$this->job_card_model->_table = "view_service_job_card";

		// paging('id');
		$this->db->order_by('id','desc');

		$rows = $this->job_card_model->findAll($where);

		echo json_encode(array('total' => count($rows), 'rows' => $rows));
	}

	/*public function get_materialissue_floorsupervisor_json() {
		// $where['jobcard_group'] = $this->input->post('jobcard_group');
		$where = array();
		if($this->input->post('jobcard_group')) {
			$where['jobcard_group'] = $this->input->post('jobcard_group');
		}

		$this->job_card_model->_table = 'view_floor_supervisor_advice';
		// $this->job_card_model->_table = 'view_service_parts';

		// $this->db->group_by($fields = 'id, part_name');
		$rows = $this->job_card_model->findAll($where);
		echo json_encode(array('total' => count($rows), 'rows' => $rows));
	}*/

	/*public function get_advice_material() {
		$this->job_card_model->_table = 'mst_spareparts';


		$search_name = strtoupper($this->input->get('name_startsWith'));
		$where["name LIKE '%{$search_name}%'"] = NULL;
		
		$this->db->group_by($fields = 'name')->limit(300);
		$rows = $this->job_card_model->findAll($where, $fields);
		// echo json_encode(array('total' => count($rows), 'rows' => $rows));
		echo json_encode($rows);

	}*/


	public function job_status_change(){
		$data['status'] = $this->input->post('status');
		$data['id'] = $this->input->post('row')['id'];

		$success = $this->job_card->update_status($data);


		echo json_encode(array('success' => $success));
	}

	/*public function part_request_status(){
		$part = $this->input->post();
		$data['id'] = $part['partdata']['id'];
		$data['request_status'] = ($this->input->post('status') == 'true')?1:0;

		$success = $this->job_card->update_status($data,'ser_parts');

		echo json_encode(array('success' => $success));
	}*/

	public function part_recived_status(){
		$part = $this->input->post();

		$data['id'] = $part['partdata']['id'];
		$data['received_status'] = ($this->input->post('status') == 'true')?1:0;
		$success = $this->job_card->update_status($data,'ser_floor_supervisor_advice');

		echo json_encode(array('success' => $success));
	}

	public function set_part_adviced() {

		$this->load->library('form_validation');

		$this->form_validation->set_rules('jobcard_group', 'Jobcard_group', 'required');
		$this->form_validation->set_rules('advice_new_parts', 'Advice_new_parts', 'required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required');

		$post['jobcard_group'] = $this->input->post('jobcard_group');
		$post['advice_new_parts'] = $this->input->post('advice_new_parts');
		$post['quantity'] = $this->input->post('quantity');

		if ($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('success'=> FALSE, 'msg' => "Error: No parts selected"));
			exit;
		}

		// $where = array('name' => $post['advice_new_parts']);

		// $this->job_card_model->_table = "view_spareparts";
		// $row = $this->job_card_model->find($where);
		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$where = array('part_name' => $post['advice_new_parts'],'jobcard_group'=>$post['jobcard_group'], 'dealer_id' => $this->dealer_id);
		$row = $this->job_card_model->find($where);

		if(!$row){
			$data = array(
				'jobcard_group'	=>	$post['jobcard_group'],
				'part_name'		=>	$post['advice_new_parts'],
				'quantity'		=>	$post['quantity'],
				'dealer_id'		=>	$this->dealer_id,
				'total_dispatched'	=>	0,//$post['quantity'],
			);

			$success = $this->job_card_model->insert($data);
		}else{
			$data = array(
				'id'	=>	$row->id,
				'quantity'		=>	$row->quantity + $post['quantity'],
			);

			$success = $this->job_card_model->update($data['id'],$data);
		}

		if($success)
		{
			$rows = $data;
			// $this->job_card_model->_table = "view_floor_supervisor_advice";
			// $rows = $this->job_card_model->findAll(array('jobcard_group'=>$post['jobcard_group']));
			echo json_encode(array('success'=>$success,'data'=>$rows));
		}

	}

	public function get_parts_adviced() {
		$jobcard = $this->input->get('jobcard_group');
		$this->db->group_by('1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26');

		$where['jobcard_group'] = $jobcard;
		$this->job_card_model->_table = "view_floor_supervisor_advice";

		search_params();
		// paging('id');
		$this->db->order_by('id','desc');

		$rows = $this->job_card_model->findAll($where);

		echo json_encode(array('total' => count($rows), 'rows' => $rows));
	}

	public function set_received_quantity() {
		$partdata = $this->input->post('partdata');
		$newvalue = $this->input->post('newvalue');

		if(! $newvalue) {
			echo json_encode(array());
			exit;
		}

		$data = array();
		$data['id'] = $partdata['id'];
		$data['received_quantity'] = $newvalue;

		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$success = $this->job_card_model->update($data['id'], $data);

		echo json_encode(array('success'=>$success));
	}

	public function delete_part_adviced() {
		$row = $this->input->post('row');

		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$success = $this->job_card_model->delete($row['id']);

		echo json_encode(array('success' => $success));
	}

	function set_material_warranty() {
		$data = array(
			'id'	=>	$this->input->post('id'),
			'warranty'	=>	$this->input->post('newvalue'),
		);

		
		exit;

		$this->job_card_model->_table = "ser_material_scan";
		$success = $this->job_card_model->update($data['id'],$data);

		$msg = 'Successful';
		if(!$success) {
			$msg = 'Failure in system, try reload';
		} 

		echo json_encode(array('success'=>$success, 'msg'=>$msg));
	}

	function get_consumable_combo_json() {
		$this->job_card_model->_table = 'mst_spareparts';
		$this->db->where('category_id', LOCAL_PARTS);


		$search_name = strtoupper($this->input->get('name_startsWith'));
		$where["lower(name) LIKE lower('%{$search_name}%') OR lower(part_code) LIKE lower('%{$search_name}%') "] = NULL;
		
		$this->db->limit(100);
		$rows = $this->job_card_model->findAll($where);
		echo json_encode($rows);
	}

	function set_consumables() {
		$part_id = $this->input->post('consumable');
		$quantity = $this->input->post('quantity');
		$consumable_price = $this->input->post('consumable_price');

		$jobcard_group = $this->input->post('jobcard_group');
		if( !$part_id OR !$quantity OR !$consumable_price) {
			echo json_encode(array('success'=> false, 'msg'=> "Empty values provided."));
			exit;
		}

		if( $quantity <= 0) {
			echo json_encode(array('success'=> false, 'msg' => "No quantity provided."));
			exit;
		}

		if($part_id == ULTRA_SYNTHETIC || $part_id == SYNTHETIC || $part_id == NORMAL){
			$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
			$where = array(
				'sparepart_id' => $part_id, 
				'dealer_id'=>$this->dealer_id, 
				'display_quantity >=' => $quantity
			);
			$dealer_stock = $this->job_card_model->find($where);
			if( ! $dealer_stock) {
				echo json_encode(array('success' => false, 'msg' => "Not enough stock."));
				exit;
			}

			$this->job_card_model->_table = "ser_floor_supervisor_advice";
			$where = array(
				'jobcard_group'		=>	$jobcard_group, 
				'upper(part_name)' 	=> 	strtoupper($dealer_stock->name), 
				'dealer_id' 		=> 	$this->dealer_id
			);
			$advicedParts = $this->job_card_model->find($where);
			// echo '<pre>'; print_r($advicedParts); exit;

			if( ! $advicedParts) {
				// insert
				$floordata = array(
					'dealer_id'				=>	$this->dealer_id,
					'jobcard_group'			=>	$jobcard_group,
					'part_name'				=>	$dealer_stock->name,
					'quantity'				=>	0,
					'lube_dispatched_qty'	=>	$quantity,
				);

				$this->job_card_model->_table = "ser_floor_supervisor_advice";
				$floor_advice_id = $this->job_card_model->insert($floordata);
			} else {
				//update
				$floordata = array(
					'id'					=>	$advicedParts->id,
					'lube_dispatched_qty'	=>	$quantity,
				);

				$this->job_card_model->_table = "ser_floor_supervisor_advice";
				$floor_advice_id = $this->job_card_model->update($floordata['id'], $floordata);
			}

			// --- getting material-issue number --- //
			$this->job_card_model->_table = "ser_material_scan";
			$getMaterialId = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
			if( ! $getMaterialId) {
				$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
			}
			// end //


			$data = array(
				'material_issue_no'=> $getMaterialId,
				'issue_date'	=>	date('Y-m-d'),
				'part_id'		=>	$part_id,
				// 'part_code'		=>	part code here,
				'lube_quantity'		=>	$quantity,
				'consumable_price' => $consumable_price,
				'jobcard_group'	=>	$jobcard_group,
				'dealer_id'		=>	$this->dealer_id,
				'is_consumable'	=>	0,
			);

			$this->job_card_model->_table = "ser_material_scan";
			$success = $this->job_card_model->insert( $data);

			/*Stock reduction*/
			$this->job_card_model->_table = 'spareparts_dealer_stock';
			$stock['id'] = $dealer_stock->id;
			$stock['lube_qty'] = $dealer_stock->lube_qty - $quantity;
			if( ENABLE_SERVICE_TESTING == 0) {
				$this->job_card_model->update($stock['id'],$stock);
			}

			$data['id'] = $success;
		}else{

			$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
			$where = array(
				'sparepart_id' => $part_id, 
				'dealer_id'=>$this->dealer_id, 
				'quantity >=' => $quantity
			);
			$dealer_stock = $this->job_card_model->find($where);

			if( ! $dealer_stock) {
				echo json_encode(array('success' => false, 'msg' => "Not enough stock."));
				exit;
			}

			$this->job_card_model->_table = "ser_floor_supervisor_advice";
			$where = array(
				'jobcard_group'		=>	$jobcard_group, 
				'upper(part_name)' 	=> 	strtoupper($dealer_stock->name), 
				'dealer_id' 		=> 	$this->dealer_id
			);
			$advicedParts = $this->job_card_model->find($where);

			if( ! $advicedParts) {
				// insert
				$floordata = array(
					'dealer_id'				=>	$this->dealer_id,
					'jobcard_group'			=>	$jobcard_group,
					'part_name'				=>	$dealer_stock->name,
					'quantity'				=>	0,
					'dispatched_quantity'	=>	1,
				);

				$this->job_card_model->_table = "ser_floor_supervisor_advice";
				$floor_advice_id = $this->job_card_model->insert($floordata);
			} else {
				//update
				$floordata = array(
					'id'					=>	$advicedParts->id,
					'dispatched_quantity'	=>	$advicedParts->dispatched_quantity + 1,
				);

				$this->job_card_model->_table = "ser_floor_supervisor_advice";
				$floor_advice_id = $this->job_card_model->update($floordata['id'], $floordata);
			}



			// --- getting material-issue number --- //
			$this->job_card_model->_table = "ser_material_scan";
			$getMaterialId = $this->job_card_model->find(array('jobcard_group'=>$jobcard_group, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
			if( ! $getMaterialId) {
				$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
			}
			// end //


			$data = array(
				'material_issue_no'=> $getMaterialId,
				'issue_date'	=>	date('Y-m-d'),
				'part_id'		=>	$part_id,
				// 'part_code'		=>	part code here,
				'quantity'		=>	$quantity,
				'consumable_price' => $consumable_price,
				'jobcard_group'	=>	$jobcard_group,
				'dealer_id'		=>	$this->dealer_id,
				'is_consumable'	=>	1,
			);

			$this->job_card_model->_table = "ser_material_scan";
			$success = $this->job_card_model->insert( $data);

			/*Stock reduction*/
			$this->job_card_model->_table = 'spareparts_dealer_stock';
			$stock['id'] = $dealer_stock->id;
			$stock['quantity'] = $dealer_stock->quantity - 1;
			if( ENABLE_SERVICE_TESTING == 0) {
				$this->job_card_model->update($stock['id'],$stock);
			}

			$data['id'] = $success;
		}


		echo json_encode(array('success'=>$success, 'data'=>$data));
	}

	function get_consumable_grid_json() {
		$jobcard_group = $this->input->post('jobcard_group');
		

		$this->job_card_model->_table = 'view_material_scan';
		$rows = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group, 'dealer_id' => $this->dealer_id, 'consumable_price <>' => NULL));


		echo json_encode($rows);
	}




	function get_materialIssue_grid_json() {
		$jobcard_group = $this->input->post('jobcard_group');

		// $this->job_card_model->_table = 'view_material_scan';
		$this->job_card_model->_table = 'view_floor_supervisor_advice';
		$this->db->order_by('created_at, part_name');
		$this->db->group_by('1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26');
		$this->db->where('lube_dispatched_qty IS NULL');
		// $rows = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group, 'dealer_id' => $this->dealer_id, 'is_consumable' => null));
		$rows = $this->job_card_model->findAll(array('jobcard_group'=>$jobcard_group, 'dealer_id' => $this->dealer_id, ));

		echo json_encode($rows);
	}




	function update_floor_voice() {
		$row = $this->input->post('row');
		$floor_voice = $this->input->post('floor_voice');

		$data = array(
			'id'	=>	$row['id'],
			'floor_supervisor_voice'	=>	$floor_voice,
		);

		$this->job_card_model->update($data['id'],$data);
	}

	function set_job_floorsupervisor() {
		if( ! $this->dealer_id) {
			echo json_encode(array('success' => false));
			return;
		}

		$row = $this->input->post('data');

		$this->job_card_model->_table = 'view_report_grouped_jobcard';
		$getServiceAdvisor = $this->job_card_model->find(array('jobcard_group' => $row['jobcard_group']));
		$service_adviser_id = $getServiceAdvisor->service_adviser_id;
		$mechanics_id = $getServiceAdvisor->mechanics_id;



		$this->job_card_model->_table = "ser_job_cards";
		$jobcard_row = $this->job_card_model->find(array('jobcard_group' => $row['jobcard_group']));

		if( ! $jobcard_row){
			echo json_encode(array('success' => false));
			return;
		}
		if( $jobcard_row->closed_status == 1) {
			echo json_encode(array('success' => false));
			return;	
		}

		unset($jobcard_row->id);
		unset($jobcard_row->created_by);
		unset($jobcard_row->updated_by);
		unset($jobcard_row->deleted_by);
		unset($jobcard_row->created_at);
		unset($jobcard_row->updated_at);
		unset($jobcard_row->deleted_at);
		unset($jobcard_row->discount_amount);
		unset($jobcard_row->discount_percentage);
		unset($jobcard_row->customer_voice);
		unset($jobcard_row->advisor_voice);
		unset($jobcard_row->service_adviser_id);

		$jobcard_row->customer_voice = $row['customer_voice'];
		$jobcard_row->floor_supervisor_voice = $row['floor_supervisor_voice'];
		$jobcard_row->job_id = $row['job_id'];
		$jobcard_row->cost = $row['price'];
		$jobcard_row->final_amount = $row['price'];
		$jobcard_row->service_adviser_id = $service_adviser_id;
		$jobcard_row->status = 'Pending';
		$jobcard_row->mechanics_id = $mechanics_id;

		$jobcard_row->id = $this->job_card_model->insert($jobcard_row);
		if($jobcard_row->id) {
			$success = true;
		} else {
			$success = false;
		}

		echo json_encode(array('success' => $success, 'data' => $jobcard_row));
	}

	function confirm_parts_returned() {
		$floor_id = $this->input->post('floor_id');
		$return_quantity = $this->input->post('return_quantity');
		$jobcard = $this->input->post('jobcard');
		$part_code = $this->input->post('part_code');

		$this->db->trans_begin();

 		//reduction in floor table
		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$where = array(
			'id'		=>	$floor_id,
		);
		$floor_data = $this->job_card_model->find($where);

		// $old_return_parts = $floor_data->return_quantity;
		// $dispatched_quantity = $floor_data->total_dispatched - $return_quantity;
		$dispatched_quantity = $floor_data->dispatched_quantity - $return_quantity;
		

		$data = array(
			'id'						=>	$floor_id,
			'returned_status'			=>	0,
			// 'dispatched_quantity'		=>	$floor_data->dispatched_quantity + $old_return_parts - $return_quantity,
			'dispatched_quantity'		=>	$dispatched_quantity,
		);

		$this->job_card_model->_table = "ser_floor_supervisor_advice";
		$this->job_card_model->update($data['id'], $data);
		//reduction in floor table END

		// START reduction in material scan table
		$this->job_card_model->_table = "ser_material_scan";
		$where = array(
			'jobcard_group'			=>	$jobcard,
			'dealer_id'				=>	$this->dealer_id,
			'part_code'				=>	$part_code,
		);
		$material_scan = $this->job_card_model->find($where);
		// echo $this->db->last_query(); 
		// echo '<pre>'; print_r($material_scan); exit;
		$data = array(
			'id'		=>	$material_scan->id,
			'quantity'	=>	$dispatched_quantity,
		);

		$this->job_card_model->_table = "ser_material_scan";
		$this->job_card_model->update($data['id'], $data);
		//reduction in material scan table END


		// if( ENABLE_SERVICE_TESTING == 0) {
		// 	$where = array(
		// 		'sparepart_id'			=>	$material_scan->part_id,
		// 		'dealer_id'				=>	$this->dealer_id,
		// 	);
		// 	$this->job_card_model->_table = "spareparts_dealer_stock";
		// 	$dealer_sparepart = $this->job_card_model->find($where);

		// 	$data = array(
		// 		'id' 			=>	$dealer_sparepart->id,
		// 		'quantity'		=>	$dispatched_quantity,
		// 	);

		// 	$this->job_card_model->_table = "spareparts_dealer_stock";
		// 	$this->job_card_model->update($data['id'], $data);

		// }

		$this->job_card_model->_table = 'spareparts_dealer_stock';
		$where = array(
			'sparepart_id'			=>	$material_scan->part_id,
			'dealer_id'				=>	$this->dealer_id,
		);
		$row = $this->job_card_model->find($where);
		$data = array(
			'id' => $row->id,
			'quantity' => $row->quantity + $return_quantity,
		);
		$this->job_card_model->update($data['id'], $data);

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
		
		echo json_encode(array('success'=>$success));

	}

	public function confirm_sale_return()
	{
		// print_r($_POST);
		// exit();
		$jobcard_group = $this->input->post('jobcard_group');
		$final_price = $this->input->post('final_price');
		$price = $this->input->post('price');
		$dealer_id = $this->input->post('dealer_id');
		$part_id = $this->input->post('part_id');
		$return_quantity = $this->input->post('return_quantity');
		$return_remarks = $this->input->post('return_remarks');
		$return_part_name = $this->input->post('return_part_name');
		$return_price = $price * $return_quantity;


		
		// $return_part_name = $this->input->post('return_part_name'); 
		// $return_quantity = $this->input->post('return_quantity');
		// $return_remarks = $this->input->post('return_quantity');

		$this->db->trans_begin();

		$this->job_card_model->_table = "ser_billing_record";
		$where = array(
			'jobcard_group'		=>	$jobcard_group,
		);
		$floor_data = $this->job_card_model->find($where);
		// print_r($floor_data);
		// exit();

		// $old_return_parts = $floor_data->return_quantity;
		// $dispatched_quantity = $floor_data->total_dispatched - $return_quantity;
		$id = $floor_data->id;
		$total_parts = $floor_data->total_parts - $return_price;
		$billing_id = $floor_data->id;
		

		$data = array(
			'id'						=>	$id,
			// 'returned_status'			=>	0,
			// 'dispatched_quantity'		=>	$floor_data->dispatched_quantity + $old_return_parts - $return_quantity,
			'total_parts'		=>	$total_parts,
		);

		$this->job_card_model->_table = "ser_billing_record";
		$this->job_card_model->update($data['id'], $data);

		$this->job_card_model->_table = "spareparts_dealer_stock";
		$where = array(

			'sparepart_id' => $part_id,
			'dealer_id' => $dealer_id,
		);
		$row = $this->job_card_model->find($where);
		$quantity = $row->quantity + $return_quantity;

		$data = array(
			'id' => $row->id,
			'quantity' => $quantity,
		);

		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->job_card_model->update($data['id'], $data);



		$this->job_card_model->_table = 'ser_billed_parts';
		$where = array(
			'billing_id'			=>	$billing_id,
			'part_id'				=>	$part_id,
		);
		$row = $this->job_card_model->find($where);

		// $parts_price = $row->price - $price;
		$quantity = $row->quantity - $return_quantity;
		$final_amount = $row->final_amount - $return_price;

		$data = array(
			'id' => $row->id,
			// 'price' => $parts_price,
			'quantity' => $quantity,
			'final_amount' => $final_amount,

		);
		$this->job_card_model->update($data['id'], $data);

		$this->job_card_model->_table = 'ser_sale_return';
		$data = array(
				'jobcard_group' => $jobcard_group,
				'billing_id' => $billing_id,
				'part_id' => $part_id,
				'price' => $price,
				'quantity' => $return_quantity,
				'final_amount' => $return_price,
				'remarks' => $return_remarks,
				'part_name' => $return_part_name,
				'type' => 'jobcard',


		);
		$this->job_card_model->insert($data);


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
		
		echo json_encode(array('success'=>$success));
	}

	public function delete_consumable()
	{
		$this->db->trans_begin();
		$where['id'] = $this->input->post('id');
		$this->job_card_model->_table = 'ser_material_scan';
		$record = $this->job_card_model->find($where);

		$success = $this->job_card_model->delete($where['id']);

		if($success){
			$data['quantity'] = $record->quantity;
			$this->job_card_model->_table = "view_spareparts_all_dealer_stock";
			$where = array(
				'sparepart_id' => $record->part_id, 
				'dealer_id'=>$this->dealer_id, 
			);
			$dealer_stock = $this->job_card_model->find($where);
			$new_stock = array(
				'id' => $dealer_stock->id,
				'quantity' => $dealer_stock->quantity + $record->quantity,
			);

			$this->job_card_model->_table = 'spareparts_dealer_stock';
			$this->job_card_model->update($new_stock['id'],$new_stock);
		}

		if ($this->db->trans_status() === FALSE)
		{

		        $this->db->trans_rollback();
		        $result = array('success'=>false);
		}
		else
		{
		        $this->db->trans_commit();
		        $result = array('success'=>true);
		}
		echo json_encode($result);

	}

}