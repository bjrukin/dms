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
 * Driver_details
 *
 * Extends the Project_Controller class
 * 
 */

class Driver_details extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Driver Details');

		$this->load->model('driver_details/driver_detail_model');
		$this->lang->load('driver_details/driver_detail');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('driver_details');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'driver_details';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->driver_detail_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->driver_detail_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->driver_detail_model->insert($data);
        }
        else
        {
        	$success=$this->driver_detail_model->update($data['id'],$data);
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
    	$data['driver_name'] = $this->input->post('driver_name');
    	$data['driver_number'] = $this->input->post('driver_number');
    	$data['driver_address'] = $this->input->post('driver_address');
    	$data['source'] = $this->input->post('source');
    	$data['photo'] = $this->input->post('photo');
    	$data['license_no'] = $this->input->post('license_no');

    	return $data;
    }

    function print_driverdetails(){
    	
    	$id= $this->input->post('id');
    	$this->driver_detail_model->_table = 'view_driver_detail';
    	$id = $this->input->get('id');

    	$this->db->where('id', $id);
    	$data['rows'] = $this->driver_detail_model->findAll();
    	$data['header'] = lang('driver_details');
    	$data['module'] = 'driver_detail';
    	$this->load->view($this->config->item('template_admin') . "driver_format", $data);
    }
}