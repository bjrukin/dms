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
 * Dispatch_dealers
 *
 * Extends the Project_Controller class
 * 
 */
class Dispatch_dealers extends Project_Controller {

	public function __construct() {
		parent::__construct();

		control('Dispatch Dealers');

		$this->load->model('dispatch_dealers/dispatch_dealer_model');
		$this->load->model('stock_records/stock_record_model');
		$this->load->model('dealer_orders/dealer_order_model');
		$this->lang->load('dispatch_dealers/dispatch_dealer');
	}

	public function index() {
        // Display Page
		$data['header'] = lang('dispatch_dealers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dispatch_dealers';
		$this->load->view($this->_container, $data);
	}

	public function json() {
		search_params();

		$total = $this->dispatch_dealer_model->find_count();

		paging('id');

		search_params();

		$rows = $this->dispatch_dealer_model->findAll();

		echo json_encode(array('total' => $total, 'rows' => $rows, 'query' => $this->db->last_query()));
		exit;
	}

	public function save() 
	{   
		
		$data = $this->_get_posted_data();
		$value['id'] = $data['vehicle_id'];
		
		$success = $this->dispatch_dealer_model->insert($data);
		$dispatch_id = $success;

		$log_stock = $this->stock_record_model->find(array('vehicle_id'=>$value['id']));
		$stock_record['dispatch_id'] = $success;
		$stock_record['id'] = $log_stock->id;
		$this->stock_record_model->update($stock_record['id'], $stock_record);

		$dealer = array('id' => $data['dealer_order_id'], 'vehicle_main_id' => $this->input->post('stock_vehicle_id'));
        $dealer['in_stock_remarks'] = NULL;
		$this->dealer_order_model->update($dealer['id'], $dealer);

		$order_detail = $this->dealer_order_model->find(array('id'=>$data['dealer_order_id']));

		if ($success) {
			$this->stock_record_model->_table = "dms_dealers";
            $location = $this->stock_record_model->find(array('id'=>$data['dealer_id']),'name') ;    
            if($order_detail->credit_control_approval == 1){
            	$this->change_current_location($data['vehicle_id'],$location->name,'Domestic Transit'); 
            }else if($order_detail->credit_control_approval == 4){
            	$this->change_current_location($data['vehicle_id'],$location->name,'Display'); 
            }
			$success = TRUE;
			$msg = lang('general_success');
		} else {
			$success = FALSE;
			$msg = lang('general_failure');
		}

		echo json_encode(array('msg' => $msg, 'success' => $success,'dispatch_id'=>$dispatch_id));
		exit;
	}

	private function _get_posted_data() {
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
		
		$data = array();
		$data['vehicle_id'] = $this->input->post('stock_vehicle_id');
		$data['stock_yard_id'] = $this->input->post('stock_yard_id');
		$data['driver_name'] = $this->input->post('driver_name');
		$data['driver_address'] = $this->input->post('driver_address');
		$data['driver_contact'] = $this->input->post('driver_contact_no');
		$data['driver_liscense_no'] = $this->input->post('driver_liscense_no');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['received_status'] = $this->input->post('received_status');
		$data['image_name'] = $this->input->post('image_name');
		$data['dispatched_date'] = date('Y-m-d H:i:s');       
		$data['dispatched_date_np'] = get_nepali_date($data['dispatched_date'],'true');
		$dates_np = explode('-', $data['dispatched_date_np']);
		$data['dispatched_date_np_month'] = $dates_np[1];
		if($this->input->post('nepali_month'))
        {
            $data['edit_month_np'] = $this->input->post('nepali_month');
        }
        else
        {
            $data['edit_month_np'] = ltrim($dates_np[1], '0');
        }
		$data['dispatched_date_np_year'] = $dates_np[0];
		$data['dealer_order_id'] = $this->input->post('challan_id');
		$data['remarks']=$this->input->post('remarks');
		$data['image']=$this->input->post('image');
        $data['fiscal_year'] = $fiscal_year;

		return $data;
	}

	/*public function print_challan_doc() {
		$this->dispatch_dealer_model->_table = 'view_dispatch_dealers';
		$challan_id = $this->input->get('challan_id');

		$this->db->where('dealer_order_id', $challan_id);
		$data['rows'] = $this->dispatch_dealer_model->findAll();
    // print_r($data['rows']);
    // exit;
		$this->dispatch_dealer_model->_table = 'view_msil_dispatch_records';
		$this->db->where('id',$data['rows'][0]->dispatch_vehicle_id);
		$data['data'] = $this->dispatch_dealer_model->find_All();
//        dealer record
		$this->load->model('dealers/dealer_model');
		$this->db->where('id',$data['rows'][0]->dealer_id);
		$data['dealer'] = $this->dealer_model->find_All();
		$data['header'] = lang('dispatch_dealers');
		$data['module'] = 'dispatch_dealers';
		$this->load->view($this->config->item('template_admin') . "challan_format", $data);
	}*/

	public function print_challan_doc() {
        $this->dispatch_dealer_model->_table = 'view_dispatch_dealers';
        $challan_id = $this->input->get('challan_id');

        $this->db->where('dispatch_id', $challan_id);
        $data['rows'] = $this->dispatch_dealer_model->findAll();

        $this->dispatch_dealer_model->_table = 'view_msil_dispatch_records';
        $this->db->where('id',$data['rows'][0]->dispatch_vehicle_id);
        $data['data'] = $this->dispatch_dealer_model->find_All();
    // dealer record
        $this->load->model('dealers/dealer_model');
        $this->db->where('id',$data['rows'][0]->dealer_id);
        $data['dealer'] = $this->dealer_model->find_All();
        $data['header'] = lang('dispatch_dealers');
        $data['module'] = 'dispatch_dealers';
     
        $this->load->view($this->config->item('template_admin') . "challan_format", $data);
    }

//        for report
	public function dealer_stock_report() {
		$data['records'] = $this->get_stock_records();
	}


}
