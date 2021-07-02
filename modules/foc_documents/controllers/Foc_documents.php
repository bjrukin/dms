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
 * Foc_documents
 *
 * Extends the Project_Controller class
 * 
 */

class Foc_documents extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Foc Documents');

        $this->load->model('foc_documents/foc_document_model');
        $this->lang->load('foc_documents/foc_document');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('foc_documents');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'foc_documents';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->foc_document_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->foc_document_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->foc_document_model->insert($data);
        }
        else
        {
            $success=$this->foc_document_model->update($data['id'],$data);
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
		$data['customer_id'] = $this->input->post('customer_id');
		$data['accessories_id'] = $this->input->post('accessories_id');
		$data['free_servicing'] = $this->input->post('free_servicing');
		$data['name_transfer'] = $this->input->post('name_transfer');
		$data['fuel'] = $this->input->post('fuel');
		$data['road_tax'] = $this->input->post('road_tax');

        return $data;
   }
}