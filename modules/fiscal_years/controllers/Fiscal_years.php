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
 * Fiscal_years
 *
 * Extends the Project_Controller class
 * 
 */

class Fiscal_years extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Fiscal Years');

        $this->load->model('fiscal_years/fiscal_year_model');
        $this->lang->load('fiscal_years/fiscal_year');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('fiscal_years');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'fiscal_years';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->_get_search_param();
		$total=$this->fiscal_year_model->find_count();
		paging('id');
		$this->_get_search_param();
		$rows=$this->fiscal_year_model->findAll();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        $this->db->trans_begin();

        if(!$this->input->post('id'))
        {
            $success=$this->fiscal_year_model->insert($data);
        }
        else
        {
            $success=$this->fiscal_year_model->update($data['id'],$data);
        }
        
        $this->fiscal_year_model->unsubscribe('after_create', 'activity_log_insert');
        $this->fiscal_year_model->unsubscribe('before_update', 'audit_log_update');
        
        // update all records to active = false
        $this->fiscal_year_model->update_all(array('active'=>FALSE));

        // update record with current date between start_date and end_date as active = true;
        $today = date('Y-m-d');
        $condition = "'{$today}' between english_start_date and english_end_date";
        $this->fiscal_year_model->update_by($condition, array('active' => TRUE));

		if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg=lang('general_failure');
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg=lang('general_success');
            $success = TRUE;
        }

		 echo json_encode(array('msg'=>$msg,'success'=>$success));
		 exit;
	}

   private function _get_posted_data()
   {
   		$data=array();
   		if($this->input->post('id')){
   			$data['id'] = $this->input->post('id');
   		}
		
		$data['nepali_start_date'] 	= $this->input->post('nepali_start_date');
		$data['nepali_end_date'] 	= $this->input->post('nepali_end_date');
		$data['english_start_date'] = $this->input->post('english_start_date');
		$data['english_end_date'] 	= $this->input->post('english_end_date');
		// $data['active'] 			= $this->input->post('active');

        return $data;
   }
}