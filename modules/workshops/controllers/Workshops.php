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
 * Workshops
 *
 * Extends the Project_Controller class
 * 
 */

class Workshops extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Workshops');

		$this->load->model('workshops/workshop_model');
		$this->lang->load('workshops/workshop');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('workshops');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'workshops';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->workshop_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->workshop_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->workshop_model->insert($data);
        }
        else
        {
        	$success=$this->workshop_model->update($data['id'],$data);
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
    	$data['address1'] = $this->input->post('address1');
    	$data['address2'] = $this->input->post('address2');
    	$data['address3'] = $this->input->post('address3');
    	$data['phone1'] = $this->input->post('phone1');
    	$data['phone2'] = $this->input->post('phone2');
    	$data['office_address'] = $this->input->post('office_address');
    	$data['office_phone'] = $this->input->post('office_phone');
    	$data['dealer_id'] = $this->input->post('dealer_id');
    	$data['incharge_id'] = $this->input->post('incharge_id');

    	return $data;
    }
}