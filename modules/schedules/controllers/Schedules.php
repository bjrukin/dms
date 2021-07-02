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
 * Schedules
 *
 * Extends the Project_Controller class
 * 
 */

class Schedules extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Schedules');

        $this->lang->load('schedules/schedule');

        $this->load->model('customers/customer_followup_model');

    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('schedules');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'schedules';
		$this->load->view($this->_container,$data);
	}

    public function json()
    {
        search_params();
        
        $total=$this->customer_followup_model->find_count();
        
        paging('id');
        
        search_params();
        
        $rows=$this->customer_followup_model->findAll();
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

}