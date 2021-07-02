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
 * Billing_details
 *
 * Extends the Project_Controller class
 * 
 */

class Billing_details extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Billing Details');

        $this->load->model('billing_details/billing_detail_model');
        $this->lang->load('billing_details/billing_detail');
    }

	public function index()
	{
		$data['dealer_id'] = ($this->dealer_id)?$this->dealer_id:0;
		// Display Page
		$data['header'] = lang('billing_details');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'billing_details';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->billing_detail_model->_table='view_d2d_billing_detail';
		$where = array();
		if($this->dealer_id){
			$where['dealer_id'] = $this->dealer_id;
		}else{
			$where['dealer_id'] = 0;
		}
		search_params();
		
		$total=$this->billing_detail_model->find_count($where);
		
		paging('id');
		
		search_params();
		
		$rows=$this->billing_detail_model->findAll($where);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		// echo '<pre>';
		// print_r($this->input->post());
        
        $data=$this->_get_posted_data(); //Retrive Posted Data
        // print_r($data); exit;
        $items = $this->_get_posted_item_data();
        $item_data = array();
        // print_r($items);

        $data['total_amt'] = 0;
        foreach($items['part_code'] as $key=>$value){
        	if(array_key_exists('id', $items)){
        		$item_data[$key]['id'] = $items['id'][$key];
        	}
        	$item_data[$key] = array(
        		'id' => $items['id'][$key],
        		'sparepart_id' => $items['sparepart_id'][$key],
        		'price' => $items['price'][$key],
        		'quantity' => $items['quantity'][$key],
        		'total_price' => $items['price'][$key] * $items['quantity'][$key], 
        	);
        	$data['total_amt'] += $item_data[$key]['total_price'];
        }

        // print_r($data);
        // print_r($item_data);

		// exit;
		$this->db->trans_begin();
        if(!$this->input->post('detail_id'))
        {
            $success = $bill_id = $this->billing_detail_model->insert($data);

        }
        else
        {
            $success=$this->billing_detail_model->update($data['id'],$data);
            $bill_id = $data['id'];
        }

        if($success){
        	$this->billing_detail_model->_table = 'd2d_billing_list';
        	foreach ($item_data as $key => $value) {
        		$value['bill_id'] = $bill_id;
        		if(!array_key_exists('id', $value)){
        			$this->billing_detail_model->insert($value);
        		}else{
        			if($value['id'] != 'null'){
        				$this->billing_detail_model->update($value['id'],$value);
        			}else{
        				unset($value['id']);
        				$this->billing_detail_model->insert($value);
        			}
        		}
        	}
        }

		if ($this->db->trans_status() === TRUE)
		{
			$this->db->trans_commit();
			$success = TRUE;
			$msg=lang('general_success');
		}
		else
		{
			$this->db->trans_rollback();
			$success = FALSE;
			$msg=lang('general_failure');
		}

		 echo json_encode(array('msg'=>$msg,'success'=>$success));
		 exit;
	}

   	private function _get_posted_data()
   	{
   		$data=array();
   		if($this->input->post('detail_id')) {
			$data['id'] = $this->input->post('detail_id');
		}
		$data['dealer_id'] = ($this->input->post('dealer_id'))?$this->input->post('dealer_id'):0;
		// $data['bill_no'] = $this->input->post('bill_no');
		$data['billed_date'] = $this->input->post('billed_date');
		$data['billed_date_np'] = get_nepali_date($data['billed_date'],1);//$this->input->post('billed_date_np');
		$data['billed_to'] = $this->input->post('billed_to');
		$data['billed_time'] = date('H:i:s');
		$data['status'] = PENDING;//$this->input->post('status');
		// $data['approved_date'] = $this->input->post('approved_date');
		// $data['approved_date_np'] = $this->input->post('approved_date_np');
		// $data['approved_time'] = $this->input->post('approved_time');
		// $data['total_amt'] = $this->input->post('total_amt');

        return $data;
   	}

   	private function _get_posted_item_data()
   	{
   		$data = array();
   		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}
		$data['part_code'] = $this->input->post('part_code');
		$data['part_name'] = $this->input->post('part_name');
		$data['price'] = $this->input->post('price');
		$data['quantity'] = $this->input->post('quantity');
		$data['sparepart_id'] = $this->input->post('sparepart_id');

		return $data;
   	}

   	public function set_barcode_values()
   	{
   		$data = $this->input->post();

   		$this->billing_detail_model->_table = 'mst_spareparts';
   		$where_sparepart['part_code'] = $data['code'];
   		$sparepart_detail = $this->billing_detail_model->find($where_sparepart);
   		$dealer_id = $this->dealer_id;
   		// print_r($dealer_id);
   		if($sparepart_detail){
	   		if($dealer_id == NULL){
	   			$this->billing_detail_model->_table = 'view_sparepart_stock';
	   			$where['mst_part_id'] = $sparepart_detail->id;
	   			$stock_detail = $this->billing_detail_model->find($where);

	   			if($stock_detail && $stock_detail->quantity > 0){
	   				$result['data'] = array(
	   					'id' => NULL,
	   					'part_code' => $stock_detail->part_code,
	   					'part_name' => $stock_detail->part_name,
	   					'sparepart_id' => $stock_detail->mst_part_id,
	   				);
	   				$result['data']['price'] = $sparepart_detail->dealer_price;
	   				$result['data']['quantity'] = 1;
	   				$result['success'] = TRUE;
	   				$result['msg'] = FALSE;
	   			}else{
	   				$result = array('success'=>FALSE, 'msg'=>'No stock');
	   			}
	   		}else{
   				$this->billing_detail_model->_table = 'view_spareparts_all_dealer_stock';
	   			$where['sparepart_id'] = $sparepart_detail->id;
	   			$where['dealer_id'] = $dealer_id;
	   			$stock_detail = $this->billing_detail_model->find($where);

	   			if($stock_detail && $stock_detail->quantity > 0){
	   				$result['data'] = array(
	   					'id' => NULL,
	   					'part_code' => $stock_detail->part_code,
	   					'part_name' => $stock_detail->name,
	   					'sparepart_id' => $stock_detail->sparepart_id,
	   				);
	   				$result['data']['price'] = $sparepart_detail->dealer_price;
	   				$result['data']['quantity'] = 1;
	   				$result['success'] = TRUE;
	   				$result['msg'] = FALSE;
	   			}else{
	   				$result = array('success'=>FALSE, 'msg'=>'No stock');
	   			}
	   		}
   		}else{
   			$result = array('success'=>FALSE, 'msg'=>'Invalid Part-code');
   		}
   		echo json_encode($result);
   	}

   	public function dispatched_list()
   	{
   		$data['dealer_id'] = ($this->dealer_id)?$this->dealer_id:0;
		// Display Page
		$data['header'] = lang('billing_details');
		$data['page'] = $this->config->item('template_admin') . "dispatched_list";
		$data['module'] = 'billing_details';
		$this->load->view($this->_container,$data);
   	}

   	public function dispatched_list_json()
   	{

   		$where['billed_to'] = ($this->dealer_id)?$this->dealer_id:0;
   		$where['is_billed'] = 1;
   		search_params();
		
		$total=$this->billing_detail_model->find_count($where);
		
		paging('id');
		
		search_params();
		
		$rows=$this->billing_detail_model->findAll($where);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
   	}

   	public function approve()
   	{
   		$data['id'] = $this->input->post('id');
   		$data['status'] = APPROVE;
   		$data['approved_date'] = date('Y-m-d');
   		$data['approved_date_np'] = get_nepali_date(date('Y-m-d'),1);
   		$data['approved_time'] = date('H:i:s');

		$this->db->trans_begin();

   		$success = $this->billing_detail_model->update($data['id'],$data);
   		if($success){
   			$detail = $this->billing_detail_model->find($data);
   			$this->billing_detail_model->_table = 'd2d_billing_list';
   			$list = $this->billing_detail_model->findAll(array('bill_id'=>$data['id']));
   			$this->transfer_stock_to($detail->billed_to,$list);
   		}

   		if ($this->db->trans_status() === TRUE)
		{
			$success = TRUE;
			$msg=lang('general_success');
			$this->db->trans_commit();
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
			$this->db->trans_rollback();
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
	 	exit;
   	}

   	public function reject()
   	{
   		$data['id'] = $this->input->post('id');
   		$data['status'] = REJECT;
   		$data['approved_date'] = date('Y-m-d');
   		$data['approved_date_np'] = get_nepali_date(date('Y-m-d'),1);
   		$data['approved_time'] = date('H:i:s');

   		$success = $this->billing_detail_model->update($data['id'],$data);

   		if ($this->db->trans_status() === TRUE)
		{
			$success = TRUE;
			$msg=lang('general_success');
			$this->db->trans_commit();
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
			$this->db->trans_rollback();
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
	 	exit;
   	}

	public function generate_bill($id)
	{
		$data = array();
		$data['module'] = 'billing_details';
		$this->billing_detail_model->_table = 'view_d2d_billing_detail';
		$data['bill_detail'] = $this->billing_detail_model->find(array('id'=>$id));
		$this->billing_detail_model->_table = 'view_d2d_billing_list';
		$data['bill_list'] = $this->billing_detail_model->findAll(array('bill_id'=>$id));
		$this->billing_detail_model->_table = 'ser_billing_record';
		$data['invoice_detail'] = $this->billing_detail_model->find(array('id'=>$data['bill_detail']->bill_id));
		$this->load->view($this->config->item('template_admin') .'bill',$data);
	}

	private function transfer_stock_to($to, $list)
	{
		foreach ($list as $key => $value) {
			if($to){
				$where_to = array(
					'dealer_id' => $to,
					'sparepart_id' => $value->sparepart_id,
				);
				$this->billing_detail_model->_table = 'spareparts_dealer_stock';
			}else{
				$where_to = array(
					'sparepart_id' => $value->sparepart_id,
				);
				$this->billing_detail_model->_table = 'spareparts_sparepart_stock';
			}
			$stock = $this->billing_detail_model->find($where_to);
			$stock->quantity = $stock->quantity + $value->quantity;

			$success = $this->billing_detail_model->update($stock->id,$stock);
		}
	}

	private function transfer_stock_from($from, $to, $list)
	{
		foreach ($list as $key => $value) {
			if($from){
				$where_from = array(
					'dealer_id' => $from,
					'sparepart_id' => $value->sparepart_id,
				);
				$this->billing_detail_model->_table = 'spareparts_dealer_stock';
			}else{
				$where_from = array(
					'sparepart_id' => $value->sparepart_id,
				);
				$this->billing_detail_model->_table = 'spareparts_sparepart_stock';
			}
			$stock = $this->billing_detail_model->find($where_from);
			$stock->quantity = $stock->quantity - $value->quantity;
			$this->billing_detail_model->update($stock->id,$stock);

			$success = $this->billing_detail_model->update($stock->id,$stock);
		}
	}

	public function save_bill()
	{
		$data['id'] = $this->input->post('billing_details_id');
		$detail = $this->billing_detail_model->find($data);

		$this->db->trans_begin();

		$invoice = $this->update_billing_record($detail);

		$this->billing_detail_model->_table = 'd2d_billing_detail';
		$data['bill_id'] = $invoice['bill_id'];
		$data['bill_no'] = $invoice['bill_no'];
		$data['is_billed'] = 1;
		$success = $this->billing_detail_model->update($data['id'],$data);

		if($success){
   			$this->billing_detail_model->_table = 'd2d_billing_list';
   			$list = $this->billing_detail_model->findAll(array('bill_id'=>$data['id']));
   			$this->transfer_stock_from($detail->dealer_id, $detail->billed_to,$list);
   		}

   		if ($this->db->trans_status() === TRUE)
		{
			$success = TRUE;
			$msg=lang('general_success');
			$this->db->trans_commit();
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
			$this->db->trans_rollback();
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
	 	exit;
	}

	public function update_billing_record($detail)
	{
		$this->billing_detail_model->_table = 'ser_billing_record';

		$where['dealer_id'] = $detail->dealer_id;

		$where['fiscal_year_id'] = $this->fiscal_year_id[0];
		$this->db->order_by('invoice_no','desc');
		$previous_invoice = $this->billing_detail_model->find($where);

		if(count($previous_invoice)){
			$data['invoice_no'] = $previous_invoice->invoice_no + 1;
		}else{
			$data['invoice_no'] = 1;
		}

		$data['jobcard_group'] = 0;
		$data['bill_type'] = 'dealer_to_dealer';
		$data['issue_date'] = date('Y-m-d');
		// $data['invoice_no'] = date('Y-m-d');
		$data['total_parts'] = $detail->total_amt;
		$data['vat_percent'] = 13;
		$data['net_total'] = 1.13 * $detail->total_amt;
		$data['dealer_id'] = $detail->dealer_id;
		$data['fiscal_year_id'] = $this->fiscal_year_id[0];

		$result['bill_id'] = $this->billing_detail_model->insert($data);
		$result['bill_no'] = $data['invoice_no'];

		return $result;
	}
}