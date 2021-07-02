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
 * Repairs
 *
 * Extends the Project_Controller class
 * 
 */

class Repairs extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Repairs');

        $this->load->model('repairs/repair_model');
        $this->lang->load('repairs/repair');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('repairs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'repairs';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->repair_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->repair_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->repair_model->insert($data);
        }
        else
        {
            $success=$this->repair_model->update($data['id'],$data);
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
		$data['vehicle_name'] = $this->input->post('vehicle_name');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['color_name'] = $this->input->post('color_name');
		$data['variant_name'] = $this->input->post('variant_name');
		$data['description'] = $this->input->post('description');
		$data['image'] = $this->input->post('image');
		$data['chass_no'] = $this->input->post('chass_no');
		$data['engine_no'] = $this->input->post('engine_no');

        return $data;
   }
}