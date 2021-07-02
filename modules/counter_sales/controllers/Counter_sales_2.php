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
		else {
		// if(is_service_advisor()){
			$where['dealer_id'] = $this->dealer_id;
			// $where['floor_supervisor_id'] = $this->_user_id;
		}
		$this->counter_sale_model->_table = "view_counter_sales";

		$fields = 'deleted_at, deleted_by, counter_sales_id, vehicle_no, chasis_no, engine_no, vehicle_id, vehicle_name, variant_id, variant_name, color_id, color_name, party_id, full_name, date_time, billing_record_id, is_request_complete, is_countersale_billed, is_countersale_closed, address1 ,dealer_id, invoice_no';		
		
		paging('counter_sales_id');
		
		search_params();
		
		$this->db->group_by($fields);
		$rows=$this->counter_sale_model->findAll($where, $fields);

		$total = count($rows);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save(){
		if( ! $this->dealer_id) {
			echo "403";
			exit;
		}

		$post = $this->input->post();

		if( !isset($post['bill_part_datas'])) {
			echo json_encode(array('success' => FALSE, 'msg' => 'Empty Values!' ));
			exit;
		}

		$bill_details = $this->input->post('bill_details');
		$bill_summary = $this->input->post('bill_summary');
		$bill_parts = $this->input->post('bill_part_datas');

		// $bill_details = array_filter($bill_details, function($value) {
			// return ($value !== null && $value !== false && $value !== ''); 
		// });

		$counter_sales_id = $this->get_counter_sales_number();
		/*Know if its insert or update*/
		if($post['bill_details']['counter_sales_id']) {
			$counter_sales_id = $post['bill_details']['counter_sales_id'];
		} 

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

	/*public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if(!$this->input->post('id'))
		{
			$success=$this->counter_sale_model->insert($data);
		}
		else
		{
			$success=$this->counter_sale_model->update($data['id'],$data);
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
		$data['counter_sales_id'] = $this->input->post('counter_sales_id');
		$data['vehicle_no'] = $this->input->post('vehicle_no');
		$data['chasis_no'] = $this->input->post('chasis_no');
		$data['engine_no'] = $this->input->post('engine_no');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] = $this->input->post('color_id');
		$data['party_id'] = $this->input->post('party_id');
		$data['date_time'] = $this->input->post('date_time');
		$data['billing_record_id'] = $this->input->post('billing_record_id');

		return $data;
	}*/

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
		$post = $this->input->post('countersale_summary');

		$this->db->where('dealer_id', $this->dealer_id);
		$countersale = $this->counter_sale_model->find(array('counter_sales_id' => $post['counter_sales_id']));

		$data = array(
			'id'		=>	$countersale->id,
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
		$dealer_stock = $this->counter_sale_model->get_by($where);

		if(count((array)$dealer_stock) > 0){
			$stock['id'] = $dealer_stock->id;
			$stock['quantity'] = $dealer_stock->quantity - 1;

			if($dealer_stock->quantity < 0){
				$data['success'] = FALSE;
				$data['msg'] = "You don't have enough stock";
				echo json_encode($data);
				exit;

			} else{

				$where = array();
				$where['counter_sales_id'] = $counter_sales_id;
				$where['dealer_id'] = $this->dealer_id;
				$this->counter_sale_model->_table = 'view_counter_sales';
				$countersales = $this->counter_sale_model->find($where);

				if( ! $countersales->is_countersale_closed) {
					$data['success'] = false;
					$data['msg'] = "Countersales not closed";
					echo json_encode($data);
					exit;
				}

				$where = array();
				$where['part_id'] = $dealer_stock->sparepart_id;
				$where['bill_id'] = $countersales->id;
				$this->counter_sale_model->_table = 'ser_parts';
				$req = $this->counter_sale_model->get_by($where);

				if(count((array)$req) > 0){
					if( (int)$req->issue_quantity < (int)$req->quantity_to_bill && (int)$req->quantity_to_bill != null){

						/*Material Scan Table */
						$this->job_card_model->_table = "view_material_scan";
						$scannedParts = $this->job_card_model->find(array('countersales_id'=> $counter_sales_id, 'part_code' => $barcode, 'dealer_id' => $this->dealer_id));

						if($scannedParts) {
							$data = array(
								'id'			=>	$scannedParts->id,
								'issue_date'	=>	date('Y-m-d'),
								'quantity'		=>	$scannedParts->quantity + 1,
								'material_issue_no'=>$scannedParts->material_issue_no,
							);


							$this->job_card_model->_table = "ser_material_scan";
							$success = $this->job_card_model->update($data['id'], $data);
							$data['updated'] = true;
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

						$req_data['issue_quantity'] = $req->issue_quantity + 1;
						$req_data['id'] = $req->id;
						$data['success'] = $this->counter_sale_model->update($req_data['id'],$req_data);

						$data['part_id'] = $dealer_stock->sparepart_id;
						$data['part_name'] = $dealer_stock->name;
						$data['part_code'] = $barcode;

						$this->counter_sale_model->_table = 'spareparts_dealer_stock';
						if( ENABLE_SERVICE_TESTING == 0 ){
							$this->counter_sale_model->update($stock['id'],$stock);
						}
					}else{
						$data['success'] = FALSE;
						$data['msg'] = "Now you cannot add this item";
					}
				}else{
					$data['success'] = FALSE;
					$data['msg'] = "This item is not in request";
				}
			}
		}else{
			$data['success'] = FALSE;
			$data['msg'] = "You don't have this item";
		}

		echo json_encode($data);

	}


	function create_bill_countersales() {
		$post = $this->input->post('data');
		$counter_sales_id = $post['counter_sales_id'];

		$this->db->trans_begin();


		$this->db->where('dealer_id', $this->dealer_id);
		$countersales = $this->counter_sale_model->find(array('counter_sales_id' => $counter_sales_id));

		if($countersales) {
			if($countersales->is_countersale_billed) {
				return "Billed";
				exit;
			}
		}

		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->order_by('invoice_no desc');
		$this->counter_sale_model->_table = "ser_billing_record";
		$invoice_no = $this->counter_sale_model->find();
		$invoice_no = ($invoice_no)?++$invoice_no->invoice_no:1;


		$data = array(
			'jobcard_group'	=>	0,
			'dealer_id'			=>	$this->dealer_id,
			'counter_sales_id'	=>	$counter_sales_id,

			'bill_type'				=>	'counter',
			'issue_date'			=> date('Y-m-d H:i:s'),
			'total_parts'			=>	$post['total_for_parts'],
			'cash_discount_percent'	=>	$post['cash_discount_percent'],
			'cash_discount_amt'		=>	(float)$post['cash_discount_amt'],
			'vat_percent'			=>	$post['vat'],
			'vat_parts'				=>	$post['vat_parts'],
			'net_total'				=>	$post['net_total'],
			'invoice_no'			=>	$invoice_no,
		);

		$this->counter_sale_model->_table = "ser_billing_record";
		$bill_id = $this->counter_sale_model->insert($data);

		$data = array(
			'id'						=>	$countersales->id,
			'is_countersale_billed'		=>	1,
			'billing_record_id'			=>	$bill_id,
			// $
		);

		$this->counter_sale_model->_table = "ser_counter_sales";
		$success = $this->counter_sale_model->update($data['id'], $data);

		$returndata = array(
			'id'			=>	$countersales->id,
			'invoice_no'	=>	$invoice_no,
			'bill_id'		=>	$bill_id,
		);

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

		echo json_encode(array('success' => $success, 'msg' => $msg, 'data'=>$returndata));

		/*$data2 = array(

			'payment_type'			=>	$bill_details['payment_type_val'],
			''			=>	$bill_details['issue_date'],
			'credit_account'		=>	$bill_details['credit_account'],

			'invoice_no-prefix'		=>	@$bill_details['invoice_no-prefix'],
		);*/

	}

	function create_gatepass() {
		$counter_sales_id = $this->input->get('counter_sales_id');

		$data['workshop'] = $this->get_workshop_name();

		$this->job_card_model->_table = 'view_gatepass';
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
			$data['gatepass']['gatepass_no'] = $gatepass_no;
			$data['gatepass']['date'] = $save_data['date'];
		}

		$data['gatepass']['invoice_no'] = "TI". sprintf('%05d', $gatepass->invoice_no);
		$data['counter_sales_id'] = "CS". sprintf('%05d', $counter_sales_id);
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


}