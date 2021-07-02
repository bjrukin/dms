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
 * Msil_orders
 *
 * Extends the Project_Controller class
 * 
 */

class Msil_orders extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Logistic Msil Order');

		$this->load->model('msil_orders/msil_order_model');
		$this->load->model('dispatch_records/dispatch_record_model');
    $this->load->model('msil_order_mismatches/msil_order_mismatch_model');
    
		$this->lang->load('msil_orders/msil_order');
		$this->load->library('msil_orders/msil_order');

	}

	public function index()
	{
		// Display Page
    $data['mismatch'] = $this->msil_order_mismatch_model->find_count();    
		$data['header'] = lang('msil_orders');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'msil_orders';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		$this->msil_order_model->_table = "view_grouped_msil_order";

		$total=$this->msil_order_model->find_count();
		
		paging('order_id');
		
		search_params();
		
		$rows=$this->msil_order_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->msil_order_model->insert($data);
        }
        else
        {
        	$success=$this->msil_order_model->update($data['id'],$data);
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
      if($this->input->post('unplanned_order')) 
      {
        $data['unplanned_order'] = $this->input->post('unplanned_order');
      }
      $data['vehicle_id'] = $this->input->post('vehicle_id');
      $data['variant_id'] = $this->input->post('variant_id');
      $data['color_id'] = $this->input->post('color_id');
      $data['month'] = $this->input->post('month');
      $data['year'] = $this->input->post('year');
      $data['order_id'] = $this->input->post('order_id');
      $data['firm_id'] = $this->input->post('firm_id');
      $data['quantity'] = $this->input->post('quantity');
      return $data;
    }

    public function upload_order(){
        $index = array('vehicle_name','variant_name','color','month','year','quantity','company','error');
        $excel_data = $this->msil_order->read_file('uploads/monthly_order',$index,'msil_orders');
        // echo '<pre>'; print_r($excel_data); exit;
        $data = [];
        // $this->db->truncate('msil_order_mismatch');
        // $mismatch_flag = 0;

        foreach ($excel_data as $key => $value) {
          $this->db->select('*');
          $this->db->from('mst_vehicles');
          $this->db->where('name', strtoupper($value['vehicle_name']));
          $vehicle = $this->db->get()->row_array();
          $color = $this->db->from('mst_colors')->where('name', strtoupper($value['color']))->get()->row_array();
          $variant = $this->db->from('mst_variants')->where('name', strtoupper($value['variant_name']))->get()->row_array();
          $this->db->select('*');
          $this->db->from('mst_firms');
          $this->db->where('prefix',strtoupper($value['company']));
          $firm = $this->db->get()->row_array();
          if(empty($vehicle) || empty($color) || empty($variant) || empty($firm)){
            $mismatch['vehicle_name'] = $vehicle['name'];
            $mismatch['variant_name'] = $variant['name'];
            $mismatch['color'] = $color['name'];
            $mismatch['month'] = $value['month'];
            $mismatch['year'] = $value['year'];
            $mismatch['quantity'] = $value['quantity'];
            $mismatch['company'] = @strtoupper($firm['prefix']);
            $this->msil_order_mismatch_model->insert($mismatch);
            // $mismatch_flag = 1;
          }else{
            $data[$key]['vehicle_id'] = $vehicle['id'];
            $data[$key]['color_id'] = $color['id'];
            $data[$key]['variant_id'] = $variant['id'];
            $data[$key]['month'] = $value['month'];
            $data[$key]['year'] = $value['year'];
            $data[$key]['quantity'] = $value['quantity'];    
            $data[$key]['firm_id'] = $firm['id'];

            $this->db->select_max('order_id');
            $this->db->where('firm_id',$firm['id']);
            $order_no = $this->db->get('msil_orders')->row();
            $data[$key]['order_id'] = $order_no->order_id + 1;
            
          }

      }
      if(count($data)){
      $this->db->trans_start();
      $this->msil_order_model->_table = 'msil_orders';
      $this->msil_order_model->insert_many($data); 

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
      } else {
       $this->db->trans_commit();
      }
      $this->db->trans_complete();
      }
 
      // dd()
      flashMsg('success', 'Successfully Uploaded Order.');     
      redirect($_SERVER['HTTP_REFERER']); 
  }

 public function list_msil_order($order_id = NULL, $firm_id = NULL)
 {
   $data['order_id'] = $order_id;
   $data['firm_id'] = $firm_id;
   $data['header'] = lang('msil_orders');
   $data['page'] = $this->config->item('template_admin') . "msil_order_list";
   $data['module'] = 'msil_orders';
   $this->load->view($this->_container,$data);
 }

 public function list_json()
 {
   $order_id  = $this->input->get('order_id');
   $firm_id  = $this->input->get('firm_id');
   search_params();
   $this->msil_order_model->_table = "view_all_msil_orders";

   $total=$this->msil_order_model->find_count(array('order_id'=>$order_id,'firm_id'=>$firm_id));

   paging('order_id');

   search_params();

   $rows=$this->msil_order_model->findAll(array('order_id'=>$order_id,'firm_id'=>$firm_id));

   echo json_encode(array('total'=>$total,'rows'=>$rows));
   exit;
 }

 public function list_msil_dispatch($order_id = NULL, $firm_id = NULL)
 {
   $data['order_id'] = $order_id;
   $data['firm_id'] = $firm_id;
   $data['header'] = lang('msil_orders');
   $data['page'] = $this->config->item('template_admin') . "msil_dispatch_list";
   $data['module'] = 'msil_orders';
   $this->load->view($this->_container,$data);
 }

 public function dispatch_list_json()
 {
   $order_id  = $this->input->get('order_id');
   $firm_id  = $this->input->get('firm_id');

   search_params();
   $this->msil_order_model->_table = "view_msil_dispatch_vehicles";

   $total=$this->msil_order_model->find_count(array('order_id'=>$order_id,'firm_id'=>$firm_id));

   paging('order_id');

   search_params();

   $rows=$this->msil_order_model->findAll(array('order_id'=>$order_id,'firm_id'=>$firm_id));

   echo json_encode(array('total'=>$total,'rows'=>$rows));
   exit;
 }

 public function save_cancel_order()
 {    	
   $data['id'] = $this->input->post('id');
   $data['cancel_quantity'] = $this->input->post('cancel_quantity');
   $data['reason'] = $this->input->post('reason');

   $success = $this->msil_order_model->update($data['id'],$data);

   if($success)
   {
    echo json_encode(array('success'=>$success));
  }
}

}