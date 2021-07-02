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
 * Stock_damage_records
 *
 * Extends the Project_Controller class
 * 
 */

class Stock_damage_records extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Stock Damage Records');

        $this->load->model('stock_damage_records/stock_damage_record_model');
        $this->lang->load('stock_damage_records/stock_damage_record');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('stock_damage_records');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stock_damage_records';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->stock_damage_record_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->stock_damage_record_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->stock_damage_record_model->insert($data);
        }
        else
        {
            $success=$this->stock_damage_record_model->update($data['id'],$data);
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
		$data['stock_record_id'] = $this->input->post('stock_record_id');
		$data['damage_date'] = $this->input->post('damage_date');
		$data['damage_date_np'] = $this->input->post('damage_date_np');
		$data['repair_commitment_date'] = $this->input->post('repair_commitment_date');
		$data['repair_date'] = $this->input->post('repair_date');
		$data['repair_date_np'] = $this->input->post('repair_date_np');
		$data['remarks'] = $this->input->post('remarks');

        return $data;
   }
}