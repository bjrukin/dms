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
 * Picklists
 *
 * Extends the Project_Controller class
 * 
 */

class Picklists extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Picklists');

        $this->load->model('picklists/picklist_model');
        $this->lang->load('picklists/picklist');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('picklists');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'picklists';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->picklist_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->picklist_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->picklist_model->insert($data);
        }
        else
        {
            $success=$this->picklist_model->update($data['id'],$data);
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
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['order_id'] = $this->input->post('order_id');

        return $data;
   }
}