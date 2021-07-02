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
 * Partial_payments
 *
 * Extends the Project_Controller class
 * 
 */

class Partial_payments extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Partial Payments');

        $this->load->model('partial_payments/partial_payment_model');
        $this->lang->load('partial_payments/partial_payment');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('partial_payments');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'partial_payments';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->partial_payment_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->partial_payment_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->partial_payment_model->insert($data);
        }
        else
        {
            $success=$this->partial_payment_model->update($data['id'],$data);
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
		$data['vehicle_process_id'] = $this->input->post('vehicle_process_id');
		$data['receipt_no'] = $this->input->post('receipt_no');
		$data['amount'] = $this->input->post('amount');
		$data['receipt_image'] = $this->input->post('receipt_image');
		$data['payment_date'] = $this->input->post('payment_date');
		$data['payment_date_nep'] = $this->input->post('payment_date_nep');

        return $data;
   }
}