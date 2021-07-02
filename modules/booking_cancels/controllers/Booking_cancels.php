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
 * Booking_cancels
 *
 * Extends the Project_Controller class
 * 
 */

class Booking_cancels extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Booking Cancels');

        $this->load->model('booking_cancels/booking_cancel_model');
        $this->lang->load('booking_cancels/booking_cancel');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('booking_cancels');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'booking_cancels';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->booking_cancel_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->booking_cancel_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->booking_cancel_model->insert($data);
        }
        else
        {
            $success=$this->booking_cancel_model->update($data['id'],$data);
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
		$data['customer_id'] = $this->input->post('customer_id');
		$data['cancel_amount'] = $this->input->post('cancel_amount');
		$data['notes'] = $this->input->post('notes');

        return $data;
   }
}