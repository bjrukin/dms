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
 * Ccd_lostcases
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_lostcases extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Ccd Lostcases');

        $this->load->model('ccd_lostcases/ccd_lostcase_model');
        $this->lang->load('ccd_lostcases/ccd_lostcase');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('ccd_lostcases');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_lostcases';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->ccd_lostcase_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->ccd_lostcase_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->ccd_lostcase_model->insert($data);
        }
        else
        {
            $success=$this->ccd_lostcase_model->update($data['id'],$data);
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
		$data['call_status'] = $this->input->post('call_status');
		$data['date_of_call'] = $this->input->post('date_of_call');
		$data['date_of_call_np'] = $this->input->post('date_of_call_np');
		$data['voc'] = $this->input->post('voc');
		$data['exact_view_id'] = $this->input->post('exact_view_id');
		$data['brand_id'] = $this->input->post('brand_id');
		$data['model'] = $this->input->post('model');
		$data['same_segment'] = $this->input->post('same_segment');
		$data['similar_feature'] = $this->input->post('similar_feature');
		$data['reason_of_deviation'] = $this->input->post('reason_of_deviation');
		$data['sub_reason'] = $this->input->post('sub_reason');
		$data['third_sub_reason'] = $this->input->post('third_sub_reason');

        return $data;
   }
}