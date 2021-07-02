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
 * Stock_yards
 *
 * Extends the Project_Controller class
 * 
 */

class Stock_yards extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Stock Yards');

        $this->load->model('stock_yards/stock_yard_model');
        $this->lang->load('stock_yards/stock_yard');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('stock_yards');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stock_yards';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->stock_yard_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->stock_yard_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->stock_yard_model->insert($data);
        }
        else
        {
            $success=$this->stock_yard_model->update($data['id'],$data);
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
		
		$data['name'] = strtoupper(trim($this->input->post('name')));
		$data['longitude'] = $this->input->post('longitude');
		$data['latitude'] = $this->input->post('latitude');
		$data['rank'] = $this->input->post('rank');
		if($this->input->post('type')){
			$data['type'] = $this->input->post('type');
		}

        return $data;
   }

   	public function get_stockyard_combo_json()
   	{
   		$rows=$this->stock_yard_model->findAll();
		
		echo json_encode($rows);
		exit;
   	}
}