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
 * Inquiry_statuses
 *
 * Extends the Project_Controller class
 * 
 */

class Inquiry_statuses extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Inquiry Statuses');

        $this->load->model('inquiry_statuses/inquiry_status_model');
        $this->lang->load('inquiry_statuses/inquiry_status');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('inquiry_statuses');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'inquiry_statuses';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->inquiry_status_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->inquiry_status_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->inquiry_status_model->insert($data);
        }
        else
        {
            $success=$this->inquiry_status_model->update($data['id'],$data);
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
		$data['name'] = $this->input->post('name');
		$data['rank'] = $this->input->post('rank');
		$data['sub_status_group'] = $this->input->post('sub_status_group');

        return $data;
   }
}