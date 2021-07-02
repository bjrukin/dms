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
	public function get_ledger(){
		
		$this->purchase_invoice_model->_table = "view_user_ledger";
		search_params();
		$total=$this->purchase_invoice_model->find_count();

		paging('id');

		search_params();
		$ledger= $this->purchase_invoice_model->findAll();
		
		echo json_encode($ledger);

	}

	public function json()
	{
		search_params();
		
		$total=$this->purchase_invoice_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_invoice_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); 

		$method = json_decode($data['method']);
		unset($data['method']);

		echo"<pre>"; print_r($data); print_r($method);
		exit;

		if(!$this->input->post('id'))
		{
			$success = $this->purchase_invoice_model->insert($data);
			$result = $success;

			foreach($method as $key=>$value){
				$value->purchase_id = $result;
				unset($value->id,$value->total,$value->uid);

				$this->purchase_method_model->insert($value);
			}

		}
		else
		{
			$success=$this->purchase_invoice_model->update($data['id'],$data);

			$result = $success;


			foreach($method as $key=>$value){
           		//$value->purchase_id = $result;


				unset($value->total,$value->uid);

				$this->purchase_method_model->update($value->id,$value);
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
		
		$data['supplier'] = $this->input->post('supplier');
		$data['method'] = $this->input->post('method');

		$data = array_filter($data, function($value) {
			return ($value !== null && $value !== false && $value !== ''); 
		});

		print_r($this->input->post());
		return $data;
	}







}