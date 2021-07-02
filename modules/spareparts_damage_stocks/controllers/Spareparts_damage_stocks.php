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
 * Spareparts_damage_stocks
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_damage_stocks extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Spareparts Damage Stocks');

        $this->load->model('spareparts_damage_stocks/spareparts_damage_stock_model');
        $this->lang->load('spareparts_damage_stocks/spareparts_damage_stock');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts_damage_stocks');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts_damage_stocks';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();

		$this->spareparts_damage_stock_model->_table = "view_spareparts_damage_stock";
		
		$total=$this->spareparts_damage_stock_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->spareparts_damage_stock_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->spareparts_damage_stock_model->insert($data);
        }
        else
        {
            $success=$this->spareparts_damage_stock_model->update($data['id'],$data);
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
		$data['sparepart_id'] = $this->input->post('sparepart_id');
		$data['quantity'] = $this->input->post('quantity');
		$data['damage_date'] = $this->input->post('damage_date');
		$data['damage_date_np'] = $this->input->post('damage_date_np');
		$data['repair_date'] = $this->input->post('repair_date');
		$data['repair_date_np'] = $this->input->post('repair_date_np');

        return $data;
   }
}