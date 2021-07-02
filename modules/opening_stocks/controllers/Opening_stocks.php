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
 * Opening_stocks
 *
 * Extends the Project_Controller class
 * 
 */

class Opening_stocks extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Opening Stocks');

        $this->load->model('opening_stocks/opening_stock_model');
        $this->lang->load('opening_stocks/opening_stock');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('opening_stocks');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'opening_stocks';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->opening_stock_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->opening_stock_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->opening_stock_model->insert($data);
        }
        else
        {
            $success=$this->opening_stock_model->update($data['id'],$data);
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
		$data['opening_stock_date'] = $this->input->post('opening_stock_date');
		$data['year'] = $this->input->post('year');
		$data['month'] = $this->input->post('month');
		$data['quantity'] = $this->input->post('quantity');
		$data['dealer_id'] = $this->input->post('dealer_id');

        return $data;
   }
}