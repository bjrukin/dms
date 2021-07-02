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
 * Pi_imports
 *
 * Extends the Project_Controller class
 * 
 */

class Pi_imports extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Pi Imports');

        $this->load->model('pi_imports/pi_import_model');
        $this->lang->load('pi_imports/pi_import');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('pi_imports');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'pi_imports';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->pi_import_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->pi_import_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->pi_import_model->insert($data);
        }
        else
        {
            $success=$this->pi_import_model->update($data['id'],$data);
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
		$data['order_no'] = $this->input->post('order_no');
		$data['part_code'] = $this->input->post('part_code');
		$data['quantity'] = $this->input->post('quantity');
		$data['price'] = $this->input->post('price');
		$data['sparepart_id'] = $this->input->post('sparepart_id');
		$data['pi_number'] = $this->input->post('pi_number');
		$data['reached_date'] = $this->input->post('reached_date');
		$data['reached_date_np'] = $this->input->post('reached_date_np');

        return $data;
   }
}