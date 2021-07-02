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
 * Dealer_yearly_targets
 *
 * Extends the Project_Controller class
 * 
 */

class Dealer_yearly_targets extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Dealer Yearly Targets');

        $this->load->model('dealer_yearly_targets/dealer_yearly_target_model');
        $this->lang->load('dealer_yearly_targets/dealer_yearly_target');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('dealer_yearly_targets');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dealer_yearly_targets';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->dealer_yearly_target_model->_table = "view_spareparts_dealer_target_set";
		search_params();
		
		$total=$this->dealer_yearly_target_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->dealer_yearly_target_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->dealer_yearly_target_model->insert($data);
        }
        else
        {
            $success=$this->dealer_yearly_target_model->update($data['id'],$data);
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
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['year'] = $this->input->post('year');
		$data['month'] = $this->input->post('month');
		$data['target'] = $this->input->post('target');

        return $data;
   }
}