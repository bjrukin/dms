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
 * Job_cards
 *
 * Extends the Project_Controller class
 * 
 */

class Job_card_detail extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Job Cards');

        $this->load->model('job_cards/job_card_model');
        $this->lang->load('job_cards/job_card');

        $this->load->library('job_cards/job_card');
    }

	public function index(){
		$data['jobcard_group'] = $this->input->post('jobcard_group');
		$data['vehicle_id'] = $this->input->post('vehicle_id');

		$this->load->view($this->config->item('template_admin') . 'job_detail',$data);
		$this->load->view($this->config->item('template_admin') . 'job_part_detail',$data);
		
	}

	public function job_status_change(){
		$data['status'] = ($this->input->post('stat') == 'true')?'PENDING':'COMPLETE';// status is opposite
		$data['id'] = $this->input->post('id');

		$success = $this->job_card->update_status($data);


		echo json_encode(array('success' => $success));
	}

	public function part_request_status(){
		$part = $this->input->post();
		$data['id'] = $part['partdata']['id'];
		$data['request_status'] = ($this->input->post('status') == 'true')?1:0;

		$success = $this->job_card->update_status($data,'ser_parts');

		echo json_encode(array('success' => $success));
	}

	public function part_recived_status(){
		$part = $this->input->post();
		$data['id'] = $part['partdata']['id'];
		$data['recived_status'] = ($this->input->post('status') == 'true')?1:0;

		$success = $this->job_card->update_status($data,'ser_parts');

		echo json_encode(array('success' => $success));
	}
}