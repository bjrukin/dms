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
 * Counter_sales
 *
 * Extends the Project_Controller class
 * 
 */

class Counter_sales extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Counter Sales');

		$this->load->model('counter_sales/counter_sale_model');
		$this->load->model('job_cards/job_card_model');
		$this->lang->load('counter_sales/counter_sale');
		$this->load->model('user_ledgers/user_ledger_model');

	}

	public function index()
	{
		$data['bill_id'] = $this->get_billing_number();
		// Display Page
		$data['header'] = lang('counter_sales');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'counter_sales';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		if(is_admin()){
			$where = array();
		}
		else if(is_group(SPAREPART_INCHARGE_GROUP) || is_group(703)){
			$stockyard = $this->get_sparepart_stockyard();
			$where['stockyard_id'] = $stockyard->stockyard_id;
		}else{
		// if(is_service_advisor()){
			$where['dealer_id'] = $this->dealer_id;
			// $where['floor_supervisor_id'] = $this->_user_id;
		}
		$this->counter_sale_model->_table = "view_counter_sales";

		$fields = 'id, deleted_at, deleted_by, counter_sales_id, vehicle_no, chasis_no, engine_no, vehicle_id, vehicle_name, variant_id, variant_name, color_id, color_name, party_id, full_name, date_time, is_request_complete, is_countersale_billed, is_countersale_closed, address1 ,dealer_id, invoice_no, payment_type';		
		
		paging('counter_sales_id');
		
		search_params();
		
		$this->db->group_by($fields);
		$rows=$this->counter_sale_model->findAll($where, $fields);

		$total = count($rows);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function invoice($aro = 0)
	{
		$where['id'] = $this->input->get('counter_sale_id');
		$data['workshop'] = $this->get_workshop_name();

		$data['detail'] = $this->counter_sale_model->get_by($where);
		
		$this->counter_sale_model->_table = 'view_countersales_bills';
		$data['parts'] = $this->counter_sale_model->findAll(array('id' => $where['id']));

		$data['invoice'] = array();
		if(count($data['parts']) > 0){
			$data['invoice'] = array(
				'invoice_prefix' => $data['parts'][0]->invoice_prefix,
				'invoice_no' => $data['parts'][0]->invoice_no,
				// 'date' => $data['parts'][0]->date,
				'full_name' => $data['parts'][0]->full_name,
				'engine_no' => $data['parts'][0]->engine_no,
				'chasis_no' => $data['parts'][0]->chasis_no,
				'vehicle_name' => $data['parts'][0]->vehicle_name,
				'variant_name' => $data['parts'][0]->variant_name,
				'total_parts' => $data['parts'][0]->total_parts,
				'cash_discount_percent' => $data['parts'][0]->cash_discount_percent,
				'cash_discount_amt' => $data['parts'][0]->cash_discount_amt,
				'vat_percent' => $data['parts'][0]->vat_percent,
				'vat_parts' => $data['parts'][0]->vat_parts,
				'net_total' => $data['parts'][0]->net_total,
				'aro' => $aro,
			);
		}

		// echo '<pre>';print_r($data); exit;
		$print = 'prints/counter_sales_print';
		$data['header'] = 'Counter Sales';
		$data['module'] = 'counter_sales';

		$this->load->view($this->config->item('template_admin') . $print , $data);
	}

	public function save(){
		if( ! $this->dealer_id) {
			echo "403";
			exit;
		}

		$post = $this->input->post();


		$this->db->trans_begin();


		if( !isset($post['countersales_parts'])) {
			echo json_encode(array('success' => FALSE, 'msg' => 'Empty Values!' ));
			exit;
		}

		if($post['countersales_request']['counter_sales_id']) {
			$counter_sales_id = $post['countersales_request']['counter_sales_id'];
		} else {
			$counter_sales_id = $this->get_counter_sales_number();
		}


		$countersales_request = $this->input->post('countersales_request');
		$countersales_parts = $this->input->post('countersales_parts');

		$data = array(
			'dealer_id'			=>	$this->dealer_id,

			'id'			=>	$this->input->post('countersales_request')['id'],
			'date_time'			=>	$this->input->post('countersales_request')['issue_date'],
			'party_id'			=>	$this->input->post('countersales_request')['credit_account'],

			'vehicle_no'		=>	$this->input->post('countersales_request')['vehicle_no'],
			'chasis_no'			=>	$this->input->post('countersales_request')['engine_no'],
			'engine_no'			=>	$this->input->post('countersales_request')['chassis_no'],
			// 'vehicle_id'		=>	$this->input->post('countersales_request')['vehicle_id'],
			// 'variant_id'		=>	$this->input->post('countersales_request')['variant_id'],
			'counter_sales_id'	=>	$counter_sales_id,
		);
		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});


		$this->counter_sale_model->_table = "ser_counter_sales";
		if( $this->input->post('countersales_request')['id'] ) {
			$counter_id = $data['id'];
			$this->counter_sale_model->update($data['id'], $data);
		} else {
			$counter_id = $this->counter_sale_model->insert($data);
		}



		foreach ($countersales_parts as $key => $value) {
			$data3 = array(
				'part_name'				=>	$value['part_name'],
				'quantity'				=>	$value['quantity'],

				'id'					=>	@$value['countersale_request_id'],
				'dealer_id'				=>	$this->dealer_id,
				'counter_sales_id'		=>	$counter_id,
			);
			$data3 = array_filter($data3, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});

			$this->counter_sale_model->_table = "ser_counter_sales_request";

			if(@$value['countersale_request_id']){
				$this->counter_sale_model->update($data3['id'], $data3);
			} else {
				$this->counter_sale_model->insert($data3);
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$success = false;
			$msg = lang('general_failure');
		}
		else
		{
			$this->db->trans_commit();
			$success = true;
			$msg = lang('general_success');
		}

		echo json_encode(array('success' => $success, 'msg' => $msg));

		exit;

		// $bill_details = array_filter($bill_details, function($value) {
			// return ($value !== null && $value !== false && $value !== ''); 
		// });

		$counter_sales_id = $this->get_counter_sales_number();
		/*Know if its insert or update*/
		

		// Insert countersales table
		$data = array(
			'dealer_id'			=>	$this->dealer_id,

			'date_time'			=>	$this->input->post('bill_details')['issue_date'],
			'party_id'			=>	$this->input->post('bill_details')['credit_account'],

			'vehicle_no'		=>	$this->input->post('bill_details')['vehicle_no'],
			'chasis_no'			=>	$this->input->post('bill_details')['engine_no'],
			'engine_no'			=>	$this->input->post('bill_details')['chassis_no'],
			'vehicle_id'		=>	$this->input->post('bill_details')['vehicle_id'],
			'variant_id'		=>	@$this->input->post('bill_details')['variant_id'],
				// 'color_id'			=>	$bill_details['vehicle_no'],
			'counter_sales_id'	=>	$counter_sales_id,
			// 'billing_record_id'	=>	$billing_record_id,
		);


		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		$this->counter_sale_model->_table = "ser_counter_sales";
		$counter_id = $this->counter_sale_model->insert($data);

		/*Insert data for parts table*/
		foreach ($bill_parts as $key => $value) {
			$data3 = array(
				'jobcard_group'			=>	0,
				'part_id'				=>	$value['part_id'],
				'price'					=>	$value['price'],
				'quantity'				=>	$value['quantity'],
				'discount_percentage'	=>	@$value['discount'],
				'warranty'				=>	@$value['warranty'],
				'final_amount'			=>	$value['total'],
				'bill_id'				=>	$counter_id,
				'counter_request'		=>	0,
			);
			$data3 = array_filter($data3, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});
			$this->counter_sale_model->_table = "ser_parts";
			$success = $this->counter_sale_model->insert($data3);
		}

		echo json_encode(array('success' => $success));
		exit;
	}


	public function get_countersales() {
		$counter_sales_id = $this->input->post('counter_sales_id');

		$this->counter_sale_model->_table = "view_counter_sales";
		$this->db->where('dealer_id', $this->dealer_id);
		$rows = $this->counter_sale_model->findAll(array('counter_sales_id' => $counter_sales_id));

		if($rows) {
			$success = true;
		} else {
			$success = false;
		}

		echo json_encode(array('success' => $success, 'data' => $rows));

	}

	public function get_countersales_request() {
		$counter_sales_id = $this->input->get('counter_sales_id');

		$this->counter_sale_model->_table = "view_counter_sales";
		$this->db->where('dealer_id', $this->dealer_id);
		$rows = $this->counter_sale_model->findAll(array('counter_sales_id' => $counter_sales_id));

		if($rows) {
			$success = true;
		} else {
			$success = false;
		}

		echo json_encode(array('success' => $success, 'data' => $rows));

	}
	public function get_countersales_toBill() {
		$counter_sales_id = $this->input->get('counter_sales_id');

		$this->counter_sale_model->_table = "view_countersales_material_issue";
		$this->db->where('dealer_id', $this->dealer_id);
		$rows = $this->counter_sale_model->findAll(array('countersales_id' => $counter_sales_id));
		// echo $this->db->last_query(); exit;
		if($rows) {
			$success = true;
		} else {
			$success = false;
		}

		echo json_encode(array('success' => $success, 'data' => $rows));
	}

	public function get_countersales_billed() {
		$counter_sales_id = $this->input->get('counter_sales_id');

		$this->counter_sale_model->_table = "view_countersales_bills";
		$this->db->where('dealer_id', $this->dealer_id);
		$rows = $this->counter_sale_model->findAll(array('counter_sales_id' => $counter_sales_id));
		// echo $this->db->last_query(); exit;
		if($rows) {
			$success = true;
		} else {
			$success = false;
		}

		echo json_encode(array('success' => $success, 'data' => $rows));	
	}

	function counter_request_json($type) {
		$post = $this->input->post();

		$data['id'] = $post['partdata']['ser_parts_id'];


		if($type == 'new_quantity') {
			if(! $post['newvalue']) {
				echo json_encode(array());
				exit;
			}

			/*if(! is_int($post['newvalue'])) {
				echo json_encode(array());
				exit;
			}*/

			$data['accepted_quantity'] = $post['newvalue']; 

		} else {

			if($post['newvalue'] == 'true') {
				$data['counter_request']	=	1;

			} else {
				$data['counter_request']	=	0;

			}
		}

		$this->counter_sale_model->_table = "ser_parts";
		$success = $this->counter_sale_model->update($data['id'], $data);

		echo json_encode(array('success'=>$success));
	}

	function counter_request_submit() {
		$id = $this->input->post('id');
		$countersales_id = $this->input->post('countersales_id');

		//check if all tickbox are available
		$this->counter_sale_model->_table = "view_counter_sales";
		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('counter_request', 0);
		$check_available = $this->counter_sale_model->find(array('counter_sales_id' => $countersales_id,));

		if($check_available) {
			//must have all ticked
			echo json_encode(array('success' => false));
			exit;
		}

		$this->counter_sale_model->_table = "view_counter_sales";
		$this->db->where('dealer_id', $this->dealer_id);
		$check_available = $this->counter_sale_model->find(array('counter_sales_id' => $countersales_id));

		$data = array(
			'id' =>	$check_available->id,
			'is_request_complete'	=> 1,
		);
		$this->counter_sale_model->_table = "ser_counter_sales";
		$success = $this->counter_sale_model->update($data['id'], $data);

		echo json_encode(array('success' => $success));
	}

	function countersales_new_quantity() {
		$post = $this->input->post();

		$data = array(
			'id'	=>	$post['id'],
			'quantity_to_bill'	=>	$post['quantity'],
			'final_amount'		=>	$post['total'],
		);

		$this->counter_sale_model->_table = "ser_parts";
		$success = $this->counter_sale_model->update($data['id'], $data);
		echo json_encode(array('success' => $success));
	}

	function save_bill_countersale() {

		$issuedParts = $this->input->post('issuedParts');
		foreach($issuedParts as $key=>$value){
			$material['quantity'] = $value['quantity'];
			$material['id'] = $value['uid'];
			$this->job_card_model->_table = "ser_material_scan";
			$this->job_card_model->update($material['id'],$material);
		}

		
		$counter_sales_id = $this->input->post('counter_sales_id');

		$this->db->where('dealer_id', $this->dealer_id);
		$countersale = $this->counter_sale_model->find(array('counter_sales_id' => $counter_sales_id));

		$data = array(
			'id'		=>	$countersale->id,
			'is_request_complete'	=>	1,
			'is_countersale_closed'	=>	1,
		);

		$success = $this->counter_sale_model->update($data['id'], $data);

		echo json_encode(array('success' => $success, 'msg' => lang('general_success')));
	}

	public function print_bill_countersale()
	{
		$where['id'] = $this->input->get('id');
		$data['workshop'] = $this->get_workshop_name();

		$data['detail'] = $this->counter_sale_model->get_by($where);
		
		$this->counter_sale_model->_table = 'view_counter_billing';
		$data['parts'] = $this->counter_sale_model->find_all_by('id',$where['id']);

		$data['invoice'] = array();
		if(count($data['parts']) > 0){
			$data['invoice'] = array(
				'invoice_prefix' => $data['parts'][0]->invoice_prefix,
				'invoice_no' => $data['parts'][0]->invoice_no,
				// 'date' => $data['parts'][0]->date,
				'full_name' => $data['parts'][0]->full_name,
				'engine_no' => $data['parts'][0]->engine_no,
				'chasis_no' => $data['parts'][0]->chasis_no,
				'vehicle_name' => $data['parts'][0]->vehicle_name,
				'variant_name' => $data['parts'][0]->variant_name,
				'total_parts' => $data['parts'][0]->total_parts,
				'cash_discount_percent' => $data['parts'][0]->cash_discount_percent,
				'cash_discount_amt' => $data['parts'][0]->cash_discount_amt,
				'vat_percent' => $data['parts'][0]->vat_percent,
				'vat_parts' => $data['parts'][0]->vat_parts,
				'net_total' => $data['parts'][0]->net_total,
			);
		}

		// echo '<pre>';print_r($data);
		$print = 'prints/counter_sales_print';
		$data['header'] = 'Counter Sales';
		$data['module'] = 'counter_sales';
		$this->load->view($this->config->item('template_admin') . $print , $data);

	}

	public function set_countersales_barcode()
	{
		if( ! $this->dealer_id) {
			echo "403 Forbidden";
			exit;
		}

		$counter_sales_id = $this->input->post('counter_sales_id');
		$barcode = $this->input->post('parts');

		$where['part_code'] = $barcode;
		$where['dealer_id'] = $this->dealer_id;

		$data = array();
		$this->counter_sale_model->_table = 'view_spareparts_all_dealer_stock';
		$this->db->where('quantity >',0);
		$dealer_stock = $this->counter_sale_model->get_by($where);
		// echo $this->db->last_query(); exit;?

		if(count((array)$dealer_stock) > 0){
			$stock['id'] = $dealer_stock->id;
			$stock['quantity'] = $dealer_stock->quantity - 1;

			if($dealer_stock->quantity < 0){
				$data['success'] = FALSE;
				$data['msg'] = "You don't have enough stock";
				echo json_encode($data);
				exit;

			} else{
				
		// echo "<pre>asdf"; print_r($dealer_stock);exit;
				/*$where = array();
				$where['counter_sales_id'] = $counter_sales_id;
				$where['dealer_id'] = $this->dealer_id;
				$this->counter_sale_model->_table = 'view_counter_sales';
				$countersales = $this->counter_sale_model->find($where);

				if( ! $countersales->is_countersale_closed) {
					$data['success'] = false;
					$data['msg'] = "Countersales not closed";
					echo json_encode($data);
					exit;
				}*/

				/*$where = array();
				$where['part_id'] = $dealer_stock->sparepart_id;
				$where['bill_id'] = $countersales->id;
				$this->counter_sale_model->_table = 'ser_parts';
				$req = $this->counter_sale_model->get_by($where);

				if(count((array)$req) > 0){
					if( (int)$req->issue_quantity < (int)$req->quantity_to_bill && (int)$req->quantity_to_bill != null){*/

						/*Material Scan Table */
						$this->job_card_model->_table = "view_material_scan";
						$scannedParts = $this->job_card_model->find(array('countersales_id'=> $counter_sales_id, 'part_code' => $barcode, 'dealer_id' => $this->dealer_id));

						if($scannedParts) {
							$data = array(
								'id'			=>	$scannedParts->id,
								'issue_date'	=>	date('Y-m-d'),
								'quantity'		=>	$scannedParts->other_quantity + 1,
								'material_issue_no'=>$scannedParts->material_issue_no,
							);
							$this->job_card_model->_table = "ser_material_scan";
							$success = $this->job_card_model->update($data['id'], $data);
							$data['updated'] = true;


							//Setting request as complete
							$this->counter_sale_model->_table = 'ser_counter_sales';
							$countersales = $this->counter_sale_model->find(array('counter_sales_id' => $counter_sales_id, 'dealer_id' => $this->dealer_id));
							$req = array(
								'id'	=>	$countersales->id,
								'is_request_complete' =>	0,
							);
							$this->counter_sale_model->update($req['id'], $req);

						} else {
							// --- getting material-issue number --- //
							$getMaterialId = $this->job_card_model->find(array('countersales_id'=>$counter_sales_id, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
							if( ! $getMaterialId) {
								$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
							}
							// end //

							$data = array(
								'dealer_id'	 				=> 	$this->dealer_id,
								'countersales_id'			=>	$counter_sales_id,
								'part_id'                   =>  $dealer_stock->sparepart_id,
								'part_code'					=>	$barcode,
								'issue_date'				=>	date('Y-m-d'),
								'quantity'					=>	1,
								'material_issue_no'			=>	$getMaterialId,
							);

							$this->job_card_model->_table = "ser_material_scan";
							$success = $this->job_card_model->insert($data);
							$data['updated'] = false;
						}
						/*Material Scan Table end*/



						/*$req_data['issue_quantity'] = $req->issue_quantity + 1;
						$req_data['id'] = $req->id;
						$data['success'] = $this->counter_sale_model->update($req_data['id'],$req_data);*/


						// $data['part_id'] = $dealer_stock->sparepart_id;
						// $data['part_name'] = $dealer_stock->name;
						// $data['part_code'] = $barcode;

						$data['success'] = TRUE;
						$this->counter_sale_model->_table = 'spareparts_dealer_stock';
						if( ENABLE_SERVICE_TESTING == 0 ){
							$this->counter_sale_model->update($stock['id'],$stock);
						}
					/*}else{
						$data['success'] = FALSE;
						$data['msg'] = "Now you cannot add this item";
					}*/
				/*}else{
					$data['success'] = FALSE;
					$data['msg'] = "This item is not in request";
				}*/
			}
		}else{
			$data['success'] = FALSE;
			$data['msg'] = "You don't have this item";
		}

		echo json_encode($data);

	}

		public function confirm_countersale_return()
	{
		// print_r($_POST);
		// exit();
		$counter_sales_id = $this->input->post('counter_sales_id');
		$final_price = $this->input->post('final_price');
		$price = $this->input->post('price');
		$part_id = $this->input->post('part_id');
		$dealer_id = $this->input->post('dealer_id');
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
			'counter_sales_id'		=>	$counter_sales_id,
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

		$this->job_card_model->_table = 'spareparts_dealer_stock';
		$where = array(
			'sparepart_id'			=>	$part_id,
			'dealer_id'				=>	$dealer_id,
		);
		$row = $this->job_card_model->find($where);

		$quantity = $row->quantity + $return_quantity;

		$data = array(
			'id' => $row->id,
			'quantity' => $quantity,

		);
		// echo '<pre>';
		// print_r($data);
		// exit();
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
				'counter_sales_id' => $counter_sales_id,
				'billing_id' => $billing_id,
				'part_id' => $part_id,
				'price' => $price,
				'quantity' => $return_quantity,
				'final_amount' => $return_price,
				'remarks' => $return_remarks,
				'type' => 'counter',
				'part_name' => $return_part_name,


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

	function create_bill_countersales() {
		$post = $this->input->post('data');
		// print_r($post);
		// exit();
		$parts = $this->input->post('parts');
		$this->db->trans_begin();

		$countersale_no = $post['countersale_no'];

		$this->db->where('dealer_id', $this->dealer_id);
		$countersales = $this->counter_sale_model->find(array('counter_sales_id' => $countersale_no));

		if($countersales) {
			if($countersales->is_countersale_billed) {
				return "Billed";
				exit;
			}
		}

		$this->counter_sale_model->_table = "ser_billing_record";
		// $this->db->where('dealer_id', $this->dealer_id);
		$this->db->order_by('invoice_no desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$invoice_no = $this->counter_sale_model->find();
		$invoice_no = ($invoice_no)?++$invoice_no->invoice_no:1;

		//To insert into billing table
		$data = array(
			'jobcard_group'	=>	0,
			'dealer_id'			=>	$this->dealer_id,
			'counter_sales_id'	=>	$countersale_no,
			'bill_type'				=>	'counter',
			// 'payment_type'				=>	'cash',
			'issue_date'			=> 	date('Y-m-d H:i:s'),
			'total_parts'			=>	$post['total_for_parts'],
			'cash_discount_percent'	=>	$post['cash_discount_percent'],
			'cash_discount_amt'		=>	(float)$post['cash_discount_amt'],
			'vat_percent'			=>	$post['vat'],
			'vat_parts'				=>	$post['vat_parts'],
			'net_total'				=>	$post['net_total'],
			'invoice_no'			=>	$invoice_no,
			'fiscal_year_id'		=>	$this->fiscal_year_id[0],
			'payment_type'			=>	(isset($post['payment_type']))?$post['payment_type']:'cash',
		);
		
		$this->counter_sale_model->_table = "ser_billing_record";
		$bill_id = $this->counter_sale_model->insert($data);

		/* To insert into billed parts table */
		$data = array();
		foreach ($parts as $key => $value) {
			$data[] = array(
				'billing_id'		=>	$bill_id,
				'part_id'			=>	$value['part_id'],
				'price'				=>	$value['price'],
				'quantity'			=>	$value['quantity'],
				'discount_percentage'=> @$value['discount_percentage'],
				'final_amount'		=>	$value['total'],
				'warranty'			=>	$value['warranty']
			);
		}
		foreach ($data as $key => &$billpart) {
			$billpart = array_filter($billpart, function($v) {
				return ($v !== null && $v !== false && $v !== ''); 
			});
		}

		$this->counter_sale_model->_table = "ser_billed_parts";
		$success = $this->counter_sale_model->insert_many( $data );

		/* Updating the value about bill */
		$data = array(
			'id'						=>	$post['counter_sales_id'],
			'billing_record_id'			=>	$bill_id,
			'is_countersale_billed'		=>	1,
		);

		$this->counter_sale_model->_table = "ser_counter_sales";
		$success = $this->counter_sale_model->update($data['id'], $data);

		/*$returndata = array(
			'id'			=>	$countersales->id,
			'invoice_no'	=>	$invoice_no,
			'bill_id'		=>	$bill_id,
		);*/

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$success = false;
			$msg = lang('general_failure');
		}
		else
		{
			$this->db->trans_commit();
			$success = true;
			$msg = lang('general_success');
		}

		echo json_encode(array('success' => $success, 'msg' => $msg));

	}

	function create_gatepass() {
		$counter_sales_id = $this->input->get('counter_sales_id');

		$data['workshop'] = $this->get_workshop_name();

		$this->job_card_model->_table = 'view_gatepass_countersales';
		$where = array(
			'counter_sales_id' => $counter_sales_id,
			'dealer_id'	=>	$this->dealer_id,
		);
		$gatepass = $this->job_card_model->find($where);

		if($gatepass){
			$data['gatepass']['id'] = $gatepass->id;
			$data['gatepass']['gatepass_no'] = $gatepass->gatepass_no;
			$data['gatepass']['date'] = $gatepass->date;
		}
		else{
			//get new gatepass no
			$this->db->order_by('gatepass_no desc');
			$this->db->where('dealer_id', $this->dealer_id);
			$this->job_card_model->_table = 'ser_gatepass';
			$gatepass_no = $this->job_card_model->find(array());
			$gatepass_no = ($gatepass_no)?++$gatepass_no->gatepass_no:1;

			$save_data = array(
				'counter_sales_id'		=>	$counter_sales_id,
				'date'				=>	date('Y-m-d'),
				'dealer_id'			=>	$this->dealer_id,
				'gatepass_no'		=>	$gatepass_no,
			);
			$this->job_card_model->_table = 'ser_gatepass';
			$id = $this->job_card_model->insert($save_data);

			$gatepass = $this->job_card_model->find($where);

			$data['gatepass']['id'] = $id;
			$data['gatepass']['gatepass_no'] = "GP-". sprintf('%05d',$gatepass_no);
			$data['gatepass']['date'] = $save_data['date'];
		}

		$data['gatepass']['invoice_no'] = "TI-". sprintf('%05d', $gatepass->invoice_no);
		$data['counter_sales_id'] = "CS-". sprintf('%05d', $counter_sales_id);
		$data['header'] = "CounterSales Gatepass";

		$print = "prints/counter_gatepass";
		$this->load->view($this->config->item('template_admin') . $print , $data);

	}

	public function json_material_issue() {
		$this->counter_sale_model->_table = "view_countersales_material_issue";
		
		paging('countersales_id');
		
		search_params();
		
		$where['dealer_id'] = $this->dealer_id;
		$where['countersales_id'] = $this->input->get('counter_sales_id');


		$rows=$this->counter_sale_model->findAll($where);

		$total = count($rows);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	public function json_material_request() {
		$this->counter_sale_model->_table = "view_counter_sales";
		
		paging('counter_sales_id');
		
		search_params();
		
		$where['dealer_id'] = $this->dealer_id;
		$where['counter_sales_id'] = $this->input->get('counter_sales_id');

		$rows=$this->counter_sale_model->findAll($where);

		$total = count($rows);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	
	public function upload_index()
	{
		$data['bill_id'] = $this->get_billing_number();
		// Display Page
		$data['header'] = lang('counter_sales');
		$data['page'] = $this->config->item('template_admin') . "upload_index";
		$data['module'] = 'counter_sales';
		$this->load->view($this->_container,$data);
	}

	function upload_counter_sales(){
        $result = $this->upload_file('./uploads/excel_imports/counter_sales/');
        // echo '<pre>'; print_r($result); exit;
    	if($result['success']){
    		$data = $result['data'];
    		$index = array('sn','part_code','quantity','date','dealer_id');
    		$raw_data = $this->read_file($data,$index);

    		$raw_data_field = array('part_code'=>'part_code','quantity'=>'quantity','date'=>'date','dealer_id'=>'dealer_id');
    		$database_field = array('id'=>'part_id','name'=>'part_name');


    		$result = $this->get_final_excel_data($raw_data, 'part_code','part_code','mst_spareparts',$raw_data_field,$database_field);

	        // echo '<pre>';
    		// if($result['unknown_count'] == 0){
    			// echo '<pre>';
    			$first_key  = key($result['data']);
    			$this->db->trans_start();
    			$counter_sales_id = $this->get_counter_sales_number();
	       		$counter_data = array(
					'dealer_id'			 		=> $result['data'][$first_key]['dealer_id'],
					// 'id'				 		=> $this->input->post('countersales_request')['id'],
					'date_time'			 		=> $result['data'][$first_key]['date'],
					'counter_sales_id'	 		=> $counter_sales_id,
					'is_request_complete'		=> 1,
					'is_countersale_billed' 	=> 1,
					'is_countersale_closed' 	=> 1,
				);
				// print_r($counter_data);
				$this->counter_sale_model->_table = "ser_counter_sales";
				$counter_id = $this->counter_sale_model->insert($counter_data);
		       	
		       	foreach ($result['data'] as $key => $value) {
		       		// print_r($value);
		       		// foreach ($countersales_parts as $key => $value) {
						$data = array(
							'part_name'				=>	$value['part_name'],
							'quantity'				=>	$value['quantity'],
							// 'id'					=>	@$value['countersale_request_id'],
							'dealer_id'				=>	$this->dealer_id,
							'counter_sales_id'		=>	$counter_id,
						);
						$data = array_filter($data, function($value) {
							return ($value !== null && $value !== false && $value !== ''); 
						});

						$this->counter_sale_model->_table = "ser_counter_sales_request";

						if(@$value['countersale_request_id']){
							$this->counter_sale_model->update($data['id'], $data);
						} else {
							$this->counter_sale_model->insert($data);
						}
					// }
		       	}
				if ($this->db->trans_status() === FALSE)
				{
				        $this->db->trans_rollback();
				        echo 'failed';
				        // header('Location: '.$site_url('/admin/counter_sales/upload_index'));
				}
				else
				{
						echo 'success';
				        $this->db->trans_commit();
				}

    // 		}else{
				// // Display Page
				// $result['header'] = lang('counter_sales');
				// $result['page'] = $this->config->item('template_admin') . "unknown_import_list";
				// $result['module'] = 'counter_sales';
				// $this->load->view($this->_container,$result);
    // 		}


       	}else{
       		print_r($result);
       	}
    }

    public function upload_file($path = NULL)
    {
    	$config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $result['error'] = array('error' => $this->upload->display_errors());
            $result['success'] = FALSE;
        } else {
            $result['data'] = array('upload_data' => $this->upload->data());
            $result['success'] = TRUE;
        }
        return $result;
    }

    public function read_file($data,$index)
    {
    	$file = FCPATH . 'uploads/excel_imports/counter_sales/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];

        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line

        
     
        $raw_data = array();
        $data = array();
        $view_data = array();
        $count = count($index);
        $max_col = 'A';
        for ($i=0; $i < $count-1; $i++) { 
        	$max_col++;
        }
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $max_col;//$worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
               // print_r($highestColumnIndex);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($cell)) {
                            $val = date($format = "Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($val));
                        }
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
        return $raw_data;
    }

    /*
    $raw_data = array of data to be checked
    $table_field = field of database to be checked
    $data_fiekd = field in raw_data to be compared
    $table = table to be checked
    */
    public function get_final_excel_data($raw_data,$table_field,$data_field,$table,$raw_data_field,$database_field)
    {
    	$this->counter_sale_model->_table = $table;
    	$result['unknown_count'] = 0;
    	foreach ($raw_data as $key => $value) {
    		$where[$table_field] = $value[$data_field];
    		$data = $this->counter_sale_model->find($where);
    		if($data){
    			foreach ($raw_data_field as $index => $val) {
    				$result['data'][$key][$index] = $value[$val];
    			}
    			foreach ($database_field as $index => $val) {
    				$data_array = (array)$data;
    				$result['data'][$key][$val] = $data_array[$index];
    			}
    		}else{
    			$result['unknown_data'][]=$value;
    			$result['unknown_count']++;
    		}
    	}
    	return $result;
    }

    public function aro()
    {
    	$data['bill_id'] = $this->get_billing_number();

		// Display Page
		$data['header'] = lang('counter_sales');
		$data['page'] = $this->config->item('template_admin') . "aro";
		$data['module'] = 'counter_sales';
		$this->load->view($this->_container,$data);
    }

    /*
    check the stock of given dealer
    */
    public function check_stock()
    {
    	
		$this->counter_sale_model->_table = 'view_spareparts_all_dealer_stock';
    	$where = array(
    		'dealer_id' => $this->dealer_id,
    		'part_code' => $this->input->post('part_code'),
    	);
		$stock = $this->counter_sale_model->find($where);
    	if($stock){
    		if($stock->quantity >= $this->input->post('quantity')){
    			$success = true;
    			$msg = '';
    		}else{
    			$success = false;
    			$msg = 'Not enough stock';
    		}
    	}else{
			$success = false;
			$msg = 'Stock not found';
    	}
    	
    	echo json_encode(array('success'=>$success,'msg'=>$msg));
    }

    public function aro_save()
    {

    	if( !$this->dealer_id && !is_group(SPAREPART_INCHARGE_GROUP) && !is_group(703)) {
			echo "403";
			exit;
		}

		$post = $this->input->post();

		if(is_group(SPAREPART_INCHARGE_GROUP) || is_group(703)){
			$this->stockyard_counter_sale($post);
			exit;
			// $stockyard = $this->get_sparepart_stockyard();
			// $data = array(
			// 	'stockyard_id'		=>	$stockyard->stockyard_id,

			// 	'id'				=>	$this->input->post('countersales_request')['id'],
			// 	'date_time'			=>	$this->input->post('countersales_request')['issue_date'],
			// 	'party_id'			=>	$this->input->post('countersales_request')['credit_account'],
			// 	'price_option'		=>	@$this->input->post('countersales_request')['price_option'],

			// 	'counter_sales_id'	=>	$counter_sales_id,
			// 	// 'vro'				=> 	@$this->input->post('countersales_request')['vor'],
			// );


		}else{
			$this->db->trans_begin();


		if( !isset($post['countersales_parts'])) {
			echo json_encode(array('success' => FALSE, 'msg' => 'Empty Values!' ));
			exit;
		}

		if($post['countersales_request']['counter_sales_id']) {
			$counter_sales_id = $post['countersales_request']['counter_sales_id'];
		} else {
			$counter_sales_id = $this->get_counter_sales_number();
		}


		$countersales_request = $this->input->post('countersales_request');
		$countersales_parts = $this->input->post('countersales_parts');


		$data = array(
			'dealer_id'			=>	$this->dealer_id,

			'id'				=>	$this->input->post('countersales_request')['id'],
			'date_time'			=>	$this->input->post('countersales_request')['issue_date'],
			'party_id'			=>	$this->input->post('countersales_request')['credit_account'],
			'price_option'		=>	@$this->input->post('countersales_request')['price_option'],

			'counter_sales_id'	=>	$counter_sales_id,
			// 'vro'				=> 	@$this->input->post('countersales_request')['vor'],
		);
		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});


		$this->counter_sale_model->_table = "ser_counter_sales";
		if( $this->input->post('countersales_request')['id'] ) {
			$counter_id = $data['id'];
			$this->counter_sale_model->update($data['id'], $data);
		} else {
			$counter_id = $this->counter_sale_model->insert($data);
		}

		$this->counter_sale_model->_table = "ser_billing_record";
		// $this->db->where('dealer_id', $this->dealer_id);
		$this->db->order_by('invoice_no desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$invoice_no = $this->counter_sale_model->find();
		$invoice_no = ($invoice_no)?++$invoice_no->invoice_no:1;

		//To insert into billing table
		$invoice_data = array(
			'jobcard_group'	=>	0,
			'dealer_id'			=>	$this->dealer_id,
			'counter_sales_id'	=>	$counter_sales_id,

			'bill_type'				=>	'counter',
			'payment_type'			=>	'cash',
			'issue_date'			=> 	date('Y-m-d H:i:s'),
			'total_parts'			=>	$this->input->post('countersales_request')['total_for_parts'],
			'cash_discount_percent'	=>	($this->input->post('countersales_request')['cash_discount_percent'])?$this->input->post('countersales_request')['cash_discount_percent']:0,
			'cash_discount_amt'		=>	(float)$this->input->post('countersales_request')['cash_discount_amt'],
			'vat_percent'			=>	$this->input->post('countersales_request')['vat'],
			'vat_parts'				=>	$this->input->post('countersales_request')['vat_parts'],
			'net_total'				=>	$this->input->post('countersales_request')['net_total'],
			'invoice_no'			=>	$invoice_no,
			'fiscal_year_id'		=>	$this->fiscal_year_id[0],
			'dealer_total_for_parts'=>	$this->input->post('countersales_request')['dealer_total_for_parts'],
			'vro'					=>	@$this->input->post('countersales_request')['vro'],
		);
		
		$this->counter_sale_model->_table = "ser_billing_record";
		$bill_id = $this->counter_sale_model->insert($invoice_data);

		foreach ($countersales_parts as $key => $value) {

			$data3 = array(
				'part_name'				=>	$value['part_name'],
				'part_code'				=>	$value['part_code'],
				'quantity'				=>	$value['quantity'],

				'id'					=>	@$value['countersale_request_id'],
				'dealer_id'				=>	$this->dealer_id,
				'counter_sales_id'		=>	$counter_id,
			);
			$data3 = array_filter($data3, function($value) {
				return ($value !== null && $value !== false && $value !== ''); 
			});

			$this->counter_sale_model->_table = "ser_counter_sales_request";

			if(@$value['countersale_request_id']){
				$this->counter_sale_model->update($data3['id'], $data3);
			} else {
				$this->counter_sale_model->insert($data3);
			}

			// reducing stock and generating bill
			$where['part_code'] = $value['part_code'];
			$where['dealer_id'] = $this->dealer_id;

			$data_material_scan = array();
			$this->counter_sale_model->_table = 'view_spareparts_all_dealer_stock';
			$this->db->where('quantity >',0);
			$dealer_stock = $this->counter_sale_model->get_by($where);
			$stock['id'] = $dealer_stock->id;
			$stock['quantity'] = $dealer_stock->quantity - $value['quantity'];

			$this->job_card_model->_table = "view_material_scan";
			$scannedParts = $this->job_card_model->find(array('countersales_id'=> $counter_id, 'part_code' => $value['part_code'], 'dealer_id' => $this->dealer_id));

			if($scannedParts) {
				$data_material_scan = array(
					'id'			=>	$scannedParts->id,
					'issue_date'	=>	date('Y-m-d'),
					'quantity'		=>	$scannedParts->quantity + 1,
					'material_issue_no'=>$scannedParts->material_issue_no,
				);
				$this->job_card_model->_table = "ser_material_scan";
				$success = $this->job_card_model->update($data_material_scan['id'], $data_material_scan);
				$data_material_scan['updated'] = true;


				//Setting request as complete
				$this->counter_sale_model->_table = 'ser_counter_sales';
				$countersales = $this->counter_sale_model->find(array('counter_sales_id' => $counter_id, 'dealer_id' => $this->dealer_id));
				$req = array(
					'id'	=>	$countersales->id,
					'is_request_complete' =>	0,
				);
				$this->counter_sale_model->update($req['id'], $req);

			} else {
				// --- getting material-issue number --- //
				$getMaterialId = $this->job_card_model->find(array('countersales_id'=>$counter_id, 'dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0) as material_no')->material_no;
				if( ! $getMaterialId) {
					$getMaterialId = $this->job_card_model->find(array('dealer_id'=>$this->dealer_id), 'COALESCE( max(material_issue_no),0)+1 as material_no')->material_no;
				}
				// end //

				$data_material_scan = array(
					'dealer_id'	 				=> 	$this->dealer_id,
					'countersales_id'			=>	$counter_sales_id,
					'part_id'                   =>  $dealer_stock->sparepart_id,
					'part_code'					=>	$value['part_code'],
					'issue_date'				=>	date('Y-m-d'),
					'quantity'					=>	$value['quantity'],
					'material_issue_no'			=>	$getMaterialId,
				);

				$this->job_card_model->_table = "ser_material_scan";
				$success = $this->job_card_model->insert($data_material_scan);
				$data_material_scan['updated'] = false;
			}
			/*Material Scan Table end*/
			// billing
			
			$material['quantity'] = $value['quantity'];
			$material['id'] = $success;
			$this->job_card_model->_table = "ser_material_scan";
			$this->job_card_model->update($material['id'],$material);

			// end of billing

			$this->counter_sale_model->_table = 'spareparts_dealer_stock';
			if( ENABLE_SERVICE_TESTING == 0 ){
				$this->counter_sale_model->update($stock['id'],$stock);
			}

			// end of stock reduction

			/* To insert into billed parts table */
			$bill_part_data = array(
				'billing_id'		=>	$bill_id,
				'part_id'			=>	$dealer_stock->sparepart_id,
				'price'				=>	$value['price'],
				'quantity'			=>	$value['quantity'],
				'discount_percentage'=> @$value['discount_percentage'],
				'final_amount'		=>	$value['total'],
				'warranty'			=>	@$value['warranty'],
				'dealer_price'		=> 	($value['dealer_price'])?$value['dealer_price']:0,
				'dealer_price_total'=> 	$value['dealer_price_total'],
			);
			$this->counter_sale_model->_table = "ser_billed_parts";
			$success = $this->counter_sale_model->insert( $bill_part_data );
		}

		$update_counter_sales['id'] = $counter_id;
		$update_counter_sales['is_request_complete'] = 1;
		$update_counter_sales['is_countersale_billed'] = 1;
		$update_counter_sales['is_countersale_closed'] = 1;
		$update_counter_sales['billing_record_id'] = $bill_id;
		$this->job_card_model->_table = 'ser_counter_sales';
		$this->job_card_model->update($update_counter_sales['id'],$update_counter_sales);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$success = false;
			$msg = lang('general_failure');
		}
		else
		{
			$this->db->trans_commit();
			$success = true;
			$msg = lang('general_success');
		}

		echo json_encode(array('success' => $success, 'msg' => $msg));

		exit;
		}
		
    }

    public function update_dispatch_quantity()
    {
    	$id = $this->input->post('id');
    	$quantity = $this->input->post('quantity');

    	$this->counter_sale_model->_table = 'ser_material_scan';
    	$where['id'] = $id;
    	$old_record = $this->counter_sale_model->find($where);
		$previous_quantity = $old_record->quantity;
    	// echo '<pre>';
    	// print_r($old_record);

    	$this->counter_sale_model->_table = 'spareparts_dealer_stock';
    	$where = array(
    		'dealer_id' => $old_record->dealer_id,
    		'sparepart_id' => $old_record->part_id
    	);
    	// $fields = 'SUM(quantity) as quantity';
    	$dealer_stock = $this->counter_sale_model->find_all($where);
    	$stock_quantity = 0;
    	foreach ($dealer_stock as $key => $value) {
    		$stock_record = $value->quantity;
    	}
    	// print_r($stock_record);

    	$added_quantity = $quantity - $previous_quantity;

    	if($added_quantity > $stock_record){
    		$success = false;
    		$msg = 'Stock is less than required quantity';
    	}else{
    		// update stock and scan material table
    		$data = array(
				'id'			=>	$old_record->id,
				'issue_date'	=>	date('Y-m-d'),
				'quantity'		=>	$quantity,
				'material_issue_no'=>$old_record->material_issue_no,
			);
			$this->job_card_model->_table = "ser_material_scan";
			$success = $this->job_card_model->update($data['id'], $data);
			$data['updated'] = true;

			$this->counter_sale_model->_table = 'spareparts_dealer_stock';
			foreach ($dealer_stock as $key => $value) {
				if($value->quantity - $added_quantity > 0){
					$value->quantity = $value->quantity - $added_quantity;
					$this->counter_sale_model->update($value->id,$value);
					$added_quantity = 0;
				}else{
					$value->quantity = 0;
					$this->counter_sale_model->update($value->id,$value);
					$added_quantity = $quantity - $value->quantity;
				}
			}

    		$success = true;
    		$msg = 'false';
    	}

    	echo json_encode(array('success'=>$success, 'msg'=>$msg, 'previous_quantity'=>$previous_quantity));

    }

}