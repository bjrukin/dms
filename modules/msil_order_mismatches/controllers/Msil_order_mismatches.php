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
 * Msil_order_mismatches
 *
 * Extends the Project_Controller class
 * 
 */

class Msil_order_mismatches extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();


        $this->load->model('msil_order_mismatches/msil_order_mismatch_model');
        $this->lang->load('msil_order_mismatches/msil_order_mismatch');
		$this->load->model('msil_orders/msil_order_model');

    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('msil_order_mismatches');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'msil_order_mismatches';

		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->msil_order_mismatch_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->msil_order_mismatch_model->findAll();
		// echo $this->db->last_query();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;

		// $this->msil_order_model->_table = 'view_temp_msil';
		// search_params();
		// $where = "color_id IS null OR vehicle_id IS null OR variant_id IS null";
		// $total=$this->msil_order_model->find_count($where);
		
		// paging('id');
		
		// search_params();
		// // $this->db->where(array('color_id'=>null,'variant_id'=>null,'vehicle_id'=>null));
		
		// $rows=$this->msil_order_model->findAll($where);
		
		// echo json_encode(array('total'=>$total,'rows'=>$rows));
		// exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data
        $this->db->select('*');
        
        $this->db->from('mst_vehicles');
        $this->db->where('name', strtoupper($data['vehicle_id']));
        $vehicle = $this->db->get()->row_array();
        $color = $this->db->from('mst_colors')->where('name', strtoupper($data['color_id']))->get()->row_array();
        $variant = $this->db->from('mst_variants')->where('name', strtoupper($data['variant_id']))->get()->row_array();
        $this->db->select('*');
        $this->db->from('mst_firms');
        $this->db->where('prefix',strtoupper($data['firm_id']));
        $firm = $this->db->get()->row_array();

        $this->db->select_max('order_id');
		$this->db->where('firm_id',$firm['id']);
		$order_no = $this->db->get('msil_orders')->row();

        $data['vehicle_id'] = $vehicle['id'];
        $data['variant_id'] = $variant['id'];
        $data['color_id'] 	= $color['id'];
        $data['firm_id'] 	= $firm['id'];
		$data['order_id'] = $order_no->order_id + 1;
		// $data['id'] = $this->input->post('id');
		$success = false;

        if($data['vehicle_id'] != '' || $data['vehicle_id'] != null || $data['variant_id'] != '' || $data['variant_id'] != null || $data['color_id'] != '' || $data['color_id'] != null || $data['firm_id'] != '' || $data['color_id'] != null){
			$success=$this->msil_order_model->insert($data);    	
        	
        }


        
		if($success)
		{
			$id = $this->input->post('id');
			$this->msil_order_mismatch_model->delete($id);
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
  //  		if($this->input->post('id')) {
		// 	$data['id'] = $this->input->post('id');
		// }
		// $data['created_by'] = $this->input->post('created_by');
		// $data['updated_by'] = $this->input->post('updated_by');
		// $data['deleted_by'] = $this->input->post('deleted_by');
		// $data['created_at'] = $this->input->post('created_at');
		// $data['updated_at'] = $this->input->post('updated_at');
		// $data['deleted_at'] = $this->input->post('deleted_at');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] = $this->input->post('color_id');
		$data['month'] = $this->input->post('month');
		$data['year'] = $this->input->post('year');
		$data['quantity'] = $this->input->post('quantity');
		$data['firm_id'] = $this->input->post('firm_id');

        return $data;
   }

   	public function get_colors_only_combo_json_mistmatch() 
	{
		$this->load->model('vehicles/vehicle_model');
		$this->vehicle_model->_table = 'mst_colors';


		$rows=$this->vehicle_model->findAll(null, array('id','name'));
		
		array_unshift($rows, array('id' => '0', 'name' => 'Select Color'));

		echo json_encode($rows);
	}
}