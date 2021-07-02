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
 * Service_types
 *
 * Extends the Project_Controller class
 * 
 */

class Service_types extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

    	// control('Service Types');

		$this->load->model('service_types/service_type_model');
		$this->lang->load('service_types/service_type');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('service_types');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'service_types';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->service_type_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->service_type_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->service_type_model->insert($data);
        }
        else
        {
        	$success=$this->service_type_model->update($data['id'],$data);
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

    	return $data;
    }

    public function get_service_type_json(){
    	$rows = $this->service_type_model->findAll();
    	
        array_unshift($rows, array('id' => '', 'name' => ''));
    	echo json_encode($rows);
    }
}