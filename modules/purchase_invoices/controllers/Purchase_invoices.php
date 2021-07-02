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
 * Purchase_invoices
 *
 * Extends the Project_Controller class
 * 
 */

class Purchase_invoices extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Purchase Invoices');

		$this->load->model('purchase_invoices/purchase_invoice_model');
		$this->lang->load('purchase_invoices/purchase_invoice');
		$this->load->model('purchase_methods/purchase_method_model');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('purchase_invoices');
		$data['page'] = $this->config->item('template_admin') . "index";

		
		$data['module'] = 'purchase_invoices';
		// $order = NULL;
		// $where = $this->_get_report_where();
		// $export_data = $this->purchase_method_model->get_Purchase_Methods($where,$order)->result_array();

  //       $this->export($export_data);
		//$data['methods']=$this->purchase_method_model->get_Purchase_Methods()->result_array();
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$where = array('dealer_id' => $this->dealer_id);
		if(is_admin() ){
			unset($where['dealer_id']);
		}

		$total=$this->purchase_invoice_model->find_count($where);
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_invoice_model->findAll($where);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data = $this->_get_posted_data(); 

		$method = json_decode($data['method']);
		unset($data['method']);

		if(!$this->input->post('id'))
		{
			// Part 1
			$success = $this->purchase_invoice_model->insert($data);

			foreach($method as $key=>$value){

				//Part 2
				$value->purchase_id = $success;

				$insertdata = array(
					// 'dealer_id'		=>	$this->dealer_id,

					'type'		=>	@$value->type,
					'part_id' 	=>	$value->part_id,
					'qty'		=>	$value->qty,
					'price'		=>	$value->price,
					'disc'		=>	$value->disc,
					'amount'	=>	$value->qty * $value->price - $value->disc,
					'bin'		=>	$value->bin,
					'vat'		=>	$value->vat,
					'purchase_id'=>	$success,

				);

				$insertdata = array_filter($insertdata, function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});


				$this->purchase_method_model->insert($insertdata);

				//Part 3
				$stockdata = array(
					'sparepart_id'	=>	$insertdata['part_id'],
					'dealer_id'		=>	$this->dealer_id,
					'quantity'		=>	$insertdata['qty'],
					'price'			=>	$insertdata['price'],
				);
				
				$stockdata = array_filter($stockdata, function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});

				$this->purchase_invoice_model->_table = 'spareparts_dealer_stock';
				$where = array(
					'dealer_id'	=>	$this->dealer_id,
					'sparepart_id'	=>	$stockdata['sparepart_id'],
				);
				$row = $this->purchase_invoice_model->find($where);
				if($row) {
					$stockdata['id'] = $row->id;
					$stockdata['quantity'] += $row->quantity;
					$this->purchase_invoice_model->update($stockdata['id'],$stockdata);
				} else {
					$this->purchase_invoice_model->insert($stockdata);
				}
			}

		} 
		else
		{
			//Part 1
			$success=$this->purchase_invoice_model->update($data['id'],$data);
			$success = $data['id'];

			//Part 2
			foreach($method as $key=>$value){
				$insertdata = array(
					'type'		=>	@$value->type,
					'part_id' 	=>	$value->part_id,
					'qty'		=>	$value->qty,
					'price'		=>	$value->price,
					'disc'		=>	$value->disc,
					'amount'	=>	$value->qty * $value->price - $value->disc,
					'bin'		=>	$value->bin,
					'vat'		=>	$value->vat,
					'purchase_id'=>	$success,

					// 'localpart_id'=>@$value->localpart_id
				);

				$insertdata = array_filter($insertdata, function($value) {
					return ($value !== null && $value !== false && $value !== ''); 
				});

				if(isset($value->new)) {
					//insert
					$this->purchase_method_model->insert($insertdata);
				} else {
					//update
					$insertdata['id'] = $value->id;
					$this->purchase_method_model->update($insertdata['id'], $insertdata);
				}



				//Part 3
				$stockdata = array(
					'sparepart_id'	=>	$insertdata['part_id'],
					'dealer_id'		=>	$this->dealer_id,
					'quantity'		=>	$insertdata['qty'],
					'price'			=>	$insertdata['price'],
				);
				$this->purchase_invoice_model->_table = 'spareparts_dealer_stock';
				$where = array(
					'dealer_id'	=>	$this->dealer_id,
					'sparepart_id'	=>	$stockdata['sparepart_id'],
				);
				$row = $this->purchase_invoice_model->find($where);
				if($row) {
					$stockdata['id'] = $row->id;
					$stockdata['quantity'] += $row->quantity;
					$this->purchase_invoice_model->update($stockdata['id'],$stockdata);
				} else {
					$this->purchase_invoice_model->insert($stockdata);
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

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	private function _get_posted_data()
	{
		$data=array();
		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}
		$data['purchase_invoice_serial'] = $this->input->post('purchase_invoice_serial');
		$data['date'] = $this->input->post('date');
		$data['pinv_no'] = $this->input->post('pinv_no');
		$data['splr_date'] = $this->input->post('splr_date');
		$data['splr_inv_no'] = $this->input->post('splr_inv_no');
		$data['ledger'] = $this->input->post('ledger');
		$data['challan_no'] = $this->input->post('challan_no');
		$data['ord_no'] = $this->input->post('ord_no');
		$data['total_item'] = $this->input->post('total_item');
		$data['discount'] = $this->input->post('discount');
		$data['remark'] = $this->input->post('remark');
		$data['currency'] = $this->input->post('currency');
		$data['exchange_price'] = $this->input->post('exchange_price');
		$data['gross_total'] = $this->input->post('gross_total');
		$data['excise_duty'] = $this->input->post('excise_duty');
		$data['others'] = $this->input->post('others');
		$data['vat'] = $this->input->post('vat');
		$data['vatamount'] = $this->input->post('vatamount');
		$data['netamount'] = $this->input->post('netamount');

		$data['dealer_id'] = $this->dealer_id;
		
		$data['supplier'] = $this->input->post('supplier');
		$data['method'] = $this->input->post('method');

		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		return $data;
	}

	public function get_ledger() {
		
		$this->purchase_invoice_model->_table = "view_service_localstore_name";
		$ledger= $this->purchase_invoice_model->findAll();
		
		echo json_encode($ledger);
	}

	public function get_spareparts_lists(){
		$search_name = strtoupper($this->input->get('name_startsWith'));
		$where["part_name LIKE '%{$search_name}%'"] = NULL;

		$type = $this->input->get('type');
		if($type == 'local') {
			$this->db->where('is_local', 1);
		}

		$this->purchase_invoice_model->_table = "view_spareparts";
		$data = $this->purchase_invoice_model->findAll($where, NULL, NULL, NULL, 500);
		echo json_encode($data);
	}

	/*public function get_localparts() {
		
		$this->purchase_invoice_model->_table = "mst_spareparts_local";

		$dealer_id = $this->session->userdata();
		$dealer_id = $dealer_id['employee']['dealer_id'];

		$where = array('dealer_id' => $dealer_id);
		$row= $this->purchase_invoice_model->findAll();
		
		echo json_encode($row);
	}*/

	public function new_local_part() {
		$post = $this->input->post();


		$data = array(
			'name' => strtoupper($post['partname']),
			'part_code' =>	' ',
			'price'	=>	$post['price'],
			'is_local'	=>	1,
		);

		$this->purchase_invoice_model->_table = "mst_spareparts";
		$success = $this->purchase_invoice_model->insert($data);

		echo json_encode(array('success' => $success, 'row'=>$data));
	}

	function get_purchase_invoice_serial() {
		$this->db->order_by('purchase_invoice_serial','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$id = $this->purchase_invoice_model->find();
		$id = ($id)?++$id->purchase_invoice_serial:1;

		echo json_encode(array('purchase_invoice_serial'=>$id));
	}

	public function print_preview() {
		$get = $this->input->get();

		if(! $get['id']) {
			echo "Data not saved to print.";
			exit;
		}

		$data['header'] = $get['type'];

		$data['workshop'] = $this->get_workshop_name();
		
		$this->purchase_invoice_model->_table = "view_service_purchase_invoice";
		$data['invoice_parts'] = $this->purchase_invoice_model->findAll(array('id'=>$get['id'], 'dealer_id' => $this->dealer_id));
		$data['invoice'] = $data['invoice_parts'][0];

		$this->load->view( 'prints/purchase_invoice' , $data);

	}






}