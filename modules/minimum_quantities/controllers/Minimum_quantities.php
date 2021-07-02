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
 * Minimum_quantities
 *
 * Extends the Project_Controller class
 * 
 */

class Minimum_quantities extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Minimum Quantities');

        $this->load->model('minimum_quantities/minimum_quantity_model');
        $this->lang->load('minimum_quantities/minimum_quantity');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('minimum_quantities');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'minimum_quantities';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->minimum_quantity_model->_table = "view_minimum_ktm_stock";
		search_params();
		
		$total=$this->minimum_quantity_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->minimum_quantity_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->minimum_quantity_model->insert($data);
        }
        else
        {
            $success=$this->minimum_quantity_model->update($data['id'],$data);
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
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] = $this->input->post('color_id');
		$data['quantity'] = $this->input->post('quantity');

        return $data;
   }
}