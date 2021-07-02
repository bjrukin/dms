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
 * Events
 *
 * Extends the Project_Controller class
 * 
 */

class Events extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Events');

        $this->load->model('events/event_model');
        $this->lang->load('events/event');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('events');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'events';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$where = "1=1";
		if(is_showroom_incharge())
		{
			$dealer_id = $this->session->userdata('employee')['dealer_id'];
			$where = "(dealer_id = $dealer_id )";
		}

		$this->event_model->_table = 'view_dms_events';
		search_params();
		
		$this->db->where($where);
		$total=$this->event_model->find_count();
		
		paging('id');
		
		search_params();

		$this->db->where($where);
		$rows=$this->event_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->event_model->insert($data);
        }
        else
        {
            $success=$this->event_model->update($data['id'],$data);
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
		$data['dealer_id'] 	= ($this->input->post('dealer_id')) ? $this->input->post('dealer_id') : null;
		$data['name'] 		= $this->input->post('name');
		$data['start_date_en'] = ($this->input->post('start_date_en')) ? $this->input->post('start_date_en') : null;
		$data['start_date_np'] = ($this->input->post('start_date_np')) ? $this->input->post('start_date_np') : null;
		$data['end_date_en'] = ($this->input->post('end_date_en')) ? $this->input->post('end_date_en') : null;
		$data['end_date_np'] = ($this->input->post('end_date_np')) ? $this->input->post('end_date_np') : null;
		$data['description'] = ($this->input->post('description')) ? $this->input->post('description') : null;
		$data['active'] 	= ($this->input->post('active')) ? TRUE : FALSE;

        return $data;
   }
}