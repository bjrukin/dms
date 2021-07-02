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
 * Workshop_jobs
 *
 * Extends the Project_Controller class
 * 
 */

class Workshop_jobs extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Workshop Jobs');

        $this->load->model('workshop_jobs/workshop_job_model');
        $this->lang->load('workshop_jobs/workshop_job');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('workshop_jobs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'workshop_jobs';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->workshop_job_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->workshop_job_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->workshop_job_model->insert($data);
        }
        else
        {
            $success=$this->workshop_job_model->update($data['id'],$data);
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
		$data['description'] = $this->input->post('description');
		$data['min_price'] = $this->input->post('min_price');

        return $data;
   }

   // for combobox
   public function get_job_combo_json(){
   		$fields = ('id, name');

   		$rows = $this->workshop_job_model->findAll(array('parent_id <>'=> 0), $fields);

   		array_unshift($rows, array('id' => '', 'name' => 'Select Vehicle No.'));

   		echo json_encode($rows);
   }

   // for detail of job
   public function get_detail($id = NULL){
   		if($id == NULL){
   			$id = $this->input->post('id');
   		}

		$rows = $this->workshop_job_model->find_by('id',$id);   
		
		echo json_encode($rows);		
   }
}