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
 * Service_jobs
 *
 * Extends the Project_Controller class
 * 
 */

class Service_jobs extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->model('service_jobs/service_job_model');
		$this->lang->load('service_jobs/service_job');
	}

	public function index()
	{
        control('Service Jobs');
		// Display Page
		$data['header'] = lang('service_jobs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'service_jobs';

        $data['vehicle_list'] = $this->get_vehicles('array');

        $this->load->view($this->_container,$data);
    }

    public function json()
    {
      search_params();

      $total=$this->service_job_model->find_count();

      paging('id');

      search_params();

      $rows=$this->service_job_model->findAll();

      echo json_encode(array('total'=>$total,'rows'=>$rows));
      exit;
  }

  public function save()
  {
        $data=$this->_get_posted_data(); //Retrive Posted Data
        // print_r($this->input->post());

        if(!isset($data['job']['id']))
        {
        	$service_job_id =$this->service_job_model->insert($data['job']);
        	foreach ($data['grid_data'] as $key => &$value) {
        		$value['service_job_id'] = $service_job_id;
        		unset($value['id']);
        		unset($value['uid']);
        		unset($value['vehicle_name']);
        		unset($value['variant_name']);
        	}
        	unset($value);
        	$this->service_job_model->_table = "mst_service_job_description";
        	$success = $this->service_job_model->insert_many($data['grid_data']);
        }
        else
        {
        	$success=$this->service_job_model->update($data['job']['id'],$data['job']);
        	foreach ($data['grid_data'] as $key => &$value) {
        		// $value['service_job_id'] = $service_job_id;
        		unset($value['uid']);
        		unset($value['vehicle_name']);
        		unset($value['variant_name']);
        	}
        	unset($value);
        	$this->service_job_model->_table = "mst_service_job_description";
        	$success = $this->service_job_model->update_batch($data['grid_data'],'id');

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
    	$post = $this->input->post('data');
    	// print_r($post);
    	if($post['id']) {
    		$data['job']['id'] = $post['id'];
    	}
    	$data['job']['job_code'] = $post['job_code'];
    	$data['job']['description'] = $post['description'];
    	$data['job']['apply_tax'] = isset($post['apply_tax'])?1:0;
    	$data['job']['outsidework_margin'] = $post['outsidework_margin'];
    	$data['job']['number_vehicles'] = $post['number_vehicles'];
    	$data['job']['mechanic_incentive'] = isset($post['mechanic_incentive'])?1:0;
        $data['job']['top_complaints'] = isset($post['top_complaints'])?1:0;
        $data['job']['under_warranty'] = isset($post['under_warranty'])?1:0;

        $data['grid_data'] = ($this->input->post('modelwise'));

        $data['job'] = array_filter($data['job'], function($value) {
          return ($value !== null && $value !== false && $value !== ''); 
      });

        return $data;
    }

    public function get_vehicles($key = NULL) {
    	if($id = $this->input->post('id')){
    		$this->service_job_model->_table = "view_service_job_description";
    		$this->db->where('service_job_id',$id);
    		
    		$rows = $this->service_job_model->findAll();
    	}
    	else {
    		$this->service_job_model->_table = "view_dms_vehicles";
    		$fields = 'vehicle_id, variant_id, vehicle_name, variant_name';
    		$this->db->group_by($fields);
    		$this->db->order_by('vehicle_name');

    		$rows = $this->service_job_model->findAll(null,$fields);
    	}

        if($key == 'array'){
           return json_encode($rows);
           exit;
       }

       echo json_encode($rows);
   }

   public function get_jobs() {
    $this->service_job_model->_table = "view_service_jobs";
    if($id = $this->input->post('id')) {
        $this->db->where('service_job_id', $id);
        $this->db->where('vehicle_id',$this->input->post('vehicle_id'));
        $this->db->where('variant_id',$this->input->post('variant_id'));
        $rows = $this->service_job_model->find();
    }
    else {
        $this->db->group_by('service_job_id, job_description');
        $rows = $this->service_job_model->findAll(null, 'service_job_id, job_description');
    }

    echo json_encode($rows);
}
}