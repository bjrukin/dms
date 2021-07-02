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
 * Stockyard_countersale_parts
 *
 * Extends the Project_Controller class
 * 
 */

class Stockyard_countersale_parts extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Stockyard Countersale Parts');

        $this->load->model('stockyard_countersale_parts/stockyard_countersale_part_model');
        $this->lang->load('stockyard_countersale_parts/stockyard_countersale_part');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('stockyard_countersale_parts');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stockyard_countersale_parts';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->stockyard_countersale_part_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->stockyard_countersale_part_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->stockyard_countersale_part_model->insert($data);
        }
        else
        {
            $success=$this->stockyard_countersale_part_model->update($data['id'],$data);
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
		$data['sparepart_id'] = $this->input->post('sparepart_id');
		$data['quantity'] = $this->input->post('quantity');
		$data['total'] = $this->input->post('total');
		$data['dealer_price'] = $this->input->post('dealer_price');
		$data['dealer_price_total'] = $this->input->post('dealer_price_total');

        return $data;
   }
}