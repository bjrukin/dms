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
 * Foc_accessoreis_partcodes
 *
 * Extends the Project_Controller class
 * 
 */

class Foc_accessoreis_partcodes extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Foc Accessoreis Partcodes');

        $this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
        $this->lang->load('foc_accessoreis_partcodes/foc_accessoreis_partcode');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('foc_accessoreis_partcodes');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'foc_accessoreis_partcodes';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		$this->foc_accessoreis_partcode_model->_table = "view_mst_foc_accessories";
		
		$total=$this->foc_accessoreis_partcode_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->foc_accessoreis_partcode_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->foc_accessoreis_partcode_model->insert($data);
        }
        else
        {
            $success=$this->foc_accessoreis_partcode_model->update($data['id'],$data);
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
 		$data['name'] = $this->input->post('name');
		$data['part_code'] = $this->input->post('part_code');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['approval'] = '1';

        return $data;
   }
}