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
 * Credit_control_decisions
 *
 * Extends the Project_Controller class
 * 
 */

class Credit_control_decisions extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Credit Control Decisions');

		$this->load->model('credit_control_decisions/credit_control_decision_model');
		$this->lang->load('credit_control_decisions/credit_control_decision');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('credit_control_decisions');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'credit_control_decisions';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		$where = '';
		$this->credit_control_decision_model->_table = "view_sales_credit_control_decision";
		if(is_dealer_incharge())
		{
			$where = '(incharge_id ='.$this->session->userdata("id").')';
		}
		
		if($where)
		{
			$this->db->where($where);
		}
		$total=$this->credit_control_decision_model->find_count();
		
		paging('id');
		
		search_params();
		if($where)
		{
			$this->db->where($where);
		}
		$rows=$this->credit_control_decision_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->credit_control_decision_model->insert($data);
        }
        else
        {
        	$success=$this->credit_control_decision_model->update($data['id'],$data);
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
    	$data['order_id'] = $this->input->post('order_id');
    	$data['status'] = $this->input->post('status');
    	$data['dealer_id'] = $this->input->post('dealer_id');
    	$data['remarks'] = $this->input->post('remarks');
    	$data['date'] = $this->input->post('date');
    	$data['date_np'] = $this->input->post('date_np');

    	return $data;
    }
}