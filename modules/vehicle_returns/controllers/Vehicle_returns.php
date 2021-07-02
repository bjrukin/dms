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
 * Vehicle_returns
 *
 * Extends the Project_Controller class
 * 
 */

class Vehicle_returns extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Vehicle Returns');

        $this->load->model('vehicle_returns/vehicle_return_model');
        $this->lang->load('vehicle_returns/vehicle_return');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('vehicle_returns');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'vehicle_returns';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->vehicle_return_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->vehicle_return_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->vehicle_return_model->insert($data);
        }
        else
        {
            $success=$this->vehicle_return_model->update($data['id'],$data);
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
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['remarks'] = $this->input->post('remarks');
		$data['date'] = $this->input->post('date');
		$data['date_np'] = $this->input->post('date_np');

        return $data;
   }
}