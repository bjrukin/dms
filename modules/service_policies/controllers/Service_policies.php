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
 * Service_policies
 *
 * Extends the Project_Controller class
 * 
 */

class Service_policies extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Service Policies');

        $this->load->model('service_policies/service_policy_model');
        $this->lang->load('service_policies/service_policy');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('service_policies');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'service_policies';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->service_policy_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->service_policy_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->service_policy_model->insert($data);
        }
        else
        {
            $success=$this->service_policy_model->update($data['id'],$data);
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
		// $data['created_by'] = $this->input->post('created_by');
		// $data['updated_by'] = $this->input->post('updated_by');
		// $data['deleted_by'] = $this->input->post('deleted_by');
		// $data['created_at'] = $this->input->post('created_at');
		// $data['updated_at'] = $this->input->post('updated_at');
		// $data['deleted_at'] = $this->input->post('deleted_at');
		$data['policy_name'] = $this->input->post('policy_name');
		// $data['rank'] = $this->input->post('rank');

        return $data;
   }
}