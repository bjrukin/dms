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
 * Document_counts
 *
 * Extends the Project_Controller class
 * 
 */

class Document_counts extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Document Counts');

        $this->load->model('document_counts/document_count_model');
        $this->lang->load('document_counts/document_count');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('document_counts');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'document_counts';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->document_count_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->document_count_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->document_count_model->insert($data);
        }
        else
        {
            $success=$this->document_count_model->update($data['id'],$data);
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
		$data['proforma_invoice'] = $this->input->post('proforma_invoice');
		$data['billing_invoice'] = $this->input->post('billing_invoice');

        return $data;
   }
}