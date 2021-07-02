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
 * Foc_requests
 *
 * Extends the Project_Controller class
 * 
 */

class Foc_requests extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Foc Requests');

		$this->load->model('foc_requests/foc_request_model');
		$this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');

		$this->lang->load('foc_requests/foc_request');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('foc_requests');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'foc_requests';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
        $dealer_id = $this->session->userdata('employee')['dealer_id'];
        $where = '1=1';
        if(is_showroom_incharge() || is_dealer_incharge() || is_sales_executive())
        {
            $where = '(dealer_id = '.$dealer_id.')';
        }
        elseif(is_sales_head()) {
            $where = "(dealer_id = 1 OR dealer_id = 2)";
        }
        
        search_params();

        $this->foc_request_model->_table = "view_foc_request";

        $this->db->where($where);
        $total=$this->foc_request_model->find_count(array('approved_date'=>NULL));

        paging('id');

        search_params();
        $this->db->where($where);
        $rows=$this->foc_request_model->findAll(array('approved_date'=>NULL));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->foc_request_model->insert($data);
        }
        else
        {
        	$success=$this->foc_request_model->update($data['id'],$data);
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
    	$data['foc_approved_part'] = $this->input->post('foc_approved_part');
    	$data['approved_date'] = date('Y-m-d');
    	$data['approved_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');
    	return $data;
    }

    public function get_foc_request()
    {
    	$req_id = $this->input->get('id');
    	$request_part = $this->foc_request_model->find(array('id'=>$req_id));
    	$req_array = explode(',',$request_part->foc_request_part);

    	$list_req = array();
    	foreach ($req_array as $key => $value) 
    	{
    		$foc_accessories = $this->foc_accessoreis_partcode_model->find(array('id'=>$value));
    		$list_req[$key]['id'] = $foc_accessories->id;
    		$list_req[$key]['name'] = $foc_accessories->name;
    	}
    	echo json_encode($list_req);    
    }
}