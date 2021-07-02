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
 * Log_fuel_kms
 *
 * Extends the Project_Controller class
 * 
 */

class Log_fuel_kms extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Log Fuel Kms');

        $this->load->model('log_fuel_kms/log_fuel_km_model');
        $this->lang->load('log_fuel_kms/log_fuel_km');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('log_fuel_kms');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'log_fuel_kms';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->log_fuel_km_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->log_fuel_km_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->log_fuel_km_model->insert($data);
        }
        else
        {
            $success=$this->log_fuel_km_model->update($data['id'],$data);
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
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['fuel'] = $this->input->post('fuel');
		$data['kms'] = $this->input->post('kms');
		$data['date'] = $this->input->post('date');
		$data['date_np'] = $this->input->post('date_np');

        return $data;
   }
}