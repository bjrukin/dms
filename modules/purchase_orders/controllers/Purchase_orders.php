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
 * Purchase_orders
 *
 * Extends the Project_Controller class
 * 
 */

class Purchase_orders extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Purchase Orders');

		$this->load->model('purchase_orders/purchase_order_model');
		$this->load->model('purchase_baseds/purchase_based_model');
		$this->lang->load('purchase_orders/purchase_order');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('purchase_orders');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'purchase_orders';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->purchase_order_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_order_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{

        $data = $this->_get_posted_data(); //Retrive Posted Data
        $purchase_based = $data['grid'];
        $data = $data['data'];
        echo"<pre>"; 
        print_r($data); 
        print_r($purchase_based); 
        exit;


        $data = array_filter($data, function($value) {
        	return ($value !== null && $value !== false && $value !== ''); 
        });
        if(!$this->input->post('id'))
        {
        	$success 	=	$this->purchase_order_model->insert($data);
        	// $result 	= 	$success;
        	foreach($purchase_based as $key=>$value){
        		$value->order_id = $success;
        		unset($value->uid);

        		$this->purchase_based_model->insert($value);
        	}
        }
        else
        {
        	$success=$this->purchase_order_model->update($data['id'],$data);
        	$result = $data['id'];


        	foreach($purchase_based as $key=>$value){
        		$value->order_id = $result;


        		unset($value->uid);

        		$this->purchase_based_model->update($value->id,$value);

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

    	$data['data']['order_date'] 			= $this->input->post('order_date');
    	$data['data']['order_no'] 				= $this->input->post('order_no');
    	$data['data']['ledger'] 				= $this->input->post('ledger');
    	$data['data']['parts_group'] 			= $this->input->post('parts_group');
    	$data['data']['order_type'] 			= $this->input->post('order_type');
    	$data['data']['dispatch_mode'] 			= $this->input->post('dispatch_mode');
    	$data['data']['exclude_nonzero_rol'] 	= $this->input->post('exclude_nonzero_rol');
    	$data['data']['multiples_of_moq'] 		= $this->input->post('multiples_of_moq');
    	$data['data']['include_nonzero_rol'] 	= $this->input->post('include_nonzero_rol');
    	$data['data']['sale_dateto'] 			= $this->input->post('sale_dateto');
    	$data['data']['sale_dateform'] 			= $this->input->post('sale_dateform');
    	$data['data']['stock_required_day'] 	= $this->input->post('stock_required_day');
    	$data['data']['total_items'] 			= $this->input->post('total_items');
    	$data['data']['suggestive_amount'] 		= $this->input->post('suggestive_amount');
    	$data['data']['order_amount'] 			= $this->input->post('order_amount');
    	$data['data']['remark'] 				= $this->input->post('remark');
    	$data['grid'] 							= json_decode($this->input->post('purchase_based'));

    	return $data;
    }

    public function get_order_combo_json(){

    	$row = $this->db->query('SELECT  COUNT(id) FROM ser_purchase_order')->result_array();
    	echo json_encode($row);
    }

}