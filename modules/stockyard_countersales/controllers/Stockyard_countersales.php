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
 * Stockyard_countersales
 *
 * Extends the Project_Controller class
 * 
 */

class Stockyard_countersales extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	// control('Stockyard Countersales');
    	control('Counter Sales');

        $this->load->model('stockyard_countersales/stockyard_countersale_model');
        $this->load->model('stockyard_countersale_parts/stockyard_countersale_part_model');
		$this->load->library('sparepart_orders/sparepart_order'); 
        $this->lang->load('stockyard_countersales/stockyard_countersale');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('stockyard_countersales');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stockyard_countersales';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->stockyard_countersale_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->stockyard_countersale_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->stockyard_countersale_model->insert($data);
        }
        else
        {
            $success=$this->stockyard_countersale_model->update($data['id'],$data);
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
		$data['created_by'] = $this->input->post('created_by');
		$data['updated_by'] = $this->input->post('updated_by');
		$data['deleted_by'] = $this->input->post('deleted_by');
		$data['created_at'] = $this->input->post('created_at');
		$data['updated_at'] = $this->input->post('updated_at');
		$data['deleted_at'] = $this->input->post('deleted_at');
		$data['issue_date'] = $this->input->post('issue_date');
		$data['creadit_account'] = $this->input->post('creadit_account');
		$data['price_option'] = $this->input->post('price_option');
		$data['vro'] = $this->input->post('vro');
		$data['countersale_no'] = $this->input->post('countersale_no');
		$data['issueCountersaeIssueNo'] = $this->input->post('issueCountersaeIssueNo');
		$data['total_for_parts'] = $this->input->post('total_for_parts');
		$data['dealer_total_for_parts'] = $this->input->post('dealer_total_for_parts');
		$data['cash_discount_percent'] = $this->input->post('cash_discount_percent');
		$data['cash_discount_amt'] = $this->input->post('cash_discount_amt');
		$data['vat'] = $this->input->post('vat');
		$data['vat_parts'] = $this->input->post('vat_parts');
		$data['net_total'] = $this->input->post('net_total');

        return $data;
   	}

   	public function check_stock()
   	{
		$this->stockyard_countersale_model->_table = 'view_sparepart_real_stock';
		$stockyard = $this->get_sparepart_stockyard();
		$where = array(
			'stockyard_id' => $stockyard->stockyard_id,
			'part_code' => $this->input->post('part_code'),
		);
		$stock = $this->stockyard_countersale_model->find($where);
    	if($stock){
    		if($stock->stock_quantity >= $this->input->post('quantity')){
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


   	public function save_counter_sales()
   	{
   		if(!is_group(SPAREPART_INCHARGE_GROUP) && !is_group(703)){
   			$msg = 'You cannot Bill';
   			$success = false;
   		}else{
	   		// echo '<pre>';
	   		// print_r($this->input->post());
	   		$stockyard = $this->get_sparepart_stockyard();

	   		$this->db->trans_begin();

	   		if(!$this->input->post('countersales_request')['countersale_no']){
	   			$countersale_no = $this->getlatest_countersales_no($stockyard->stockyard_id) + 1;
	   		}else{
	   			$countersale_no = $this->input->post('countersales_request')['countersale_no'];
	   		}

	   		$sales_data = array(
	            // 'counter_sales_id' => ($this->input->post('countersales_request')['counter_sales_id'])?$this->input->post('countersales_request')['counter_sales_id']:0,
	            'issue_date' => $this->input->post('countersales_request')['issue_date'],
	            'credit_account' => $this->input->post('countersales_request')['credit_account'],
	            'price_option' => $this->input->post('countersales_request')['price_option'],
	            'vor' => $this->input->post('countersales_request')['vro'],
	            'countersale_no' => $countersale_no,
	            // 'issueCountersaeIssueNo' => $this->input->post('countersales_request')['issueCountersaeIssueNo'],
	            'total_for_parts' => $this->input->post('countersales_request')['total_for_parts'],
	            'dealer_total_for_parts' => $this->input->post('countersales_request')['dealer_total_for_parts'],
	            'cash_discount_percent' => ($this->input->post('countersales_request')['cash_discount_percent'])?$this->input->post('countersales_request')['cash_discount_percent']:0,
	            'cash_discount_amt' => $this->input->post('countersales_request')['cash_discount_amt'],
	            'vat' => $this->input->post('countersales_request')['vat'],
	            'vat_parts' => $this->input->post('countersales_request')['vat_parts'],
	            'net_total' => $this->input->post('countersales_request')['net_total'],
	            'stockyard_id' => $stockyard->stockyard_id,
	   		);

	   		// var_dump($sales_data);
   			if($this->input->post('countersales_request')['id']){
   				$countersale_id = $sales_data['id'] = $this->input->post('countersales_request')['id'];
	   			$success = $this->stockyard_countersale_model->data($sales_data['id'],$sales_data);
   			}else{
	   			$success = $this->stockyard_countersale_model->insert($sales_data);
	   			$countersale_id = $success;
   			}

   			if($success){
	   			$parts_data = $this->input->post('countersales_parts');

	   			// delete previous parts
	   			if($this->input->post('countersales_request')['id']){
	   				$this->db->where('countersale_id', $this->input->post('countersales_request')['id']);
	   				$this->db->delete('spareparts_stockyard_countersale_parts');
	   			}
	   			$this->stockyard_countersale_model->_table = 'spareparts_stockyard_countersale_parts';
	   			foreach ($parts_data as $key => $value) {
	   				$data = array(
	   					'sparepart_id' => intval($value['sparepart_id']),
	   					'quantity' => $value['quantity'],
	   					'dealer_price' => $value['dealer_price'],
	   					'dealer_price_total' => $value['dealer_price_total'],
	   					'total' => $value['total'],
	   					'countersale_id' => $countersale_id
	   				);
	   				$this->stockyard_countersale_model->insert($data);

	   				$this->remove_stock($stockyard->stockyard_id, $value['sparepart_id'], $value['quantity']);
	   			}

   			}

   			if ($this->db->trans_status() === FALSE)
			{
				$success = FALSE;
				$msg = 'Please try again!';
		        $this->db->trans_rollback();
			}
			else
			{
				$success = TRUE;
				$msg = '';
		        $this->db->trans_commit();
			}
   		}

   		echo json_encode(array('success'=>$success, 'msg' => $msg));
   	}

   	public function getlatest_countersales_no($stockyard_id)
   	{
   		$where['stockyard_id'] = $stockyard_id;
   		$this->db->order_by('id desc');
   		$data = $this->stockyard_countersale_model->find($where);

   		if($data){
   			$countersale_no =  $data->countersale_no;
   		}else{
   			$countersale_no = 1;
   		}

   		return $countersale_no;
   	}

   	public function remove_stock($stockyard_id, $sparepart_id, $quantity)
    {
    	$this->load->model('sparepart_stocks/sparepart_stock_model');
    	$this->load->library('sparepart_stocks/sparepart_stock');

        $current_stock = $this->sparepart_stock->get_stock($stockyard_id, $sparepart_id);

        $this->sparepart_stock_model->_table='spareparts_sparepart_stock';

        if($current_stock){
            $data = array(
                'id' => $current_stock->id,
                'quantity' => $current_stock->stock_quantity - $quantity,
            );
            $this->sparepart_stock_model->update($data['id'],$data);
        }
    }

    public function invoice()
    {
    	$where['id'] = $this->input->get('id');
    	$countersale_no = $this->input->get('counter_sales_no');
    	// print_r($id);

    	$this->stockyard_countersale_model->_table = 'view_stockyard_countersales';
    	$data['detail'] = $this->stockyard_countersale_model->find($where);

    	if(!$data['detail']->invoice_no){
    		// $this->
	    	$invoice_no = $this->sparepart_order->get_new_invoice_no($data['detail']->stockyard_id);
	    	$data['detail']->invoice_no = $invoice_no;
	    	$detail = array(
	    		'id' => $data['detail']->id,
	    		'invoice_no' => $invoice_no,
	    		'is_billed' => 1,
	    	);
	    	$this->stockyard_countersale_model->_table = 'spareparts_stockyard_countersales';
	    	$this->stockyard_countersale_model->update($detail['id'], $detail);
	    	// exit;
    	}
    	$data['detail']->invoice_prefix = $this->get_abbr($data['detail']->stockyard);

    	$where['countersale_id'] = $this->input->get('id');

    	$this->stockyard_countersale_part_model->_table = 'view_stockyard_countersales_parts';
    	$data['parts'] = $this->stockyard_countersale_part_model->findAll($where);

    	/*echo '<pre>';
    	print_r($data);
    	echo '</pre>';*/

    	$data['header'] = 'Stockyard Countersales';
		$data['module'] = 'stockyard_countersales';
		$this->load->view($this->config->item('template_admin') . "prints/counter_sales_print",$data);

    }

}