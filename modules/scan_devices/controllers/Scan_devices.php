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
 * Scan_devices
 *
 * Extends the Project_Controller class
 * 
 */

class Scan_devices extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Scan Devices');

        $this->load->model('scan_devices/scan_device_model');
        $this->lang->load('scan_devices/scan_device');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('scan_devices');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'scan_devices';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->scan_device_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->scan_device_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->scan_device_model->insert($data);
        }
        else
        {
            $success=$this->scan_device_model->update($data['id'],$data);
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
		
		$data['device_name'] = $this->input->post('device_name');

        return $data;
   }
}